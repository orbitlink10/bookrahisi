<?php

namespace App\Services\Pos;

use App\Models\Business;
use App\Models\SaleItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PosReportService
{
    public function build(Business $business): array
    {
        $today = now()->startOfDay();
        $monthStart = now()->startOfMonth();
        $sales = $business->sales()->with(['customer', 'staff', 'payments.mpesaTransaction'])->latest('transaction_date');
        $appointments = $business->appointments()->with(['customer', 'service', 'staff', 'roomChair'])->latest('booking_date');
        $products = $business->products()->latest('updated_at');

        $dailySales = (float) (clone $sales)->whereDate('transaction_date', $today)->sum('total_amount');
        $monthlySales = (float) (clone $sales)->whereBetween('transaction_date', [$monthStart, now()])->sum('total_amount');
        $expensesTotal = (float) $business->expenses()->whereBetween('expense_date', [$monthStart->toDateString(), now()->toDateString()])->sum('amount');
        $productCosts = (float) SaleItem::query()
            ->where('sale_items.business_id', $business->id)
            ->whereNotNull('sale_items.product_id')
            ->whereHas('sale', fn ($query) => $query->whereBetween('transaction_date', [$monthStart, now()]))
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->selectRaw('COALESCE(SUM(sale_items.quantity * products.buying_price), 0) as total_cost')
            ->value('total_cost');

        $lowStockProducts = (clone $products)
            ->whereColumn('current_stock', '<=', 'reorder_level')
            ->get();

        $repeatCustomers = $business->customers()
            ->whereHas('sales', fn ($query) => $query->select('customer_id')->groupBy('customer_id')->havingRaw('COUNT(*) > 1'))
            ->count();
        $activeCustomers = $business->customers()->whereHas('sales')->count();
        $customerRetention = $activeCustomers > 0
            ? round(($repeatCustomers / $activeCustomers) * 100, 1)
            : 0;

        $bestSellingServices = SaleItem::query()
            ->where('business_id', $business->id)
            ->where('item_type', 'service')
            ->select('description')
            ->selectRaw('SUM(quantity) as quantity_sold')
            ->selectRaw('SUM(line_total) as revenue')
            ->groupBy('description')
            ->orderByDesc('revenue')
            ->take(5)
            ->get();

        $bestSellingProducts = SaleItem::query()
            ->where('business_id', $business->id)
            ->where('item_type', 'product')
            ->select('description')
            ->selectRaw('SUM(quantity) as quantity_sold')
            ->selectRaw('SUM(line_total) as revenue')
            ->groupBy('description')
            ->orderByDesc('revenue')
            ->take(5)
            ->get();

        $staffPerformance = $business->staffMembers()
            ->withCount(['appointments as completed_appointments_count' => fn ($query) => $query->where('status', 'Completed')])
            ->withSum('commissions as commission_total', 'commission_amount')
            ->withSum('sales as sales_total', 'total_amount')
            ->orderByDesc('sales_total')
            ->get();

        $appointmentStatus = $business->appointments()
            ->select('status')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status')
            ->orderByDesc('total')
            ->get();

        $paymentBreakdown = $business->payments()
            ->select('payment_method')
            ->selectRaw('SUM(amount) as total')
            ->selectRaw("SUM(CASE WHEN status = 'Paid' THEN amount ELSE 0 END) as paid_total")
            ->groupBy('payment_method')
            ->orderByDesc('paid_total')
            ->get();

        $mpesaReconciliation = $business->payments()
            ->where('payment_method', 'M-Pesa')
            ->with('mpesaTransaction')
            ->latest('paid_at')
            ->take(6)
            ->get();

        $dailyClosingSummary = $business->sales()
            ->whereDate('transaction_date', $today)
            ->selectRaw('COUNT(*) as receipts_count')
            ->selectRaw('SUM(total_amount) as gross_total')
            ->selectRaw('SUM(amount_paid) as collected_total')
            ->selectRaw('SUM(balance_amount) as outstanding_total')
            ->first();

        $salesTrend = $business->sales()
            ->whereBetween('transaction_date', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(transaction_date) as sales_day')
            ->selectRaw('SUM(total_amount) as total')
            ->groupBy('sales_day')
            ->orderBy('sales_day')
            ->get()
            ->map(fn ($row) => [
                'day' => Carbon::parse($row->sales_day)->format('D'),
                'date' => Carbon::parse($row->sales_day)->format('j M'),
                'total' => (float) $row->total,
            ]);

        return [
            'dailySales' => $dailySales,
            'monthlySales' => $monthlySales,
            'expensesTotal' => $expensesTotal,
            'estimatedProfit' => round($monthlySales - $expensesTotal - $productCosts, 2),
            'lowStockProducts' => $lowStockProducts,
            'bestSellingServices' => $bestSellingServices,
            'bestSellingProducts' => $bestSellingProducts,
            'staffPerformance' => $staffPerformance,
            'staffCommissions' => $business->commissions()->with('staff')->latest('commission_date')->take(8)->get(),
            'customerRetention' => $customerRetention,
            'appointmentStatus' => $appointmentStatus,
            'paymentBreakdown' => $paymentBreakdown,
            'mpesaReconciliation' => $mpesaReconciliation,
            'dailyClosingSummary' => $dailyClosingSummary,
            'recentSales' => $sales->take(8)->get(),
            'recentAppointments' => $appointments->take(8)->get(),
            'salesTrend' => $salesTrend,
            'recentExpenses' => $business->expenses()->latest('expense_date')->take(8)->get(),
            'recentCustomers' => $business->customers()->with('membership')->latest()->take(8)->get(),
            'memberships' => $business->customers()->whereHas('membership')->with('membership')->latest()->take(8)->get(),
        ];
    }
}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $sale->receipt_number }} | Receipt</title>
        <style>
            body {
                margin: 0;
                padding: 32px;
                background: #f4f7f9;
                color: #16304d;
                font-family: Arial, sans-serif;
            }

            .receipt {
                width: min(100%, 860px);
                margin: 0 auto;
                padding: 28px;
                border-radius: 24px;
                background: #fff;
                box-shadow: 0 20px 40px rgba(17, 43, 72, 0.12);
            }

            .topbar,
            .meta-row,
            .totals-row {
                display: flex;
                justify-content: space-between;
                gap: 18px;
            }

            .topbar {
                padding-bottom: 18px;
                margin-bottom: 18px;
                border-bottom: 2px solid #e4edf2;
            }

            h1 {
                margin: 0;
                font-size: 2rem;
            }

            .muted {
                color: #5f758f;
                line-height: 1.7;
            }

            table {
                width: 100%;
                margin-top: 18px;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 12px 10px;
                border-bottom: 1px solid #e4edf2;
                text-align: left;
                vertical-align: top;
            }

            th {
                color: #5f758f;
                font-size: 0.82rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .totals {
                margin-top: 18px;
                padding: 18px;
                border-radius: 18px;
                background: #f8fbfd;
            }

            .totals-row + .totals-row {
                margin-top: 10px;
            }

            .payments {
                margin-top: 22px;
            }

            .payment-card {
                padding: 14px;
                border-radius: 16px;
                background: #f8fbfd;
                border: 1px solid #e4edf2;
            }

            .payment-card + .payment-card {
                margin-top: 10px;
            }

            @media print {
                body {
                    padding: 0;
                    background: #fff;
                }

                .receipt {
                    width: 100%;
                    box-shadow: none;
                    border-radius: 0;
                }
            }
        </style>
    </head>
    <body onload="window.print()">
        @php
            $formatKes = static fn ($value): string => 'KES '.number_format((float) $value, 2);
        @endphp

        <section class="receipt">
            <div class="topbar">
                <div>
                    <h1>{{ $business->business_name }}</h1>
                    <div class="muted">
                        {{ $business->address_line }}, {{ $business->neighborhood }}, {{ $business->city }}<br>
                        {{ $business->phone }} / {{ $business->owner_email }}
                    </div>
                </div>

                <div style="text-align: right;">
                    <strong style="font-size: 1.2rem;">Receipt {{ $sale->receipt_number }}</strong>
                    <div class="muted">
                        {{ $sale->transaction_date?->format('j M Y, g:i a') }}<br>
                        Channel: {{ $sale->sales_channel }}<br>
                        Served by: {{ $sale->staff?->full_name ?? 'Unassigned' }}
                    </div>
                </div>
            </div>

            <div class="meta-row">
                <div>
                    <strong>Customer</strong>
                    <div class="muted">
                        {{ $sale->customer?->full_name ?? 'Walk-in customer' }}<br>
                        {{ $sale->customer?->phone_number ?? 'No phone recorded' }}<br>
                        {{ $sale->customer?->email ?? 'No email recorded' }}
                    </div>
                </div>

                <div style="text-align: right;">
                    <strong>Payment summary</strong>
                    <div class="muted">
                        Method: {{ $sale->payment_method }}<br>
                        Paid: {{ $formatKes($sale->amount_paid) }}<br>
                        Balance: {{ $formatKes($sale->balance_amount) }}
                    </div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Discount</th>
                        <th>VAT</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->description }}</strong>
                                <div class="muted">{{ $item->staff?->full_name ?? 'No staff assigned' }}</div>
                            </td>
                            <td>{{ ucfirst($item->item_type) }}</td>
                            <td>{{ number_format((float) $item->quantity, 2) }}</td>
                            <td>{{ $formatKes($item->unit_price) }}</td>
                            <td>{{ $formatKes($item->discount_amount) }}</td>
                            <td>{{ $formatKes($item->vat_amount) }}</td>
                            <td>{{ $formatKes($item->line_total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals">
                <div class="totals-row">
                    <span>Subtotal</span>
                    <strong>{{ $formatKes($sale->subtotal) }}</strong>
                </div>
                <div class="totals-row">
                    <span>Discount</span>
                    <strong>{{ $formatKes($sale->discount_amount) }}</strong>
                </div>
                <div class="totals-row">
                    <span>VAT</span>
                    <strong>{{ $formatKes($sale->vat_amount) }}</strong>
                </div>
                <div class="totals-row">
                    <span>Total</span>
                    <strong>{{ $formatKes($sale->total_amount) }}</strong>
                </div>
                <div class="totals-row">
                    <span>Loyalty earned / redeemed</span>
                    <strong>{{ $sale->loyalty_points_earned }} / {{ $sale->loyalty_points_redeemed }}</strong>
                </div>
            </div>

            <div class="payments">
                <strong>Payment records</strong>

                @foreach ($sale->payments as $payment)
                    <div class="payment-card">
                        <div class="meta-row">
                            <div>
                                <strong>{{ $payment->payment_method }}</strong>
                                <div class="muted">
                                    {{ $formatKes($payment->amount) }} / {{ $payment->status }}<br>
                                    {{ $payment->paid_at?->format('j M Y, g:i a') ?? 'Awaiting settlement' }}
                                </div>
                            </div>

                            <div style="text-align: right;">
                                <strong>{{ $payment->reference ?: 'No reference' }}</strong>
                                <div class="muted">
                                    @if ($payment->mpesaTransaction)
                                        {{ $payment->mpesaTransaction->mpesa_code }} / {{ $payment->mpesaTransaction->phone_number }}<br>
                                        Till/Paybill: {{ $payment->mpesaTransaction->till_or_paybill }}
                                    @else
                                        Standard payment record
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </body>
</html>

<?php

namespace App\Support;

class PosOptions
{
    public const DEFAULT_VAT_RATE = 16.0;

    public static function customerTypes(): array
    {
        return ['Walk-in', 'Regular', 'VIP'];
    }

    public static function customerGenders(): array
    {
        return ['Male', 'Female', 'Other'];
    }

    public static function bookingStatuses(): array
    {
        return ['Pending', 'Confirmed', 'Completed', 'Cancelled', 'No-show'];
    }

    public static function serviceCategories(): array
    {
        return ['Barber', 'SPA', 'Nails', 'Facial', 'Massage', 'Retail Add-on'];
    }

    public static function serviceGenderTypes(): array
    {
        return ['Male', 'Female', 'Unisex'];
    }

    public static function staffRoles(): array
    {
        return ['Barber', 'Therapist', 'Nail Technician', 'Receptionist', 'Manager'];
    }

    public static function systemRoles(): array
    {
        return ['Admin', 'Manager', 'Receptionist', 'Barber/Therapist', 'Accountant'];
    }

    public static function productCategories(): array
    {
        return ['Haircare', 'Skincare', 'Oils', 'Shampoo', 'Gel', 'Accessories'];
    }

    public static function paymentMethods(): array
    {
        return ['Cash', 'M-Pesa', 'Card', 'Bank Transfer', 'Split Payment'];
    }

    public static function settlementMethods(): array
    {
        return ['Cash', 'M-Pesa', 'Card', 'Bank Transfer'];
    }

    public static function paymentStatuses(): array
    {
        return ['Paid', 'Pending', 'Failed'];
    }

    public static function salesChannels(): array
    {
        return ['Walk-in', 'Appointment', 'Online booking'];
    }

    public static function membershipTypes(): array
    {
        return ['Silver', 'Gold', 'Platinum'];
    }

    public static function expenseCategories(): array
    {
        return ['Rent', 'Salaries', 'Supplies', 'Utilities', 'Marketing', 'Transport', 'Maintenance'];
    }

    public static function resourceTypes(): array
    {
        return ['Room', 'Chair'];
    }

    public static function statuses(): array
    {
        return ['Active', 'Inactive'];
    }

    public static function commissionTypes(): array
    {
        return ['Fixed', 'Percentage'];
    }

    public static function permissionMatrix(): array
    {
        return [
            'Admin' => [
                'Everything',
            ],
            'Manager' => [
                'Operations',
                'Bookings',
                'Inventory',
                'Reports',
                'Customers',
            ],
            'Receptionist' => [
                'Bookings',
                'Sales',
                'Customers',
            ],
            'Barber/Therapist' => [
                'Assigned appointments',
                'Commission view',
            ],
            'Accountant' => [
                'Payments',
                'Expenses',
                'Financial reports',
            ],
        ];
    }

    public static function membershipMultiplier(string $membershipType): float
    {
        return match ($membershipType) {
            'Gold' => 1.25,
            'Platinum' => 1.5,
            default => 1.0,
        };
    }

    public static function loyaltyPointsForAmount(float $netAmount, string $membershipType = 'Silver'): int
    {
        if ($netAmount <= 0) {
            return 0;
        }

        return (int) floor(($netAmount / 100) * self::membershipMultiplier($membershipType));
    }

    public static function kenyanPhonePattern(): string
    {
        return '/^(?:\+254|0)(?:7\d{8}|1\d{8})$/';
    }
}

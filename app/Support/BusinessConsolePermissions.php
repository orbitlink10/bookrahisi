<?php

namespace App\Support;

use App\Models\User;

class BusinessConsolePermissions
{
    private const ROLE_CAPABILITIES = [
        'Admin' => ['*'],
        'Manager' => [
            'pos.view',
            'customers.manage',
            'staff.manage',
            'services.manage',
            'inventory.manage',
            'resources.manage',
            'appointments.manage',
            'sales.manage',
            'expenses.manage',
            'reports.view',
            'receipts.view',
        ],
        'Receptionist' => [
            'pos.view',
            'customers.manage',
            'appointments.manage',
            'sales.manage',
            'receipts.view',
        ],
        'Barber/Therapist' => [
            'pos.view',
            'appointments.assigned.view',
            'commissions.view',
        ],
        'Accountant' => [
            'pos.view',
            'reports.view',
            'payments.view',
            'expenses.view',
            'receipts.view',
        ],
    ];

    private const CAPABILITY_LABELS = [
        'pos.view' => 'opening the POS workspace',
        'customers.manage' => 'managing customers',
        'staff.manage' => 'managing staff',
        'services.manage' => 'managing services',
        'inventory.manage' => 'managing inventory',
        'resources.manage' => 'managing rooms and chairs',
        'appointments.manage' => 'creating and updating appointments',
        'sales.manage' => 'recording sales',
        'expenses.manage' => 'recording expenses',
        'reports.view' => 'viewing reports',
        'receipts.view' => 'viewing receipts',
        'payments.view' => 'viewing payments',
        'appointments.assigned.view' => 'viewing assigned appointments',
        'commissions.view' => 'viewing commissions',
    ];

    private const CAPABILITY_TABS = [
        'customers.manage' => 'customers',
        'staff.manage' => 'staff',
        'services.manage' => 'services',
        'inventory.manage' => 'inventory',
        'resources.manage' => 'settings',
        'appointments.manage' => 'appointments',
        'sales.manage' => 'checkout',
        'expenses.manage' => 'reports',
        'reports.view' => 'reports',
        'receipts.view' => 'checkout',
        'payments.view' => 'reports',
        'appointments.assigned.view' => 'appointments',
        'commissions.view' => 'staff',
    ];

    public static function roleForEmail(?string $email): string
    {
        if (! $email || ! BusinessConsoleSchema::hasBusinessRoleColumn()) {
            return 'Admin';
        }

        return User::query()
            ->where('email', $email)
            ->value('business_role') ?: 'Admin';
    }

    public static function allows(?string $role, string $capability): bool
    {
        $capabilities = self::ROLE_CAPABILITIES[$role ?? ''] ?? [];

        return in_array('*', $capabilities, true) || in_array($capability, $capabilities, true);
    }

    public static function denialMessage(?string $role, string $capability): string
    {
        $label = self::CAPABILITY_LABELS[$capability] ?? 'that action';

        return sprintf(
            '%s access does not allow %s in the POS module.',
            $role ?: 'This account',
            $label,
        );
    }

    public static function tabForCapability(string $capability): string
    {
        return self::CAPABILITY_TABS[$capability] ?? 'overview';
    }
}

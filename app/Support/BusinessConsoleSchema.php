<?php

namespace App\Support;

use Illuminate\Support\Facades\Schema;

class BusinessConsoleSchema
{
    public static function hasBusinessRoleColumn(): bool
    {
        return Schema::hasTable('users') && Schema::hasColumn('users', 'business_role');
    }

    public static function hasPosModuleTables(): bool
    {
        foreach (self::requiredPosTables() as $table) {
            if (! Schema::hasTable($table)) {
                return false;
            }
        }

        return true;
    }

    public static function missingPosTables(): array
    {
        return array_values(array_filter(
            self::requiredPosTables(),
            static fn (string $table): bool => ! Schema::hasTable($table),
        ));
    }

    public static function requiredPosTables(): array
    {
        return [
            'branches',
            'rooms_chairs',
            'staff',
            'customers',
            'services',
            'products',
            'appointments',
            'sales',
            'sale_items',
            'payments',
            'mpesa_transactions',
            'inventory_logs',
            'commissions',
            'loyalty_points',
            'memberships',
            'expenses',
        ];
    }
}

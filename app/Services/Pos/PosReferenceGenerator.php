<?php

namespace App\Services\Pos;

use App\Models\Business;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class PosReferenceGenerator
{
    public function next(Business $business, string $prefix, Builder|Relation $query, string $column): string
    {
        $datePrefix = now()->format('Ymd');
        $count = (clone $query)
            ->where($column, 'like', $prefix.'-'.$datePrefix.'-%')
            ->count() + 1;

        return sprintf('%s-%s-%04d', $prefix, $datePrefix, $count);
    }
}

<?php

namespace Webkul\Product\Filters;

use Webkul\Core\Eloquent\Repository;
use Webkul\DataTransfer\Contracts\Filter\PropertyFilter;

/**
 * class FamilyProperty
 * 
 * Adds filter on repostiory for family column
 */
class FamilyProperty implements PropertyFilter
{
    /**
     * Apply filter on sku column
     */
    public function applyFilter(Repository $source, string $value)
    {
        if (empty($value)) {
            return $source;
        }

        $value = str_contains($value, ',') ? explode(',', $value) : [$value];

        return $source->whereIn('family.code', $value);
    }
}

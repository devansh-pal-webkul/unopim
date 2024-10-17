<?php

namespace Webkul\Product\Filters;

use Webkul\DataTransfer\Contracts\Filter\PropertyFilter;

/**
 * class FamilyProperty
 *
 * Adds filter on repostiory for attribute_family_id column
 */
class FamilyProperty implements PropertyFilter
{
    /**
     * Apply filter on sku column
     */
    public function applyFilter(mixed $source, string $filter, string $operator, string $value)
    {
        if (empty($value)) {
            return $source;
        }

        $value = str_contains($value, ',') ? explode(',', $value) : [$value];

        return $source->whereIn('attribute_family_id', $value);
    }
}

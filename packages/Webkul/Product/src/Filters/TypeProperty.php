<?php

namespace Webkul\Product\Filters;

use Webkul\DataTransfer\Contracts\Filter\PropertyFilter;

/**
 * class TypeProperty
 *
 * Adds filter on repostiory for type column
 */
class TypeProperty implements PropertyFilter
{
    /**
     * Apply filter on type column
     */
    public function applyFilter(mixed $source, string $filter, string $operator, string $value)
    {
        if (empty($value)) {
            return $source;
        }

        return $source->where('type', $value);
    }
}

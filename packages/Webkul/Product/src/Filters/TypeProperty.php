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
    public function applyFilter(mixed $source, string $filter, string $value, ?string $channel = null, ?string $locale = null)
    {
        $types = array_keys(config('product_types'));

        if (empty($value) || ! in_array($value, $types)) {
            return $source;
        }

        return $source->where('type', $value);
    }
}

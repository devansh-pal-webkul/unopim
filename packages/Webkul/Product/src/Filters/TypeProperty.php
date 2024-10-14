<?php

namespace Webkul\Product\Filters;

use Webkul\Core\Eloquent\Repository;
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
    public function applyFilter(Repository $source, string $value)
    {
        if (empty($value)) {
            return $source;
        }

        return $source->where('type', $value);
    }
}

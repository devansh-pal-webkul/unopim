<?php

namespace Webkul\Product\Filters;

use Webkul\Core\Eloquent\Repository;
use Webkul\DataTransfer\Contracts\Filter\PropertyFilter;

/**
 * class IdentifierProperty
 * 
 * Adds filter on repostiory for sku column
 */
class IdentifierProperty implements PropertyFilter
{
    /**
     * Identifier column
     */
    protected $identifierColumn = 'sku';

    /**
     * Apply filter on sku column
     */
    public function applyFilter(Repository $source, string $value)
    {
        if (empty($value)) {
            return $source;
        }

        $value = str_contains($value, ',') ? explode(',', $value) : [$value];

        return $source->whereIn($this->identifierColumn, $value);
    }
}

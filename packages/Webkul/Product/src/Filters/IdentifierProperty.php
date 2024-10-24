<?php

namespace Webkul\Product\Filters;

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
    public function applyFilter(mixed $source, string $filter, string $value, ?string $channel = null, ?string $locale = null)
    {
        if (empty($value)) {
            return $source;
        }

        $value = str_contains($value, ',') ? explode(',', $value) : [$value];

        $value = array_map('trim', $value);

        return $source->whereIn($this->identifierColumn, $value);
    }
}

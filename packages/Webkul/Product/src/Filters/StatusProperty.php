<?php

namespace Webkul\Product\Filters;

use Webkul\DataTransfer\Contracts\Filter\PropertyFilter;

/**
 * class StatusProperty
 *
 * Adds filter on repostiory for status attribute value
 */
class StatusProperty implements PropertyFilter
{
    /**
     * Apply filter on type column
     */
    public function applyFilter(mixed $source, string $filter, string $value, ?string $channel = null, ?string $locale = null)
    {
        if (empty($value)) {
            return $source;
        }

        $value = $this->processValue($value);

        return $source->whereIn('values->common->status', $value);
    }

    /**
     * Process Value
     */
    protected function processValue(string $value): array
    {
        $value = $value == "'true'" ? ['true', 'TRUE'] : ['false', 'FALSE'];

        return $value;
    }
}

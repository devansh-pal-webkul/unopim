<?php

namespace Webkul\Attribute\Contracts\Filter;

use Webkul\Attribute\Contracts\Attribute;

/**
 * Interface AttributeFilter
 *
 * This interface defines the contract for applying filters to attributes.
 */
interface AttributeFilter
{
    /**
     * Applies a filter to the given source based on the specified criteria.
     */
    public function applyFilter(mixed $source, string $filter, string $operator, mixed $value, Attribute $attribute, ?string $channel = null, ?string $locale = null);
}

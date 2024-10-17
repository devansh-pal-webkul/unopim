<?php

namespace Webkul\Attribute\Contracts\Filter;

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
    public function applyFilter(mixed $source, string $filter, string $operator, mixed $value);
}

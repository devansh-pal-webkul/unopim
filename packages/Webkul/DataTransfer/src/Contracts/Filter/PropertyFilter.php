<?php

namespace Webkul\DataTransfer\Contracts\Filter;

/**
 * interface PropertyFilter
 */
interface PropertyFilter
{
    /**
     * Applies filter on a repository
     */
    public function applyFilter(mixed $source, string $filter, string $value, ?string $channel = null, ?string $locale = null);
}

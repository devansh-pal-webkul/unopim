<?php

namespace Webkul\DataTransfer\Contracts\Filter;

use Webkul\Core\Eloquent\Repository;

/**
 * interface PropertyFilter
 */
interface PropertyFilter
{
    /**
     * Applies filter on a repository
     */
    public function applyFilter(Repository $source, string $value);
}

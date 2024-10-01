<?php

namespace Webkul\DataTransfer\Helpers\Filters;

/**
 * Class FiltersApplier
 * 
 * Applies filters for filtering data from a repository
 */
class FiltersApplier
{
    /**
     * Stores the configuration filters
     */
    protected array $filters;

    /**
     * Apply filter on a repository according to the column values
     */
    public function applyFilter($filter, $value)
    {
        if (! $this->filters) {
            $this->setFilters();
        }

        return $source;
    }

    /**
     * Set filters from configuration of "attribute_filters"
     */
    protected function setFilters()
    {
        $this->filters = config('attribute_filters');
    }
}

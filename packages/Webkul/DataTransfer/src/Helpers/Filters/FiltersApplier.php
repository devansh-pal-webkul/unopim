<?php

namespace Webkul\DataTransfer\Helpers\Filters;

use Webkul\Attribute\Contracts\Filter\AttributeFilter;
use Webkul\Attribute\Services\AttributeService;
use Webkul\DataTransfer\Contracts\Filter\PropertyFilter;

/**
 * Class FiltersApplier
 *
 * Applies filters for filtering data from a repository
 */
class FiltersApplier
{
    /**
     * Stores the configuration filters for attribute types
     */
    protected ?array $attributeFilters = null;

    /**
     * Stores the filters configuration for properties like type, family etc
     */
    protected ?array $propertyFilters = null;

    public function __construct(protected AttributeService $attributeService) {}

    /**
     * Apply filter on a repository according to the column values
     */
    public function applyFilter(mixed &$source, string $filterName, mixed $value): void
    {
        if (! $this->attributeFilters) {
            $this->setFilters();
        }

        $filter = $this->getFilter($filterName);

        if (! $filter) {
            return;
        }

        $operator = '=';

        $source = $filter->applyFilter($source, $filterName, $operator, $value);
    }

    /**
     * Apply all filters on the source
     */
    public function applyFilters(mixed &$source, array $filters): void
    {
        foreach ($filters as $filterName => $value) {
            $this->applyFilter($source, $filterName, $value);
        }
    }

    /**
     * Set filters from configuration of "attribute_filters" and "property_filters"
     */
    protected function setFilters(): void
    {
        $this->attributeFilters = config('attribute_filters');

        $this->propertyFilters = config('property_filters');
    }

    /**
     * Get Attribute or property filter
     */
    public function getFilter(string $filterName)
    {
        return $this->getAttributeFilter($filterName) ?? $this->getPropertyFilter($filterName);
    }

    /**
     * Check if there exists an attribute filter and return if exists
     */
    protected function getAttributeFilter($filterName)
    {
        $attribute = $this->attributeService->findAttributeByCode($filterName);

        $filterClass = $this->attributeFilters[$attribute?->type] ?? null;

        if (! $filterClass) {
            return;
        }

        $filter = app($filterClass);

        if (! $filter instanceof AttributeFilter) {
            return;
        }

        return $filter;
    }

    /**
     * Ger registered property filter for the filtername
     */
    protected function getPropertyFilter($filterName)
    {
        $filterClass = $this->propertyFilters[$filterName] ?? null;

        $filter = app($filterClass);

        if (! $filter instanceof PropertyFilter) {
            return;
        }

        return $filter;
    }
}

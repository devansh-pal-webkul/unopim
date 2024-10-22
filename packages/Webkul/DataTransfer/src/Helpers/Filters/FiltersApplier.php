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
    public function applyFilter(mixed &$source, string $filterName, mixed $value, ?array $context): void
    {
        if (! $this->attributeFilters) {
            $this->setFilters();
        }

        $filter = $this->getFilter($filterName);

        if (! $filter) {
            return;
        }

        if ($filter instanceof AttributeFilter) {
            $attribute = $this->attributeService->findAttributeByCode($filterName);

            $source = $filter->applyFilter(
                $source,
                $filterName,
                $value['operator'],
                $value['value'],
                $attribute,
                $context['channel'],
                $context['locale']
            );
        }

        if ($filter instanceof PropertyFilter) {
            $source = $filter->applyFilter($source, $filterName, $value, $context['channel'], $context['locale']);
        }
    }

    /**
     * Apply all filters on the source
     */
    public function applyFilters(mixed &$source, array $filters, ?array $context = null): void
    {
        $context ??= $this->getContext($filters);

        foreach ($filters as $filterName => $value) {
            if ($filterName === 'attribute_filters') {
                if (! is_array($value)) {
                    continue;
                }

                $this->applyFilters($source, $value, $context);

                continue;
            }

            $this->applyFilter($source, $filterName, $value, $context);
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

    /**
     * Optional values for filters configuration like channel and locale
     */
    protected function getContext(array $filters): array
    {
        $context = [
            'locale'  => $filters['locale'] ?? core()->getCurrentChannelCode(),
            'channel' => $filters['channel'] ?? $this->getDefaultLocaleCode(),
        ];

        return $context;
    }

    /**
     * returns current locale code of the ui if it is also in the channel otherwise channel's first locale
     */
    private function getDefaultLocaleCode(): string
    {
        $channel = core()->getCurrentChannel();

        $currentLocale = core()->getCurrentLocale();

        $currentLocale = $channel->locales->contains($currentLocale) ? $currentLocale : $currentChannel->locales->first();

        return $currentLocale->code;
    }
}

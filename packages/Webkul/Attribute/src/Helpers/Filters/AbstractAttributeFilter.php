<?php

namespace Webkul\Attribute\Helpers\Filters;

use Webkul\Attribute\Contracts\Attribute;
use Webkul\Attribute\Contracts\Filter\AttributeFilter;
use Webkul\Product\Type\AbstractType;

abstract class AbstractAttributeFilter implements AttributeFilter
{
    /**
     * Applies a filter to the given source based on the specified criteria
     */
    public function applyFilter(
        mixed $source,
        string $filter,
        string $operator,
        mixed $value,
        Attribute $attribute,
        ?string $channel = null,
        ?string $locale = null
    ) {
        $value = $this->processValue($value, $operator);

        return $this->applyToSource($source, $operator, $value, $attribute, $channel, $locale);
    }

    /**
     * Process the given value according to the specified operator
     */
    protected function processValue(mixed $value, string $operator): mixed
    {
        return match ($operator) {
            'like'  => '%'.$value.'%',
            default => $value,
        };
    }

    /**
     * Apply condition to source
     */
    protected function applyToSource(
        mixed $source,
        string $filter,
        string $operator,
        mixed $value,
        Attribute $attribute,
        ?string $channel = null,
        ?string $locale = null
    ) {
        return $source->where(
            AbstractType::PRODUCT_VALUES_KEY.'->'.$attribute->getJsonPath($channel, $locale),
            $operator,
            $value
        );
    }
}

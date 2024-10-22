<?php

namespace Webkul\Attribute\Helpers\Filters;

use Webkul\Attribute\Contracts\Attribute;
use Webkul\Attribute\Contracts\Filter\AttributeFilter;

class TextFilter implements AttributeFilter
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
        return $source->where(
            'values->'.$attribute->getJsonPath($channel, $locale),
            $operator,
            $value
        );
    }
}

<?php

namespace Webkul\Attribute\Helpers\Filters;

use Webkul\Attribute\Contracts\Filter\AttributeFilter;

class TextFilter implements AttributeFilter
{
    public function applyFilter(mixed $source, string $filter, string $operator, mixed $value)
    {
        return $source->where($filter, $operator, $value);
    }
}

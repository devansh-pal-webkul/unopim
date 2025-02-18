<?php

namespace Webkul\Product\Filter;

use Illuminate\Contracts\Container\Container;
use Webkul\Product\Contracts\FilterRegistryInterface;

class FilterRegistry implements FilterRegistryInterface
{
    protected $attributeFilters;

    protected $fieldFilters;

    public function __construct(Container $app)
    {
        $this->attributeFilters = core()->isElasticsearchEnabled()
            ? collect($app->tagged('elasticsearch.attribute.filters'))
            : collect($app->tagged('database.attribute.filters'));

        $this->fieldFilters = core()->isElasticsearchEnabled()
            ? collect($app->tagged('elasticsearch.product.field.filters'))
            : collect($app->tagged('database.product.field.filters'));
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldFilter($field, $operator)
    {
        foreach ($this->fieldFilters as $filter) {
            if ($filter->supportsField($field)) {
                return $filter;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeFilter($attribute, $operator)
    {
        foreach ($this->attributeFilters as $filter) {
            if ($filter->supportsAttribute($attribute)) {
                return $filter;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldFilters()
    {
        return $this->fieldFilters;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeFilters()
    {
        return $this->attributeFilters;
    }
}

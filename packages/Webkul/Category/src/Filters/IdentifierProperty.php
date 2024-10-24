<?php

namespace Webkul\Category\Filters;

use Webkul\Product\Filters\IdentifierProperty as BaseIdentifierProperty;

/**
 * class IdentifierProperty
 *
 * Adds filter on repostiory for sku column
 */
class IdentifierProperty extends BaseIdentifierProperty
{
    /**
     * Identifier column
     */
    protected $identifierColumn = 'code';
}

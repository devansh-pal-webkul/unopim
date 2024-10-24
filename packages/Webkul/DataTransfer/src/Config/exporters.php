<?php

return [
    'products' => [
        'title'       => 'data_transfer::app.exporters.products.title',
        'exporter'    => 'Webkul\DataTransfer\Helpers\Exporters\Product\Exporter',
        'source'      => 'Webkul\Product\Repositories\ProductRepository',
        'sample_path' => 'data-transfer/samples/products.csv',
        'validator'   => 'Webkul\DataTransfer\Validators\JobInstances\Export\ProductJobValidator',
        'filters'     => [
            'fields' => [
                [
                    'name'       => 'file_format',
                    'title'      => 'File Format',
                    'type'       => 'select',
                    'required'   => true,
                    'validation' => 'required',
                    'options'    => [
                        [
                            'value' => 'Csv',
                            'label' => 'CSV',
                        ], [
                            'value' => 'Xls',
                            'label' => 'XLS',
                        ], [
                            'value' => 'Xlsx',
                            'label' => 'XLSX',
                        ],
                    ],
                ], [
                    'name'     => 'with_media',
                    'title'    => 'With Media',
                    'required' => false,
                    'type'     => 'boolean',
                ], [
                    'name'     => 'identifier',
                    'title'    => 'data_transfer::app.exporters.products.filters.sku',
                    'required' => false,
                    'type'     => 'textarea',
                ], [
                    'name'         => 'attribute_family',
                    'title'        => 'data_transfer::app.exporters.products.filters.attribute_family',
                    'required'     => false,
                    'type'         => 'multiselect',
                    'async'        => true,
                    'track_by'     => 'id',
                    'label_by'     => 'label',
                    'query_params' => [
                        'entityName' => 'family',
                    ],
                ], [
                    'name'         => 'product_type',
                    'title'        => 'data_transfer::app.exporters.products.filters.product_type',
                    'required'     => false,
                    'type'         => 'select',
                    'options'      => [
                        [
                            'label' => 'product::app.type.simple',
                            'value' => 'simple',
                        ], [
                            'label' => 'product::app.type.configurable',
                            'value' => 'configurable',
                        ],
                    ],
                ], [
                    'name'     => 'status',
                    'title'    => 'data_transfer::app.exporters.products.filters.status',
                    'required' => false,
                    'type'     => 'select',
                    'options'  => [
                        [
                            'label' => 'admin::app.common.enable',
                            'value' => "'true'",
                        ], [
                            'label' => 'admin::app.common.disable',
                            'value' => "'false'",
                        ],
                    ],
                ],
            ],
        ],
    ],

    'categories' => [
        'title'       => 'data_transfer::app.exporters.categories.title',
        'exporter'    => 'Webkul\DataTransfer\Helpers\Exporters\Category\Exporter',
        'source'      => 'Webkul\Category\Repositories\CategoryRepository',
        'sample_path' => 'data-transfer/samples/categories.csv',
        'validator'   => 'Webkul\DataTransfer\Validators\JobInstances\Export\CategoryJobValidator',
        'filters'     => [
            'fields' => [
                [
                    'name'       => 'file_format',
                    'title'      => 'File Format',
                    'type'       => 'select',
                    'required'   => true,
                    'validation' => 'required',
                    'options'    => [
                        [
                            'value' => 'Csv',
                            'label' => 'CSV',
                        ], [
                            'value' => 'Xls',
                            'label' => 'XLS',
                        ], [
                            'value' => 'Xlsx',
                            'label' => 'XLSX',
                        ],
                    ],
                ], [
                    'name'     => 'with_media',
                    'title'    => 'With Media',
                    'required' => false,
                    'type'     => 'boolean',
                ], [
                    'name'     => 'category_identifier',
                    'title'    => 'data_transfer::app.exporters.categories.filters.code',
                    'required' => false,
                    'type'     => 'textarea',
                ],
                
            ],
        ],
    ],
];

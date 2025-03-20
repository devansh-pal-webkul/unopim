<?php

namespace Webkul\Admin\DataGrids\Catalog;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class AttributeOptionDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $tablePrefix = DB::getTablePrefix();

        $queryBuilder = DB::table('attribute_options')
            ->leftJoin('attribute_option_translations as attribute_option_label', function ($join) {
                $join->on('attribute_option_label.attribute_option_id', '=', 'attribute_options.id');
            })
            ->where('attribute_options.attribute_id', request()->id)
            ->select(
                'attribute_options.id',
                'attribute_options.code',
            );

        $locales = core()->getAllActiveLocales()->pluck('code');

        foreach ($locales as $locale) {
            $localeColumn = $tablePrefix.'attribute_option_label.label';
            $labelColumn = 'name_'.$locale;

            $queryBuilder->addSelect(DB::raw(
                "(CASE WHEN {$localeColumn} IS NULL OR CHAR_LENGTH(TRIM({$localeColumn})) < 1 THEN NULL ELSE {$localeColumn} END) as {$labelColumn}"
            ));
        }

        $this->addFilter('id', 'attribute_options.id');

        return $queryBuilder;
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $locales = core()->getAllActiveLocales()->pluck('code');

        $currenctLocaleCode = core()->getCurrentLocale()?->code;

        $this->addColumn([
            'index'      => 'code',
            'label'      => trans('admin::app.catalog.attributes.index.datagrid.code'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        foreach ($locales as $locale) {
            $this->addColumn([
                'index'      => 'name_'.$locale,
                'label'      => \Locale::getDisplayName($locale, $currenctLocaleCode),
                'type'       => 'string',
                'searchable' => true,
                'filterable' => true,
                'sortable'   => true,
            ]);
        }

    }
}

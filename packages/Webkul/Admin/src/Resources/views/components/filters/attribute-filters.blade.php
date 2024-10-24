@props([
    'filterValues' => [],
    'old'          => [],
    'display'      => true,
])

@if ($display) 
    <v-attribute-filters :filter-values="@json($filterValues)" old-values="@json($old)"></v-attribute-filters>
@endif

@pushOnce('scripts')
    <script type="text/x-template" id="v-attribute-filters-template">
        <div class="flex gap-2">
            <x-admin::form.control-group.control
                class="flex-1"
                name="filters[attribute_filters]"
                type="select"
                async="true"
                ref="filterSelectControl"
                v-model="filter"
                track-by="code"
                label-by="label"
                entity-name="attributes"
            />
            <span
                class="primary-button flex-0"
                :class="{ 'cursor-not-allowed': !filterValue }"
                @click="addFilter"
            >
                @lang('admin::app.components.filters.attribute-filters.title')
            </span>
        </div>

        <div v-for="filter in attributeFilters" class="grid gap-1">
            <x-admin::form.control-group.label class="mt-3" v-text="filter.label" />

            <div class="flex gap-2 items-center">
                <div class="flex-0">
                    <x-admin::form.control-group.control
                        type="select"
                        ::name="'filters[attribute_filters][' + filter.code + '][operator]'"
                        ::options="this.getOperatorsForType(filter.type)"
                        ::value="this.getFilterValue(filter.code)?.operator"
                        rules="required"
                        track-by="value"
                        :label="trans('admin::app.components.filters.attribute-filters.operator')"
                        ::ref="filter.code + '_operator'"
                        v-model="selectedOperator"
                        @change="this.displayValueField(filter.code)"
                    />
    
                    <v-error-message
                        :name="'filters[attribute_filters][' + filter.code + '][operator]'"
                        v-slot="{ message }"
                    >
                        <p
                            class="mt-1 text-red-600 text-xs italic"
                            v-text="message"
                        >
                        </p>
                    </v-error-message>
                </div>

                <div class="flex-1" v-if="this.displayValueField(filter.code)" ::data-attr="this.displayValueField(filter.code)">
                    <x-admin::form.control-group.control
                        type="text"
                        ::name="'filters[attribute_filters][' + filter.code + '][value]'"
                        ::value="this.getFilterValue(filter.code)?.value"
                        :label="trans('admin::app.components.filters.attribute-filters.value')"
                        rules="required"
                    />
    
                    <v-error-message
                        :name="'filters[attribute_filters][' + filter.code + '][value]'"
                        v-slot="{ message }"
                    >
                        <p
                            class="mt-1 text-red-600 text-xs italic"
                            v-text="message"
                        >
                        </p>
                    </v-error-message>
                </div>

                <span
                    class="icon-delete text-xl cursor-pointer hover:bg-violet-50 dark:hover:bg-cherry-800 hover:rounded-md"
                    @click="removeFilter(filter.code)"
                >
                </span>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-attribute-filters', {
            template: '#v-attribute-filters-template',

            props: [
                'filterValues',
                'old'
            ],

            data() {
                return {
                    filter: '',
                    filterValue: '',
                    attributeFilters: [],
                    attributeFilterValues: this.parseValue(this.filterValues),
                    oldValues: this.parseValue(this.old),
                    operators: (@json(\Webkul\DataTransfer\Enums\Operators::getOperatorsWithTypes())),
                    selectedOperator: '',
                };
            },
            mounted() {
                this.initializeFilterLabels(Object.keys(this.attributeFilterValues));
            },
            watch: {
                filter(value) {
                    this.filterValue = this.parseValue(value);
                },
            },
            methods: {
                addFilter() {
                    if ('' === this.filterValue) {
                        return;
                    }

                    let alreadyExist = this.attributeFilters.filter(item => item.code === this.filterValue.code);

                    if (alreadyExist.length > 0) {
                        return;
                    }

                    this.attributeFilters.push(this.filterValue);

                    this.$refs.filterSelectControl.selectedValue = '';

                    this.filterValue = '';
                },

                parseValue(value) {
                    try {
                        return JSON.parse(value);
                    } catch (e) {
                        return value;
                    }
                },

                getFilterValue(fieldName) {
                    return (this.oldValues?.filters ? this.oldValues[fieldName] ?? null : null) ?? this.filterValues[fieldName];
                },

                removeFilter(filterCode) {
                    this.attributeFilters = this.attributeFilters.filter(item => item.code !== filterCode);
                },

                getOperatorsForType(type) {
                    return this.operators[type] ?? [];
                },

                initializeFilterLabels(filters) {
                    if (filters.length < 1) {
                        return;
                    }

                    let params = {
                        entityName: 'attributes',
                        page: 1,
                        identifiers: {
                            columnName: 'code',
                            values: filters
                        },
                    };

                    this.$axios.get('{{ route('admin.catalog.options.fetch-all')}}', {params: params})
                        .then((result) => {
                            this.attributeFilters = result.data.options;
                        })
                },

                displayValueField(filterName) {
                    const selectedOperator = this.$refs[filterName + '_operator'] ? this.$refs[filterName + '_operator'][0]?.selectedOption : '';

                    let shouldNotDisplayField = ['EMPTY', 'NOT_EMPTY', 'IS_TRUE', 'IS_FALSE'].includes(selectedOperator);

                    return ! shouldNotDisplayField;
                }
            }
        });
    </script>
@endPushOnce


<v-attribute-filters></v-attribute-filters>

@push('scripts')
    <script type="text/x-template" id="v-attribute-filters-template">
        <div class="flex gap-2">
            <x-admin::form.control-group.control
                class="flex-1"
                name="attribute_filters"
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
                Add filter
            </span>
        </div>


        <div v-for="filter in attributeFilters" class="grid grid-cols-3 mt-3 gap-2">
            <x-admin::form.control-group.label v-text="filter.label" />

            @php
                $optionsJson = [
                    ['label' => 'Equal to', 'value' => '='],
                    ['label' => 'Not equal to', 'value' => '!='],
                    ['label' => 'Like', 'value' => '!='],
                ];
            @endphp

            <x-admin::form.control-group.control
                type="select"
                ::name="'filters[' + filter.code + '][operator]'"
                :options="json_encode($optionsJson)"
            />

            <x-admin::form.control-group.control
                type="text"
                ::name="'filters[' + filter.code + '][value]'"
            />
        </div>
    </script>

    <script type="module">
        app.component('v-attribute-filters', {
            template: '#v-attribute-filters-template',

            data() {
                return {
                    filter: '',
                    filterValue: '',
                    attributeFilters: [],
                };
            },
            watch: {
                filter(value) {
                    this.filterValue = this.parseValue(value);
                }
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
                        return '';
                    }
                }
            }
        });
    </script>
@endpush

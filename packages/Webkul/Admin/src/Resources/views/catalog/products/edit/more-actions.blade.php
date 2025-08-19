{!! view_render_event('unopim.admin.catalog.product.edit.other-actions.before', ['product' => $product]) !!}

<v-custom-dropdown></v-custom-dropdown>

{!! view_render_event('unopim.admin.catalog.product.edit.other-actions.after', ['product' => $product]) !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-translate-attribute-template">
        <li
            class="w-full hover:bg-gray-100 dark:hover:bg-cherry-800 cursor-pointer p-3"
            @click="resetForm();fetchAttribute();fetchSourceLocales();fetchTargetLocales();$refs.translationModal.toggle();"
        >
            <span
                class="icon-language text-gray-700 w-full"
                title="@lang('admin::app.catalog.products.edit.translate.translate-btn')"
            >
                @lang('admin::app.catalog.products.edit.translate.translate-btn')
            </span>
        </li>

        <x-admin::form
            v-slot="{ meta, errors, handleSubmit }"
            as="div"
            ref="translationForm"
        >
            <form @submit="handleSubmit($event, translate)" ref="translationForm">
                <x-admin::modal ref="translationModal">
                    <x-slot:header>
                        <p class="flex  items-center text-lg text-gray-800 dark:text-white font-bold">
                            <span class="icon-magic text-2xl text-gray-800"></span>
                            @lang('admin::app.catalog.products.edit.translate.title')
                        </p>
                    </x-slot>
                    <x-slot:content>
                        <x-admin::form.control-group v-if="attributesOptions" >
                            <div class="flex flex-row gap-4 mb-5" v-show="! translatedValues && ! nothingToTranslate">
                                <x-admin::form.control-group.label class="required w-full">
                                    @lang('admin::app.catalog.products.edit.translate.attributes')
                                </x-admin::form.control-group.label>
                                <div class="w-full ">
                                    <x-admin::form.control-group.control
                                        type="multiselect"
                                        name="attributes"
                                        ref="attributesOptionsRef"
                                        rules="required"
                                        ::value="attributes"
                                        ::options="attributesOptions"
                                        class="w-full "
                                    >
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="attributes"></x-admin::form.control-group.error>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4" v-show="! translatedValues && ! nothingToTranslate">
                                <x-admin::form.control-group  >
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.catalog.products.edit.translate.source-channel')
                                    </x-admin::form.control-group.label>
                                    @php
                                        $channels = core()->getAllChannels();
                                        $options = [];
                                        foreach($channels as $channel)
                                        {
                                            $options[] = [
                                                'id' => $channel->code,
                                                'label' => $channel->name,
                                                ];
                                        }
                                        $optionsInJson = json_encode($options);
                                    @endphp
                                    <x-admin::form.control-group.control
                                        type="select"
                                        name="channel"
                                        rules="required"
                                        ::value="sourceChannel"
                                        :options="json_encode($options)"
                                        @input="getSourceLocale"
                                    >
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="channel"></x-admin::form.control-group.error>
                                </x-admin::form.control-group >

                                    <x-admin::form.control-group  >
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.catalog.products.edit.translate.target-channel')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="select"
                                            name="targetChannel"
                                            rules="required"
                                            ::value="targetChannel"
                                            :options="json_encode($options)"
                                            @input="getTargetLocale"
                                        >
                                        </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="targetChannel"></x-admin::form.control-group.error>
                                </x-admin::form.control-group >

                                <x-admin::form.control-group v-if="localeOption">
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.catalog.products.edit.translate.locale')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="select"
                                        name="locale"
                                        rules="required"
                                        ref="localelRef"
                                        ::value="sourceLocale"
                                        ::options="localeOption"
                                        @input="resetTargetLocales"
                                    >
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="locale"></x-admin::form.control-group.error>
                                </x-admin::form.control-group >

                                <x-admin::form.control-group v-if="targetLocOptions">
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.catalog.products.edit.translate.target-locales')
                                    </x-admin::form.control-group.label>
                                    <x-admin::form.control-group.control
                                        type="multiselect"
                                        id="section"
                                        ref="targetLocOptionsRef"
                                        name="targetLocale"
                                        rules="required"
                                        ::value="targetLocales"
                                        ::options="targetLocOptions"
                                        track-by="id"
                                        label-by="label"
                                    >
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="targetLocale"></x-admin::form.control-group.error>
                                </x-admin::form.control-group >
                            </div>

                            </x-admin::form.control-group >

                            <x-admin::form.control-group class="mt-5" v-if="translatedValues">
                            <div class="w-full">
                                <div class="flex flex-row justify-around gap-5 mb-4">
                                    <p class="text-sm text-gray-800 dark:text-white font-bold">@lang('admin::app.catalog.products.edit.translate.source-content')</p>
                                    <p class="text-sm text-gray-800 dark:text-white font-bold">@lang('admin::app.catalog.products.edit.translate.translated-content')</p>
                                </div>

                                <div v-for="(data,index) in translatedValues" :key="index" class="mb-4 flex flex-row gap-5">
                                    <div class="w-full">
                                        <div class="inline-flex justify-between w-full">
                                            <x-admin::form.control-group.label class="text-left pr-2">
                                                @{{data.fieldLabel}}
                                            </x-admin::form.control-group.label>
                                            <div class="self-end mb-2 text-xs flex gap-1 items-center">
                                                <span class="icon-channel uppercase box-shadow p-1 h-5 rounded-full bg-gray-100 border text- border-gray-200  text-gray-600 dark:!text-gray-600">
                                                    @{{sourceChannel}}
                                                </span>
                                                <span class="icon-language uppercase box-shadow p-1 h-5 rounded-full bg-gray-100 border border-gray-200  text-gray-600 dark:!text-gray-600">
                                                    @{{sourceLocale}}
                                                </span>
                                            </div>
                                        </div>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            class="h-[30px] w-full"
                                            ::name="data.fieldName"
                                            ::value="data.sourceData"
                                            readOnly
                                            disabled
                                            v-if="data.type == 'text'"
                                        />

                                        <x-admin::form.control-group.control
                                            type="textarea"
                                            class="h-[75px] w-full"
                                            ::name="data.fieldName"
                                            ::value="data.sourceData"
                                            readOnly
                                            disabled
                                            v-if="data.type == 'textarea'"
                                        />

                                    </div>

                                    <div class="w-full">
                                        <div class="inline-flex justify-between w-full">
                                            <x-admin::form.control-group.label class="text-left">
                                                @{{data.fieldLabel}}
                                            </x-admin::form.control-group.label>
                                            <div class="self-end mb-2 text-xs flex gap-1 items-center">
                                                <span class="icon-channel uppercase box-shadow p-1 h-5 rounded-full bg-gray-100 border text- border-gray-200 text-gray-600 dark:!text-gray-600">
                                                    @{{targetChannel}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="overflow-y-auto h-40 space-y-4 border rounded-lg p-2">
                                            <div v-for="(item, idx) in data.translatedData"
                                                :key="idx"
                                                class="flex flex-col space-y-0"
                                            >
                                                <x-admin::form.control-group.label class="flex justify-end text-right mb-0">
                                                    <span class="icon-language uppercase box-shadow p-1 h-5 rounded-full bg-gray-100 border border-gray-200 text-gray-600 dark:!text-gray-600">
                                                        @{{ item.locale }}
                                                    </span>
                                                </x-admin::form.control-group.label>

                                                <x-admin::form.control-group.control
                                                    type="text"
                                                    class="h-[30px] w-full border-gray-300 rounded mt-0"
                                                    ::name="`${data.fieldName}_${item.locale}`"
                                                    ::value="item.content"
                                                    v-model="item.content"
                                                    v-if="data.type == 'text'"
                                                />
                                                <x-admin::form.control-group.control
                                                    type="textarea"
                                                    class="h-[75px] w-full border-gray-300 rounded mt-0"
                                                    ::name="`${data.fieldName}_${item.locale}`"
                                                    ::value="item.content"
                                                    v-model="item.content"
                                                    v-if="data.type == 'textarea'"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="mt-5" v-if="nothingToTranslate">
                        <x-admin::form.control-group.label class="text-left">
                            @lang('admin::app.catalog.products.edit.translate.translated-content')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            class="h-[75px]"
                            name="content"
                            v-model="nothingToTranslate"
                        />
                    </x-admin::form.control-group>

                    </x-slot>

                    <x-slot:footer>
                    <div class="flex gap-x-2.5 items-center">
                        <template v-if="! translatedValues && ! nothingToTranslate">
                            <button
                                type="submit"
                                class="secondary-button"
                                ::disabled = "isLoading"
                            >
                                <!-- Spinner -->
                                <template v-if="isLoading">
                                    <img
                                        class="animate-spin h-5 w-5 text-violet-700"
                                        src="{{ unopim_asset('images/spinner.svg') }}"
                                    />

                                    @lang('admin::app.catalog.products.edit.translate.translating')
                                </template>

                                <template v-else>
                                    <span class="icon-magic text-2xl text-violet-700"></span>
                                    @lang('admin::app.catalog.products.edit.translate.translate-btn')
                                </template>
                            </button>
                        </template>

                        <template v-else>
                            <button
                                v-if="translatedValues"
                                type="button"
                                class="primary-button"
                                :disabled="!translatedValues"
                                @click="apply"
                            >
                                @lang('admin::app.catalog.products.edit.translate.apply')
                            </button>

                            <button
                                v-else-if="nothingToTranslate"
                                type="button"
                                class="secondary-button"
                                @click="cancel"
                            >
                                @lang('admin::app.catalog.products.edit.translate.cancel')
                            </button>
                        </template>
                    </div>

                    </x-slot>
                </x-admin::modal>
            </form>
        </x-admin::form>
    </script>
    <script type="module">
        app.component('v-translate-attribute', {
            template: '#v-translate-attribute-template',
            props: [
                'channelValue',
                'localeValue',
                'model',
                'channelTarget',
                'targetLocales'
            ],
            data() {
                return {
                    attributesOptions: null,
                    attributes: null,
                    targetLocOptions: null,
                    localeOption: null,
                    resourceId: "{{ request()->id }}",
                    sourceData: null,
                    translatedValues: null,
                    isLoading: false,
                    nothingToTranslate: '',
                    sourceLocale: this.localeValue,
                    sourceChannel: this.channelValue,
                    targetChannel: this.channelTarget,
                    targetLocales: this.targetLocales,
                    fieldType: this.fieldType,
                };
            },
            methods: {
                fetchAttribute() {
                    this.$axios.get("{{ route('admin.catalog.product.get_attribute') }}", {
                        params: {
                            productId: this.resourceId,
                            },
                        })
                        .then((response) => {
                            let options = response.data?.attributes;
                            this.attributesOptions = JSON.stringify(options);
                            this.attributes = options;
                            this.$nextTick(() => {
                                if (this.$refs['attributesOptionsRef']) {
                                    this.$refs['attributesOptionsRef'].selectedValue = options;
                                }
                            });

                        })
                        .catch((error) => {
                        console.error('Error fetching attributes:', error);
                            throw error;
                        });
                },

                fetchSourceLocales() {
                    this.getLocale(this.sourceChannel)
                        .then((options) => {
                            this.localeOption = JSON.stringify(options);
                        })
                        .catch((error) => {
                            console.error('Error fetching source locales:', error);
                        });
                },

                fetchTargetLocales() {
                    this.getLocale(this.targetChannel)
                        .then((options) => {
                            if (this.targetChannel === this.sourceChannel) {
                                options = options.filter(option => option.id != this.sourceLocale);
                            }

                            this.targetLocOptions = JSON.stringify(options);
                        })
                        .catch((error) => {
                            console.error('Error fetching target locales:', error);
                        });
                },

                getSourceLocale(event) {
                    if (event) {
                        this.sourceChannel = JSON.parse(event).id;

                        this.getLocale(this.sourceChannel)
                            .then((options) => {
                                if (this.$refs['localelRef']) {
                                    this.$refs['localelRef'].selectedValue = null;
                                }

                                this.localeOption = JSON.stringify(options);

                                if (options.length == 1) {
                                    this.sourceLocale = options[0].id;

                                    if (this.$refs['localelRef']) {
                                        this.$refs['localelRef'].selectedValue = options[0];
                                    }
                                }
                            })
                            .catch((error) => {
                                console.error('Error fetching source locales:', error);
                            });
                    }
                },    

                getTargetLocale(event) {
                    if (event) {
                        this.targetChannel = JSON.parse(event).id;

                        this.getLocale(this.targetChannel)
                            .then((options) => {
                                if (this.$refs['targetLocOptionsRef']) {
                                    this.$refs['targetLocOptionsRef'].selectedValue = null;
                                }

                                if (this.targetChannel === this.sourceChannel) {
                                    options = options.filter(option => option.id != this.sourceLocale);
                                }

                                this.targetLocOptions = JSON.stringify(options);
                                this.targetLocales = options;

                                if (this.$refs['targetLocOptionsRef']) {
                                    this.$refs['targetLocOptionsRef'].selectedValue = options;
                                }
                            })
                            .catch((error) => {
                                console.error('Error fetching source locales:', error);
                            });
                    }
                },   

                resetTargetLocales(event) {
                    if (event) {
                        this.sourceLocale = JSON.parse(event).id;
                        this.getLocale(this.targetChannel)
                            .then((options) => {
                                if (this.$refs['targetLocOptionsRef']) {
                                    this.$refs['targetLocOptionsRef'].selectedValue = null;
                                }
                                if (this.targetChannel === this.sourceChannel) {
                                    options = options.filter(option => option.id != this.sourceLocale);
                                }
                                this.targetLocOptions = JSON.stringify(options);
                                this.targetLocales = options;
                                if (this.$refs['targetLocOptionsRef']) {
                                    this.$refs['targetLocOptionsRef'].selectedValue = options;
                                }
                            })
                            .catch((error) => {
                                    console.error('Error fetching source locales:', error);
                            });

                    }
                },

                getLocale(channel) {
                    return this.$axios.get("{{ route('admin.catalog.product.get_locale') }}", {
                            params: {
                                channel: channel,
                            },
                        })
                        .then((response) => {
                            return response.data?.locales || [];
                        })
                        .catch((error) => {
                            console.error('Error fetching locales:', error);
                            throw error;
                        });
                },

                translate(params, {
                    resetForm,
                    resetField,
                    setErrors
                }) {
                    this.isLoading = true;
                    if (! this.$refs.translationForm) {
                        console.error("translationForm reference is missing.");
                        return;
                    }

                    const formData = new FormData(this.$refs.translationForm);
                    let locale = params['locale'];
                    formData.append('model', this.model);
                    formData.append('resource_id', this.resourceId);
                    formData.append('resource_type', 'product');
                    this.$axios.post("{{ route('admin.magic_ai.translate.all.attribute') }}", formData)
                        .then((response) => {
                            this.isLoading = false;
                            let translatedData = response.data;
                            if (translatedData.length != 0) {
                                this.translatedValues = response.data;
                            } else {
                                this.nothingToTranslate = 'Data not available for translate on the basis of source channel and locale';
                            }
                        })
                        .catch((error) => {
                            this.isLoading = false;
                            console.error("Error in translation request:", error);
                            if (setErrors) {
                                setErrors(error.response?.data?.errors || {});
                            }
                        });
                },

                apply() {
                    const translatedData = this.translatedValues.map(item => ({
                        field: item.fieldName,
                        isTranslatable: item.isTranslatable,
                        source: item.sourceData,
                        translations: item.translatedData.map(translation => ({
                            locale: translation.locale,
                            content: translation.content
                        })),
                    }));

                    const formData = new FormData(this.$refs.translationForm);
                    formData.append('resource_id', this.resourceId);
                    formData.append('resource_type', 'product');
                    formData.append('translatedData', JSON.stringify(translatedData));
                    this.$axios.post("{{ route('admin.magic_ai.store.translated.all_attribute') }}", formData)
                        .then((response) => {
                            this.$refs.translationModal.close();
                            this.$emitter.emit('add-flash', {
                                type: 'success',
                                message: response.data.message,
                            });
                        })
                        .catch((error) => {
                            console.error("Error in translation store request:", error);
                        });
                },

                cancel() {
                    this.$refs.translationModal.close();
                    this.resetForm();
                },

                resetForm() {
                    this.translatedValues = null;
                    this.localeOption = null;
                    this.nothingToTranslate = null;
                    this.targetLocOptions = null;
                }

            },
        });
    </script>
    <script type="text/x-template" id="v-custom-dropdown-template">
        <div class="relative inline-block text-left">
            <span
                class="text-2xl cursor-pointer flex p-2 w-full"
                @click="toggleDropdown"
                title="@lang('admin::app.catalog.products.edit.more-actions')"
            >
                <span class="icon-dot w-3"></span>
                <span class="icon-dot w-3"></span>
                <span class="icon-dot w-3"></span>
            </span>

            <div v-if="isOpen" class="absolute right-0.5 top-0.5 w-36 max-sm:left-1/2 bg-white dark:bg-cherry-900 shadow-lg z-[10001] text-gray-700 border-2 border-violet-100 dark:border-cherry-800 min-h[110px] rounded-md">
                <header class="text-sm text-violet-600 dark:text-slate-50 p-2 mx-2">
                    <h6 class="py-2 border-b-2 border-violet-700">
                        @lang('admin::app.catalog.products.edit.more-actions')
                    </h6>
                </header>
                <ul class="text-gray-700 rounded cursor-pointer]">
                    {!! view_render_event('unopim.admin.catalog.product.edit.other-actions.list.before', ['product' => $product]) !!}

                    @php
                        $channelValue = core()->getConfigData('general.magic_ai.translation.source_channel');
                        $localeValue = core()->getConfigData('general.magic_ai.translation.source_locale');
                        $targetChannel = core()->getConfigData('general.magic_ai.translation.target_channel');
                        $targetlocales = core()->getConfigData('general.magic_ai.translation.target_locale');
                        $targetlocales = json_encode(explode(',', $targetlocales) ?? []);
                        $model = core()->getConfigData('general.magic_ai.translation.ai_model');
                    @endphp
                    @if (core()->getConfigData('general.magic_ai.translation.enabled'))
                        <v-translate-attribute
                            :channel-value="{{ json_encode($channelValue) }}"
                            :locale-value='@json($localeValue)'
                            :channel-target="{{ json_encode($targetChannel) }}"
                            :target-locales="{{$targetlocales}}"
                            :model="'{{$model}}'"
                        >
                        </v-translate-attribute>
                    @endif

                    {!! view_render_event('unopim.admin.catalog.product.edit.other-actions.list.after', ['product' => $product]) !!}
                </ul>
            </div>
        </div>
    </script>
    <script type="module">
        app.component('v-custom-dropdown', {
            template: '#v-custom-dropdown-template',
            data() {
                return {
                    isOpen: false,
                };
            },
            methods: {
                toggleDropdown() {
                    this.isOpen = !this.isOpen;
                },

                closeDropdown(event) {
                    if (!this.$el.contains(event.target)) {
                        this.isOpen = false;
                    }
                },

                hideMenu() {
                    this.isOpen = false;
                }
            },
            mounted() {
                document.addEventListener('click', this.closeDropdown);
            },
            beforeUnmount() {
                document.removeEventListener('click', this.closeDropdown);
            },
        });
    </script>
@endPushOnce

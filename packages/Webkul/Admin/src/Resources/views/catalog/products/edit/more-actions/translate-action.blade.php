
@php
    $channelValue = core()->getConfigData('general.magic_ai.translation.source_channel');
    $localeValue = core()->getConfigData('general.magic_ai.translation.source_locale');
    $targetChannel = core()->getConfigData('general.magic_ai.translation.target_channel');
    $targetlocales = core()->getConfigData('general.magic_ai.translation.target_locale');
    $targetlocales = json_encode(explode(',', $targetlocales) ?? []);
    $model = core()->getConfigData('general.magic_ai.translation.ai_model');
@endphp

<v-translate-attribute
    :channel-value="{{ json_encode($channelValue) }}"
    :locale-value='@json($localeValue)'
    :channel-target="{{ json_encode($targetChannel) }}"
    :target-locales="{{$targetlocales}}"
    :model="'{{$model}}'"
>
</v-translate-attribute>

@pushOnce('scripts')
    <script type="text/x-template" id="v-translate-attribute-template">
        <li
            class="w-full hover:bg-gray-100 dark:hover:bg-cherry-800 cursor-pointer px-3 py-2"
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
                            @lang('admin::app.catalog.products.edit.translate.title')
                        </p>
                    </x-slot>
                    <x-slot:content class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">
                        <section class="left-column flex flex-col gap-2 flex-2 w-full">
                            <section class="grid gap-2 items-center justify-center modal-steps-section mb-4 dark:text-white">
                                <div class="flex justify-center items-center">
                                    <div class="w-3 h-3 bg-violet-700 rounded-full"></div>
                                    <hr class="w-[200px] dark:bg-cherry-600 h-1 border-0" :class="currentStep === 2 ? 'bg-violet-700' : 'bg-violet-100'">
                                    <div class="w-3 h-3 bg-violet-400 rounded-full" :class="currentStep === 2 ? 'bg-violet-700' : 'bg-violet-400'"></div>
                                </div>
    
                                <div class="flex justify-around items-center text-center dark:text-slate-50">
                                    <p class="text-sm" :class="currentStep === 1 ? 'text-violet-700' : ''"> Step 1 <br> Select Source</p>
                                    <p class="text-sm" :class="currentStep === 2 ? 'text-violet-700' : ''"> Step 2 <br> Select Target</p>
                                </div>
    
                                Step 1: Select Source Channel, Language and Attributes
                            </section>
    
                            <section class="bg-violet-50 dark:bg-cherry-800 rounded-md mb-2 p-3" id="step-1">
                                <h3 class="dark:text-white mb-2 text-sm font-bold">
                                    Source Content
                                </h3>
    
                                <!-- Source Channel -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.catalog.products.edit.translate.source-channel')
                                    </x-admin::form.control-group.label>
                                    @php
                                        $channels = core()->getAllChannels();
                                        $options = [];
    
                                        foreach ($channels as $channel) {
                                            $channelName = $channel->name;
    
                                            $options[] = [
                                                'id'    => $channel->code,
                                                'label' => empty($channelName) ? "[$channel->code]" : $channelName,
                                            ];
                                        }
    
                                        $optionsInJson = json_encode($options);
                                    @endphp
                                    <x-admin::form.control-group.control
                                        type="select"
                                        name="channel"
                                        rules="required"
                                        ::value="sourceChannel"
                                        :options="$optionsInJson"
                                        @input="getSourceLocale"
                                    >
                                    </x-admin::form.control-group.control>
    
                                    <x-admin::form.control-group.error control-name="channel"></x-admin::form.control-group.error>
                                </x-admin::form.control-group >
    
                                <!-- Source Locale -->
                                <x-admin::form.control-group v-if="localeOption">
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.catalog.products.edit.translate.locale')
                                    </x-admin::form.control-group.label>
    
                                    <x-admin::form.control-group.control
                                        type="select"
                                        name="locale"
                                        rules="required"
                                        ref="localeRef"
                                        ::value="sourceLocale"
                                        ::options="localeOption"
                                        @input="resetTargetLocales"
                                    >
                                    </x-admin::form.control-group.control>
    
                                    <x-admin::form.control-group.error control-name="locale"></x-admin::form.control-group.error>
                                </x-admin::form.control-group >
    
                                <!-- Attributes -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required w-full">
                                        @lang('admin::app.catalog.products.edit.translate.attributes')
                                    </x-admin::form.control-group.label>
                                    <div class="w-full ">
                                        <x-admin::form.control-group.control
                                            type="multiselect"
                                            name="attributes"
                                            ref="attributesOptionsRef"
                                            rules="required"
                                            ::value="attributes ?? []"
                                            ::options="attributesOptions"
                                            class="w-full"
                                        />
    
                                        <x-admin::form.control-group.error control-name="attributes" />
                                    </div>
                                </x-admin::form.control-group>
                            </section>
    
                            <template v-if="currentStep === 2">
                                <h2 class="mt-6 mb-2 text-center">Step 2: Select Target Channel and Languages</h2>
                                <section class="bg-violet-50 dark:bg-cherry-800 rounded-md mb-2 p-3" id="step-2">
                                    <h3 class="dark:text-white mb-2 text-sm font-bold">
                                        Target Content
                                    </h3>
    
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.catalog.products.edit.translate.target-channel')
                                        </x-admin::form.control-group.label>
                                        <x-admin::form.control-group.control
                                            type="select"
                                            name="targetChannel"
                                            rules="required"
                                            ::value="targetChannel"
                                            :options="$optionsInJson"
                                            @input="getTargetLocale"
                                        />
                                        <x-admin::form.control-group.error control-name="targetChannel" />
                                    </x-admin::form.control-group>
    
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
                                        />
                                        <x-admin::form.control-group.error control-name="targetLocale" />
                                    </x-admin::form.control-group>
                                </section>
                            </template>
    
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
                        </section>
                        <section class="right-column flex flex-col gap-2 w-full flex-1 max-xl:flex-auto" v-if="translatedValues">
                            <x-admin::form.control-group class="mt-5">
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
                        </section>
                    </x-slot>

                    <x-slot:footer>
                        <div class="flex gap-x-2.5 items-center">
                            <template v-if="currentStep === 1">
                                <button
                                    type="button"
                                    class="secondary-button"
                                    @click="nextStep"
                                >
                                    Next
                                </button>
                            </template>
                            <template v-else-if="currentStep === 2 && ! translatedValues && ! nothingToTranslate">
                                <button
                                    type="button"
                                    class="secondary-button"
                                    @click="cancel"
                                    ::disabled="isLoading"
                                >
                                    @lang('admin::app.catalog.products.edit.translate.cancel')
                                </button>
                                <button
                                    type="submit"
                                    class="primary-button"
                                    ::disabled="isLoading"
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
                    currentStep: 1,
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
                                if (this.$refs['localeRef']) {
                                    this.$refs['localeRef'].selectedValue = null;
                                }

                                this.localeOption = JSON.stringify(options);

                                if (options.length == 1) {
                                    this.sourceLocale = options[0].id;

                                    if (this.$refs['localeRef']) {
                                        this.$refs['localeRef'].selectedValue = options[0];
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

                                this.$emitter.emit('modal-size-change', 'large');
                            } else {
                                this.nothingToTranslate = 'Data not available for translation in the source channel and locale';
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
                },
                nextStep(e) {
                    e.stopPropagation();

                    this.currentStep += 1;
                }
            },
        });
    </script>
@endPushOnce

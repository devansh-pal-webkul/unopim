@props([
    'globaltranslationEnabled' => core()->getConfigData('general.magic_ai.translation.enabled'),
    'channelValue'             => core()->getConfigData('general.magic_ai.translation.source_channel'),
    'localeValue'              => core()->getConfigData('general.magic_ai.translation.source_locale'),
    'targetChannel'            => core()->getConfigData('general.magic_ai.translation.target_channel'),
    'targetlocales'            => json_encode(explode(',', core()->getConfigData('general.magic_ai.translation.target_locale')) ?? []),
    'model'                    => core()->getConfigData('general.magic_ai.translation.ai_model'),
])

<v-translate-form
    :channel-value="{{ json_encode($channelValue) }}"
    :locale-value='@json($localeValue)'
    :channel-target="{{ json_encode($targetChannel) }}"
    :target-locales="{{$targetlocales}}"
    :id="'{{$field->code}}'"
    :value="'{{ json_encode(e($value)) }}'"
    :field="'{{$fieldLabel}}'"
    :field-type="'{{$fieldType}}'"
    :model="'{{$model}}'"
    :current-local-code="'{{ $currentLocaleCode }}'"
    :current-channel="'{{ $currentChannelCode }}'"
>
    <div class="flex  gap-4 justify-between items-center max-sm:flex-wrap">
        <div class="flex gap-x-2.5 items-center">
            <button
                type="button"
                class="secondary-button bg-violet-50 text-violet-700 focus:ring-indigo-200 border border-indigo-200 rounded-lg px-2 h-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_3148_2242)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1484 9.31989L9.31995 12.1483L19.9265 22.7549L22.755 19.9265L12.1484 9.31989ZM12.1484 10.7341L10.7342 12.1483L13.5626 14.9767L14.9768 13.5625L12.1484 10.7341Z" fill="#6d28d9" />
                        <path d="M11.0877 3.30949L13.5625 4.44748L16.0374 3.30949L14.8994 5.78436L16.0374 8.25924L13.5625 7.12124L11.0877 8.25924L12.2257 5.78436L11.0877 3.30949Z" fill="#6d28d9" />
                        <path d="M2.39219 2.39217L5.78438 3.95197L9.17656 2.39217L7.61677 5.78436L9.17656 9.17655L5.78438 7.61676L2.39219 9.17655L3.95198 5.78436L2.39219 2.39217Z" fill="#6d28d9" />
                        <path d="M3.30947 11.0877L5.78434 12.2257L8.25922 11.0877L7.12122 13.5626L8.25922 16.0374L5.78434 14.8994L3.30947 16.0374L4.44746 13.5626L3.30947 11.0877Z" fill="#6d28d9" />
                    </g>
                    <defs>
                        <clipPath id="clip0_3148_2242">
                            <rect width="24" height="24" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                @lang('admin::app.catalog.products.edit.translate.translate-btn')
            </button>
        </div>
    </div>
</v-translate-form>
@pushOnce('scripts')
    <script type="text/x-template" id="v-translate-form-template">
        <div class="flex  gap-4 justify-between items-center max-sm:flex-wrap">
            <div class="flex gap-x-2.5 items-center">
                <!-- translate Button -->
                <button
                    type="button"
                    class="secondary-button bg-violet-50 text-violet-700 focus:ring-indigo-200 border border-indigo-200 rounded-lg px-2 h-5"
                    @click="resetForm();fetchSourceLocales();fetchTargetLocales();$refs.translationModal.toggle();"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none">
                        <g clip-path="url(#clip0_3148_2242)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1484 9.31989L9.31995 12.1483L19.9265 22.7549L22.755 19.9265L12.1484 9.31989ZM12.1484 10.7341L10.7342 12.1483L13.5626 14.9767L14.9768 13.5625L12.1484 10.7341Z" fill="#6d28d9"/>
                            <path d="M11.0877 3.30949L13.5625 4.44748L16.0374 3.30949L14.8994 5.78436L16.0374 8.25924L13.5625 7.12124L11.0877 8.25924L12.2257 5.78436L11.0877 3.30949Z" fill="#6d28d9"/>
                            <path d="M2.39219 2.39217L5.78438 3.95197L9.17656 2.39217L7.61677 5.78436L9.17656 9.17655L5.78438 7.61676L2.39219 9.17655L3.95198 5.78436L2.39219 2.39217Z" fill="#6d28d9"/>
                            <path d="M3.30947 11.0877L5.78434 12.2257L8.25922 11.0877L7.12122 13.5626L8.25922 16.0374L5.78434 14.8994L3.30947 16.0374L4.44746 13.5626L3.30947 11.0877Z" fill="#6d28d9"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_3148_2242">
                                <rect width="24" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    @lang('admin::app.catalog.products.edit.translate.translate-btn')
                </button>
            </div>
        </div>
        <div>
            <x-admin::form
                v-slot="{ meta, errors, handleSubmit }"
                as="div"
                ref="translationForm"
            >
                <form @submit="handleSubmit($event, translate)" ref="translationForm">
                    <x-admin::modal ref="translationModal">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <p class="flex  items-center text-lg text-gray-800 dark:text-white font-bold">
                                <span class="icon-magic text-2xl text-gray-800"></span>
                                @lang('admin::app.catalog.products.edit.translate.title')
                            </p>
                        </x-slot>
                        <!-- Modal Content -->

                        <x-slot:content>
                            <div class="grid grid-cols-2 gap-4" v-show="! translatedData && ! nothingToTranslate">
                                <x-admin::form.control-group  >
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

                                <x-admin::form.control-group  >
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
                                        ref="localeRef"
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

                            <!-- Generated Content -->
                            <x-admin::form.control-group class="mt-5 flex flex-row gap-5" v-if="translatedData">
                                <div class="w-full">
                                    <x-admin::form.control-group.label class="flex items-center justify-center mb-4">
                                        <p class="text-sm text-gray-800 dark:text-white font-bold">@lang('admin::app.catalog.products.edit.translate.source-content')</p>
                                    </x-admin::form.control-group.label>

                                    <div class="inline-flex justify-between w-full">
                                        <x-admin::form.control-group.label class="text-left pr-2">
                                            @{{field}}
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
                                        class="h-[30px]"
                                        name="content"
                                        v-model="sourceData"
                                        readOnly
                                        disabled
                                        v-if="fieldType === 'text'"
                                    />
                                    <x-admin::form.control-group.control
                                        type="textarea"
                                        class="h-[75px]"
                                        name="content"
                                        v-model="sourceData"
                                        readOnly
                                        disabled
                                        v-if="fieldType === 'textarea'"
                                    />
                                </div>
                                <div class="w-full">
                                    <x-admin::form.control-group.label class="flex items-center justify-center mb-4">
                                        <p class="text-sm text-gray-800 dark:text-white font-bold">@lang('admin::app.catalog.products.edit.translate.translated-content')</p>
                                    </x-admin::form.control-group.label>
                                    <div class="inline-flex justify-between w-full">
                                        <x-admin::form.control-group.label class="text-left">
                                            @{{field}}
                                        </x-admin::form.control-group.label>
                                        <div class="self-end mb-2 text-xs flex gap-1 items-center">
                                            <span class="icon-channel uppercase box-shadow p-1 h-5 rounded-full bg-gray-100 border text- border-gray-200 text-gray-600 dark:!text-gray-600">
                                                @{{targetChannel}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="overflow-y-auto h-40 space-y-4 border rounded-lg p-2">
                                        <div v-for="(item, index) in translatedData"
                                            :key="index"
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
                                                ::name="item.locale"
                                                v-model="item.content"
                                                v-if="fieldType === 'text'"
                                            />
                                            <x-admin::form.control-group.control
                                                type="textarea"
                                                class="h-[75px] w-full border-gray-300 rounded mt-0"
                                                ::name="item.locale"
                                                v-model="item.content"
                                                v-if="fieldType === 'textarea'"
                                            />
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
                            <div class="flex gap-x-2.5 items-center text-base">
                                <template v-if="! translatedData && ! nothingToTranslate">
                                    <button
                                        type="submit"
                                        class="secondary-button"
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
                                        v-if="translatedData"
                                        type="button"
                                        class="primary-button"
                                        :disabled="!translatedData"
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
        </div>
    </script>

    <script type="module">
        app.component('v-translate-form', {
            template: '#v-translate-form-template',
            props: [
                'currentChannel',
                'currentLocalCode',
                'field',
                'fieldType',
                'selector',
                'value',
                'id',
                'channelValue',
                'localeValue',
                'model',
                'channelTarget',
                'targetLocales'

            ],
            data() {
                return {
                    targetLocOptions: null,
                    localeOption: null,
                    resourceId: "{{ request()->id }}",
                    sourceData: null,
                    translatedData: null,
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
                    if (!this.$refs.translationForm) {
                        console.error("translationForm reference is missing.");
                        return;
                    }

                    const formData = new FormData(this.$refs.translationForm);
                    let locale = params['locale'];
                    formData.append('model', this.model);
                    formData.append('resource_id', this.resourceId);
                    formData.append('resource_type', 'product');
                    formData.append('field', this.id);

                    this.$axios.post("{{route('admin.magic_ai.check.is_translatable')}}", formData)
                        .then((response) => {
                            if (response.data.isTranslatable) {
                                this.sourceData = response.data.sourceData;
                                this.$axios.post("{{ route('admin.magic_ai.translate') }}", formData)
                                    .then((response) => {
                                        this.isLoading = false;
                                        this.translatedData = response.data.translatedData;
                                    })
                                    .catch((error) => {
                                        console.error("Error in translation request:", error);
                                        if (setErrors) {
                                            setErrors(error.response?.data?.errors || {});
                                        }
                                    });
                            } else {
                                this.nothingToTranslate = 'Data not available for translate on the basis of source channel and locale';
                                this.isLoading = false;
                            }
                        })
                        .catch((error) => {
                            console.error("Error in translation check request:", error);
                        });
                },

                apply() {
                    const translatedData = this.translatedData.map(item => ({
                        locale: item.locale,
                        content: item.content,
                    }));

                    const formData = new FormData(this.$refs.translationForm);
                    formData.append('resource_id', this.resourceId);
                    formData.append('resource_type', 'product');
                    formData.append('field', this.id);
                    formData.append('translatedData', JSON.stringify(translatedData));
                    this.$axios.post("{{ route('admin.magic_ai.store.translated') }}", formData)
                        .then((response) => {
                            this.$refs.translationModal.close();
                            this.$emitter.emit('add-flash', {
                                type: 'success',
                                message: response.data.message,
                            });
                        })
                        .catch((error) => {

                        });
                },

                cancel() {
                    this.$refs.translationModal.close();
                    this.resetForm();
                },

                resetForm() {
                    this.translatedData = null;
                    this.localeOption = null;
                    this.nothingToTranslate = null;
                    this.targetLocOptions = null;
                }
            }
        });
    </script>
@endPushOnce

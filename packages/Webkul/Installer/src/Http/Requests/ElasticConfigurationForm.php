<?php

namespace Webkul\Installer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElasticConfigurationForm extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'elasticsearch_host'         => 'required_if:elasticsearch_enabled,true',
            'elasticsearch_connection'   => 'required_if:elasticsearch_enabled,true',
            'elasticsearch_api_key'      => 'required_if:elasticsearch_connection,api',
            'elasticsearch_cloud_id'     => 'required_if:elasticsearch_connection,cloud',
            'elasticsearch_index_prefix' => 'not_regex:/[^A-Za-z0-9_]/',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(array_map(function ($input) {
            return strip_tags($input);
        }, $this->all()));

        $this->merge([
            'elasticsearch_enabled' => (bool) $this->elasticsearch_enabled ?? false,
        ]);
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Extension;
use App\Models\FakeApiExtension;
use Illuminate\Foundation\Http\FormRequest;

class ExtensionStoreRequest extends FormRequest
{
    public $api_extensions_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'extension' => [
                'bail',
                'required',
                'integer',
                sprintf('unique:%s,api_extension_id', Extension::class),
                sprintf('in:%s', $this->api_extensions_id)
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->api_extensions_id = FakeApiExtension::all()->pluck('id')->implode(',');
    }

    public function validated()
    {
        $apiExtension = FakeApiExtension::find( $this->extension );

        return array_merge(parent::validated(), [
            'api_extension_id' => $apiExtension->id,
            'name' => $apiExtension->name,
            'classname' => $apiExtension->classname,
            'description' => $apiExtension->description,
        ]);
    }
}

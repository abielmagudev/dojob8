<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class FileSaveRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-files');
    }

    public function rules()
    {
        return [
            'file' => [
                'bail',
                'required',
                'file',
                sprintf('mimes:%s', File::getMimeTypes()->implode(',')),
                'max:5120',
            ],
            'folder' => [
                'bail',
                'required',
                sprintf('in:%s', File::getFolders()->implode(',')),
            ],
            'fileable_id' => [
                'bail',
                sprintf('required_if:folder,%', File::getFolders()->implode(',')),
                sprintf('exists:%s,id', File::getFileableClass( $this->get('folder') )),
            ],
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'Maximum file size is 5MB',
            'folder.*' => 'Folder does not exist',
            'fileable_id.*' => 'Model does not exist',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'folder' => $this->route('folder'),
            'fileable_id' => $this->route('fileable_id'),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors()->all(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}

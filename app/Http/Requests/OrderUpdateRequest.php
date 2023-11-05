<?php

namespace App\Http\Requests;

use App\Http\Requests\OrderRequest\ResolveExtensionRequestsTrait;
use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{    
    use ResolveExtensionRequestsTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'scheduled_date' => [
                'required',
                'date',
            ],
            'scheduled_time' => [
                'required',
                'date_format:H:i',
            ],
            'notes' => [
                'nullable',
            ],
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'cache' => [
                'extensions' => $this->route('order')->job->extensions,
                'resolved_requests' => $this->resolveExtensionRequests(
                    $this->route('order')->job->extensions,
                    'update'
                ),
            ],
        ]);
    }
}

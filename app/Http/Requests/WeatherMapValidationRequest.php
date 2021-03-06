<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherMapValidationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => 'required|string|min:2|regex:/^[\p{L}\p{N} +?.-]+$/u'
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return ['regex' => 'Latin letters only'];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; 
use App\Rules\IgnoreSoftDeleted;

class StoreMakeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new IgnoreSoftDeleted('makes', 'name'),
            ],
            'description' => 'nullable|string',
            'founding_year' => 'nullable|integer|min:1850',
            'country_of_origin' => 'nullable|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Validation\Rule;

class UpdateMakeRequest extends FormRequest
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
        $makeId = $this->route()->marca->id;
        
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('makes')->ignore($makeId),
            ],
            'description' => 'nullable|string',
            'founding_year' => 'nullable|integer|min:1850',
            'country_of_origin' => 'nullable|string|max:255',
        ];
    }
}

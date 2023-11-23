<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'make_id' => 'sometimes|required|exists:makes,id',
            'vehicle_model_id' => 'sometimes|required|exists:vehicle_models,id',
            'price' => 'sometimes|required|numeric|min:0',
            'image_path' => 'nullable',
        ];
    }
}

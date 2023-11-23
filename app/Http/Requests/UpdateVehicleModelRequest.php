<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleModelRequest extends FormRequest
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
        $vehicleModelId = $this->route()->modelo->id;

        return [
            'make_id' => 'required|exists:makes,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('makes')->ignore($vehicleModelId),
            ],
            'manufacturing_year' => 'required|integer|min:1850',
            'fuel_type' => 'required|in:Gasolina,Diesel,Elétrico,GNV,Flex,Etanol,Híbrido,Outro',
            'type' => 'required|in:Carro,Motocicleta,Caminhão,Outro',
        ];
    }
}

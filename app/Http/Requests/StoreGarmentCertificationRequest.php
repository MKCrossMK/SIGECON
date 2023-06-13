<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGarmentCertificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'a_description' => 'required|',
            'a_carat' => 'required',
            'image' => 'required',
            'a_weight' => 'required',
            'a_stone_type' => 'required',
        ];
    }


      /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'client_id.required' => 'Cliente Requerido para generar esta certificación.',
            'a_description.required' => 'Descripción de la prenda es requerida.',
            'a_carat.required' => 'Quilate de la prenda es requerido.',
            'a_weight.required' => 'Peso de prenda es requerido',
            'a_image.required' => 'Imagen de prenda requerida',
            'a_stone_type.required' => 'Tipo de piedra es requirido',
            'client_id.required' => 'Cliente Requerido para generar esta certificación.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOldPolicyRequest extends FormRequest
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
            'number_policy' => 'required|unique:old_policies',
            'status' => 'required',
            'client_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'capital_pay' => 'required|numeric|min:0|not_in:0'
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
            'number_policy.required' => 'Numero de Poliza es Requerido',
            'number_policy.unique' => 'Numero de Poliza registrado, asegure el numero de poliza sea correcto',
            'client_id.required' => 'Cliente Requerido para generar esta poliza.',
            'date_start.required' => 'Fecha de emisión es requerida.',
            'date_end.required' => 'Fecha de vencimiento es requerida.',
            'capital_pay.required' => 'Total no fue expresado, revisar todo.',
            'status.required' => 'Estado de poliza es requerido.',

        ];
    }
}

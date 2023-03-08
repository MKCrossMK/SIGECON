<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionRequest extends FormRequest
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
           'date_to_celebrate' => 'required|after:yesterday',
           'branch_office_celebrate_id' => 'required',
           'places' => 'required|numeric|min:5',
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
            'date_to_celebrate.required' => 'Fecha de celebración es requerida',
            'date_to_celebrate.after' => 'La fecha de celebración de la subasta debe ser una posterior a ayer',
            'branch_office_celebrate_id.required' => 'Lugar de celebración de la subasta es requirido',
            'places.required' => 'Numero de cupos para la subasta es requerido',
            'places.numeric' => 'Numero de cupos debe tener formato numerico',
            'places.min' => 'Debe tener minimo 5 cupos para la subasta',
        ];
    }


}

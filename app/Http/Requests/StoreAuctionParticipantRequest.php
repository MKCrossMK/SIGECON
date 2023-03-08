<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionParticipantRequest extends FormRequest
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
            'name' => 'required',
            'cedula' => 'required|unique:auction_participants',
            'number_paddle' => 'numeric|unique:participant_on_auctions|nullable|min:1',
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
            'name.required' => 'Nombre del participante es requerido',
            'cedula.required' => 'Cedula del participante es requirido',
            'cedula.unique' => 'Cedula del participante ya está registrada',
            'number_paddle.required' => 'Número de paleta es requerido',
            'number_paddle.numeric' => 'Número de paleta debe tener formato numerico',
            'number_paddle.unique' => 'Ya un participante posee éste número de paleta'
        ];
    }

}

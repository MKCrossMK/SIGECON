<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cedula.required' => 'Cedula del cliente es requerida',
            'name.required' => 'Campo Nombre es Requerido',
            'lastname.required' => 'Campo Apellidos es Requerdo',
            'phone.required' => 'Campo Telefono es Requerido',
            'email.required' => 'Correo Electronico Requerido',

        ];
    }
}

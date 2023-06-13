<?php

namespace App\Http\Requests;

use App\Rules\EmptyCashCashier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'user' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'rol_id' => 'required',
            'cash_id' => [
                'required_if:rol_id,8','nullable' , 'unique:users'
            ],
            'branch_office_id' => 'required',
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
            'name.required' => 'Campo Nombre está vacío',
            'lastname.required' => 'Campo Apellidos está vacío',
            'user.required' => 'Nombre de Usuario es requerido',
            'user.unique' => 'Nombre de Usuario debe ser distinto, este ya esta siendo utilizado',
            'email.required' => 'Correo Electronico  es requerido',
            'email.unique' => 'Este Correo Electronico ya está registrado en nuestra base de datos',
            'rol_id.required' => 'Nivel de Acceso o Rol es requerido',
            'branch_office_id.required' => 'Sucursal es requerida',
            'cash_id.required_if' => 'Debe asignar caja al cajero a registrar'
        ];
    }
}

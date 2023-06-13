<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreClientApiRequest extends FormRequest
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
            'cedula' => 'required|unique:clients',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'unique:clients|nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'response'   => false,
            'message'   => 'Errores de validaciones',
            'data'      => $validator->errors()
        ]));
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cedula.required' => 'Cedula o Pasaporte del cliente es requerida',
            'cedula.unique' => 'Cedula o Pasaporte ya se encuentra registrada',
            'name.required' => 'Campo Nombre es Requerido',
            'lastname.required' => 'Campo Apellidos es Requerido',
            // 'address.required' => 'Direccion del cliente es requerida',
            'sex.required' => 'Campo Sexo está vacío',
            // 'civil_status.required' => 'Campo Estado Civil es Requerido',
            'phone.required' => 'Campo Telefono es Requerido',
            // 'email.required' => 'Correo Electronico del cliente es requerido',
            'email.unique' => 'Este Correo Electronico ya está registrado en nuestra base de datos',
            'email.email' => 'Formato de Correo Electronico Incorrecto',


        ];
    }
}

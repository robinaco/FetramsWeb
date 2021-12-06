<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vehiculoPostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'marca'=> 'required|not_in:0',
            'modelo' => 'required|not_in:0',
            'placa' => 'required',
            'km' => 'required',
            'chasis' => 'required',
            'matricula' => 'required',
            'tservicio' => 'required|not_in:0',
            'tecno' => 'required',
            'soat' => 'required',
            'lcn' => 'required',
            'namep' => 'required',
            'di' => 'required',
            'celtel' => 'required',
            'policy'=> 'required|not_in:0',
            

            
            

        ];
    }
}

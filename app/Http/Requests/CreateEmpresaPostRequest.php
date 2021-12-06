<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpresaPostRequest extends FormRequest
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
            'name' => 'required|min:3|max:25',
            'tdocto'=> 'required|not_in:0',
            'docto'=> 'required',
            'email' => 'required',
            'dir'=> 'required',
            'municipio'=> 'required|not_in:0',
            'replegal'=> 'required',
            'tel'=> 'required',
            'hb'=> 'required|not_in:0',
            'permiso'=> 'required|not_in:0',
            'numper'=> 'required',
            'numh'=> 'required',
           
            
        ];

       
    }
}

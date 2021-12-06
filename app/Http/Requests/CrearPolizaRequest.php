<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearPolizaRequest extends FormRequest
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
            'aseguradora' => 'required',
            'tpoliza' => 'required|not_in:0',
            'numpol'=> 'required',
            'fexp'=>'required',
            'vini'=>'required',
            'fini'=>'required',
            'ffin'=>'required',
            'vfhr'=>'required',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OpraterRequest extends FormRequest
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
            'oprator_type'=>'required|string',
            'oprator_name'=>'required|string',
            'oprator_code'=>'required|string',
            'commission_type'=>'required|string',
             'commission_rate'=>'required|numeric',
        ];
    }
}

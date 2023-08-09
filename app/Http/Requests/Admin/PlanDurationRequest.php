<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanDurationRequest extends FormRequest
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
            'operator_type'=>'required',
            'operator_name'=>'required',
            'pack_name'=>'required',
            'plan_name'=>'required',
            'amount'=>'required',
            'validity'=>'required',
            // 'data'=>'required',
        ];
    }
}

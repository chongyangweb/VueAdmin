<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
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
            'pid'   =>  'required',
            'name'  =>  'required',
            'ename' =>  'alpha_dash',
        ];
    }

    public function messages(){
        return [
            'required'          =>  '不能为空！',
            'ename.alpha_dash'  =>  '不能为中文，可包含字母、数字，以及破折号 ( - ) 和下划线 ( _ )。',
        ];
    }
}

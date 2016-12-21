<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class LangsRequest extends Request
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
            'CountryName'  => 'required',
            'EnglishName'  => 'required',
            'EnglishShort' => 'required',
        ];
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'CountryName'  => '请填写项目名子！',
            'EnglishName'  => '请填写英文名子！',
            'EnglishShort' => '请填写短名子！',
           // 'lang.unique' => '语言已存在！',
        ];
    }

    /**
     * 自定义错误数组
     *
     * @return array
     */
    public function formatErrors(Validator $validator)
    {
        $errors = ['errors' => $validator->errors()->all()];
        return $errors;
    }
}

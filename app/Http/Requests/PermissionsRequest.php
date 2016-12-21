<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PermissionsRequest extends Request
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
            'name'  => 'required|min:3|max:20|unique:permissions',
            'display_name' => 'required|min:2|max:30|unique:permissions',
            'cat' => 'required',
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
            'name.required' => '请填写权限',
            'name.max' => '权限名字过长，请不要超出20个字符',
            'name.min' => '权限名字过短，至少3个字符',
            'name.unique' => '权限已存在',
            'display_name.required' => '请填写权限显示名',
            'display_name.min' => '权限显示名至少4个字符（1个汉子代表2个字符）',
            'display_name.max' => '权限显示名太长（1个汉子代表2个字符）',
            'display_name.unique' => '权限显示名已存在',
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

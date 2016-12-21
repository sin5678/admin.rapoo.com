<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class RolesRequest extends Request
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
                'name'  => 'required|min:2|max:15|unique:roles',
                'display_name'    => 'required|min:2|max:20|unique:roles',
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
            'name.required' => '请填写帐号',
            'name.max' => '角色名字过长，请不要超出15个字符',
            'name.min' => '角色名字过短，至少2个字符',
            'name.unique' => '角色名字已存在',
            'display_name.required' => '请填写用于显示角色名',
            'display_name.min' => '显示角色名至少4个字符（1个汉子代表2个字符）',
            'display_name.max' => '显示角色名太长（1个汉子代表2个字符）'
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

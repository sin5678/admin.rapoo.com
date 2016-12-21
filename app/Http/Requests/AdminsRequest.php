<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AdminsRequest extends Request
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
            'account'    => 'required|min:3|max:15|unique:admins,account',
            'email'      => 'required|email|unique:admins,email',
            'password'   => 'required|regex:/^(?![^a-zA-Z]+$)(?!\D+$).{8,16}$/|min:8|max:16',
            'repassword' => 'same:password',
            'role_id'    => 'required|exists:roles,id',
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
            'account.required'   => '请填写帐号',
            'account.max'        => '帐号过长，请不要超出15个字符',
            'account.min'        => '帐号过短，至少6个字符',
            'account.unique'     => '帐号已存在',
            'email.required'     => '请填写邮箱',
            'email.unique'       => '邮箱已存在',
            'password.required'  => '请填写密码',
            'password.min'       => '密码过长，请不要超出15个字符',
            'password.max'       => '密码过短，至少8个字符',
            'password.regex'     => '密码必须包含数字和字母',
            'repassword.same'    => '2次密码不一致',
            'role_id.required'   => '请选择角色（用户组）',
            'role_id.exists'     => '系统不存在该角色（用户组）',
            'real_name.required' => '请填写真实姓名',
            'real_name.min'      => '真实姓名至少4个字符（1个汉子代表2个字符）',
            'real_name.max'      => '真实姓名太长（1个汉子代表2个字符）',
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

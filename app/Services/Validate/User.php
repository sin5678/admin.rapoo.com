<?php 
namespace App\Services\Validate;

use Validator, Lang;
use App\Services\BaseValidate;

/**
 * 用户表单验证
 */
class User extends BaseValidate
{
    /**
     * 创建用户的表单验证
     *
     * @access public
     */
    public function add($data)
    {
        // 创建验证规则
        $rules = array(
            /*'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required',*/

            'account'   => 'required|min:6|max:15|unique:users,account',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|max:15',
        );
        
        // 自定义验证消息
        $messages = array(
            'email.required'    => '请填写邮箱',
            'email.unique'      => '邮箱已存在',
            'password.required' => '请填写密码',
            'password.min'      => '密码过长，请不要超出15个字符',
            'password.max'      => '密码过短，至少6个字符',
            'repassword.same'   => '2次密码不一致',
        );
        
        //开始验证
        $validator = Validator::make($data, $rules, $messages);
        if($validator->fails())
        {
            $this->errorMsg = $validator->messages()->first();
            return false;
        }
        return true;
    }
    
    /**
     * 编辑用户组的时候的表单验证
     *
     * @access public
     */
    public function edit($data)
    {
        return $this->add($data);
    }
    
}

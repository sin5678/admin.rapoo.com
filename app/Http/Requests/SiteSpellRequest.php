<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class SiteSpellRequest extends Request
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

    public function wantsJson()
    {
        return false;
    }

    public function ajax()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Title'     => 'required',
            'ExpireTime'=> 'required'
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
            'Title.required'    => '请填写主标题',
            'ExpireTime.required'    => '请填写过期时间',
            
        ];
    }

    /**
     * 自定义错误数组
     *
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {   
        $errors = ['errors' => $validator->errors()->all()];
        return $errors;
    }
}

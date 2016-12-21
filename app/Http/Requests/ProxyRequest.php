<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class ProxyRequest extends Request
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
            'CompanyName'     => 'required',
            'CompanyDetail'   => 'required',
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
            'CompanyName.required'      => '请填写公司名称',
            'CompanyDetail.required'    => '请填写内容',
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

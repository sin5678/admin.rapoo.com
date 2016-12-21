<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class NewTypeRequest extends Request
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
            'NewTypeCode'     => 'required',
            'NewTypeName'     => 'required',
            'NewTypeEnName'   => 'required',
            'NewTypeTwName'   => 'required',
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
            'NewTypeCode.required'    => '请填写新闻类型编码',
            'NewTypeName.required'    => '请填写新闻类型名称',
            'NewTypeEnName.required'    => '请填写新闻类型英文名称',
            'NewTypeTwName.required'    => '请填写新闻类型繁体名称',
            
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

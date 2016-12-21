<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class DocumentTypeRequest extends Request
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
            'DocumentTypeCode'     => 'required',
            'DocumentTypeName'     => 'required',
            'DocumentTypeEnName'   => 'required',
            'DocumentTypeTwName'   => 'required',
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
            'DocumentTypeCode.required'    => '请填写资料类型编码',
            'DocumentTypeName.required'    => '请填写资料类型名称',
            'DocumentTypeEnName.required'    => '请填写资料类型英文名称',
            'DocumentTypeTwName.required'    => '请填写资料类型繁体名称',
            
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

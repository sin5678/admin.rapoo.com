<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class ProductDocumentRequest extends Request
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
            //'PIDs'              => 'required',
            'DocumentType'      => 'required',
            'DocumentName'      => 'required',
            //'DocumentAttactment'   => 'required',
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
            //'PIDs.required'    => '请填写资料类型编码',
            'DocumentType.required'    => '请填写资料类型名称',
            'DocumentName.required'    => '请填写资料类型英文名称',
            //'DocumentAttactment.required'    => '请填写资料类型繁体名称',
            
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

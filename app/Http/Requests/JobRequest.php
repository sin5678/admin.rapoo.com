<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class JobRequest extends Request
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
            'Position'      => 'required',
            'DeptName'      => 'required',
            'Content'       => 'required',
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
            'Position.required'     => '请填写招聘职位',
            'DeptName.required'     => '请填写职位部门',
            'Content.required'      => '请填写职位描述',
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

<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AbstractRequest extends Request
{
    /**
     * 错误的信息载体
     *
     * @access protected
     */
    protected $errorMsg;
    
    /**
     * 取回错误的信息
     *
     * @access public
     */
    public function getErrorMessage()
    {
        return $this->errorMsg;
    }

    /**
     * 设置错误的信息
     *
     * @param string $errorMsg 错误的信息
     */
    public function setErrorMsg($errorMsg)
    {
    	$this->errorMsg = $errorMsg;
    	return false;
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AbstractController as AbstractController;
use App\Http\Requests\LoginRequest;
use App\Services\LogfailService;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Session;

class AuthController extends AbstractController
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public $redirectPath = '/admin';
    /**
     * ��ʼ��
     *
     * @access public
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        parent::__construct();
    }
    /**
     * ��¼
     *
     * @access public
     */
    public function getLogin()
    {
        $logfailservice  = new LogfailService;
        $data['captcha'] = $logfailservice->getCaptcha('1');
        $milkcaptcha     = Session::get('milkcaptcha');
        return View('auth.login', $data);
    }
    public function getCaptcha(Request $Request)
    {
        $Math           = Input::get('Math');
        $logfailservice = new LogfailService;
        $captcha        = $logfailservice->getCaptcha($Math);
        $html           = '<img id="c2c98f0de5a04167a9e427d883690ff6"  src="' . $captcha . '" alt="" width="90" height="35">';

        if (!empty($captcha)) {
            $msg = array(
                'code' => 1,
                'html' => trans($html),
            );
            echo json_encode($msg);exit;
        } else {
            $msg = array(
                'code' => -1,
            );
            echo json_encode($msg);exit;
        }
    }
    /**
     * ��¼��֤
     *
     * @param LoginRequest $request LoginRequest����ʵ��
     */
    public function postLogin(Request $request)
    {

        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required', 'captcha' => 'required',
        ], [
            'email.required'    => '请填写邮箱',
            'password.required' => '请填写密码',
            'captcha.required'  => '请填写验证码',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        $req             = $request->all();
        $arr['email']    = $req['email'];
        $arr['password'] = $req['password'];
        $captcha         = $req['captcha'];
        $logfailService  = new LogfailService;
        $milkcaptcha     = Session::get('milkcaptcha');
        $ip              = \Request::ip();
        if ($logfailService->getFailIp($ip)) {
            return redirect::to('auth/login')->withErrors('该IP失败次数过多，请第二天重试');
        }
        if ($captcha != $milkcaptcha) {
            return redirect::to('auth/login')->withErrors('验证码错误');
        }
        if (Auth::attempt($arr)) {
            $logfailService->setIpLogFail($ip, true);
            $this->setActionLog();
            return redirect()->to('/');
        }
        $logfailService->setIpLogFail($ip, false);
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);

    }
    /**
     * ע��
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect('auth/login');
    }

}

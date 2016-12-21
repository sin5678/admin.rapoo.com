<?php

namespace App\Http\Middleware;

use Closure,Session,Config,Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\HttpRequest;

class Language
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale      = Config::get('app.locale');
        $locales     = Config::get('app.locales');
        Config::set('app.locale', Session::get('lang', $locale));
        
        if(($lang = Request::segment(1)) && in_array($lang, $locales)){
            Session::set('lang', $lang);
            Config::set('app.locale', Session::get('lang'));
            $pathInfo = $request->getPathInfo();
            $url = substr($pathInfo,strpos($pathInfo,'/'.$lang)+3);
            return redirect($url);
            
        }
        return $next($request);
    }
}

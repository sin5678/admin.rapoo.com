<?php

namespace App\Providers;

use  Illuminate\Support\ServiceProvider;

class LangServiceProvider extends ServiceProvider
{
    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Language', function($app)
        {
            return new Language;
        });
    }
}

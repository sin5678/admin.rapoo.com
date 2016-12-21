<?php

namespace App\Providers;

use  Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Search', function($app)
        {
            return new Search;
        });
    }
}

<?php

namespace App\Providers;

use App\Models\Video;
use App\Models\Lang;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Video::observe(new \App\Models\Observers\VideoObservers());
        Lang::observe(new \App\Models\Observers\LangObservers());
        Category::observe(new \App\Models\Observers\CategoryObservers());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\SiteAyar;
use Illuminate\Support\Facades\Schema;;
use Illuminate\Support\ServiceProvider;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(256);
        view()->composer('*', function($view) {
        $siteAyar = SiteAyar::first();
        return $view->with('siteAyar',$siteAyar);
      });
    }

}

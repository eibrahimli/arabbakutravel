<?php

namespace App\Providers;

use App\Setting;
use App\SiteAyar;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
          $setting = Setting::first();

          return $view->with('setting',$setting);
        });



    }
}

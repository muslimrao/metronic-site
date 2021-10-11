<?php

namespace App\Providers;

use App\Http\Helpers\GeneralHelper;
use App\Http\Library\CustomValidator;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot( )
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        else {
            \URL::forceScheme('http');
        }



      

        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new CustomValidator($translator, $data, $rules, $messages);
        });
    }
}

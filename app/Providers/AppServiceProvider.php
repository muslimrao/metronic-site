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
            //\URL::forceScheme('https');
        }

        \URL::forceScheme('http');

        $domain_name = @$_SERVER['SERVER_NAME'];
        $airline_details = \App\Models\Airlines::where("domain", $domain_name)->get();
        
        if ( $airline_details -> count() <= 0  )
        {
            GeneralHelper::show_error_page("401");
        }
        else {
         
            session(['airline_details' => $airline_details->first()->toArray()]);
        }

        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new CustomValidator($translator, $data, $rules, $messages);
        });
    }
}

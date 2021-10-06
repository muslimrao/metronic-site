<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Load all env Setting and Constants in Application 
     *
     * @return void
     */
    protected function getDefaultConstants()
    {
        foreach (\Config::get('constants') as $constant => $value) {
            $this->constants[$constant] = $value;
        }
    }
}

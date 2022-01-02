<?php

namespace App\Providers;

use System\View\Composer;

class AppServiceProvider extends Provider
{
    public function boot()
    {
        Composer::view('', function (){
           
            return [
                "allCategories" => 'variable',
            ];
        });

    }
}
<?php

 return [
     'APP_TITLE' => 'learn it',
     'BASE_URL' => 'http://localhost:8000',
     'BASE_DIR' => dirname(__DIR__),
     
     //providers
     'providers' => [
        \App\Providers\SessionProvider::class,
        \App\Providers\AppServiceProvider::class,
     ]
 ];
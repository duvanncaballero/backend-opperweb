<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ResponseService extends ServiceProvider
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
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('validate', function ($code = 200, $message = '', $data = null) use ($factory) {
            $format = [
                'status' => $code==200 ? true : false,
                'message' => $message,
                'data' => $data,
            ];

            return $factory->json($format, $code);
        });
    }
}

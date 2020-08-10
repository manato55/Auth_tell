<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'home', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'pending', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'authorized', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'detail', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'modification', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'pending_process', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'retrieve', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'retrieveSenderIndex', 'App\Http\Composers\HomeComposer',
        );
        View::composer(
            'search', 'App\Http\Composers\HomeComposer',
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

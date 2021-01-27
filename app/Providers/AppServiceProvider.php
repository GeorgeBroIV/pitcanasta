<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Defines a custom application path of '/public_html' (originally '/public')
        $this->app->bind('path.public', function() {
            return base_path().'/public_html';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Custom Blade Directives */
        /* I want to have these in app\Providers\BladeServiceProvider.php */
        //
        // https://laravel.com/docs/7.x/blade#custom-if-statements
        // PHPStorm .. Settings .. Languages & Frameworks .. PHP .. Blade .. Directives

        // hasRole
        Blade::if('hasRole', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

        // Visibility
        Blade::if('isVisible', function () {
            $isVisible = false;
            // check to see if 'isVisible' is true
            if(Auth()->user()->isVisible()) {
                $isVisible = true;
            }
            return $isVisible;
        });
    
        // Role: SuperUser
        Blade::if('isSuperUser', function () {
            return auth()->check() && auth()->user()->hasRole('SuperUser');
        });
    
        // Role: Developer
        Blade::if('isDeveloper', function () {
            return auth()->check() && auth()->user()->hasRole('Developer');
        });
    
        // Role: Admin
        Blade::if('isAdmin', function () {
            return auth()->check() && auth()->user()->hasRole('Admin');
        });
    
        // Role: Reviewer
        Blade::if('isModerator', function () {
            return auth()->check() && auth()->user()->hasRole('Moderator');
        });

        // Verified
        Blade::if('isVerified', function () {
            return auth()->check() && isset(auth()->user()->email_verified_at);
        });
    }
}
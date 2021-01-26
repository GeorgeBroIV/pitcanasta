<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Guest routes
    |--------------------------------------------------------------------------
    */
    // Welcome view
    Route::get('/', function() {
        return redirect('/welcome');
    });
    Route::get('/welcome', 'WelcomeController@index')->name('welcome');

    // WebApp Privacy Policy and Terms of Service
    Route::get('/privacy', 'Help\LegalController@privacy')->name('privacy');
    Route::get('/tos', 'Help\LegalController@tos')->name('tos');

    /*
    |--------------------------------------------------------------------------
    | Registered routes
    |--------------------------------------------------------------------------
    */

    /*  Laravel Auth Routes (https://github.com/laravel/framework/blob/8.x/src/Illuminate/Routing/Router.php)
        Usage: Auth::routes();

            $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
            $this->post('login', 'Auth\LoginController@login');
            $this->post('logout', 'Auth\LoginController@logout')->name('logout');
            
            // Registration Routes...
            $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            $this->post('register', 'Auth\RegisterController@register');
            
            // Password Reset Routes...
            $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
            $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
            $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
            $this->post('password/reset', 'Auth\ResetPasswordController@reset');
     */
    
    // WebApp authentication (login, redirects, etc)
    Auth::routes(['verify' => true]);
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');

    // Home view
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

    // Dashboard view
    Route::resource('/dashboard', 'DashboardController')->middleware('auth');

    // The 'get' route handles what would normally result in an untrapped error (e.g. a user right-clicking "Logout" and opening in a new tab).
    Route::get('/logout', 'Auth\LogoutController@logout')->name('logout')->middleware('auth');
    Route::post('/logout', 'Auth\LogoutController@logout')->name('logout')->middleware('auth');

    /*
    |--------------------------------------------------------------------------
    | Verified routes
    |--------------------------------------------------------------------------
    */

    // Account Routes
    Route::resource('/account', 'AccountController')->middleware('verified');
    
    // Profile Routes
    Route::resource('/profiles', 'ProfileController')->middleware('verified');
    // Forced route to call 'Destroy' from href (which only has 'GET' form method instead of required 'DELETE' method
    Route::get('/profiles/delete/{id}', ['as' => 'profiles.delete', 'uses' => 'ProfileController@destroy'])->middleware('verified');
    
    /*
    |--------------------------------------------------------------------------
    | Admin routes
    |--------------------------------------------------------------------------
    */
    
    /*  Laravel custom middleware (https://laravel.com/docs/8.x/middleware)
        Usage: ->middleware('role:ROLE'); where ROLE is:
            SuperUser
            Developer
            Admin
            Reviewer
        E.g. Route::get('/protected', 'EXAMPLEController@index')->name('example')->middleware('role:SuperUser');

        Or you can assign middleware to controller's constructor (helpful for resource routes)
        https://laravel.com/docs/8.x/controllers#controller-middleware

        Resource Routes
        https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
     */

    // Admin 'User' Routes
    // Middleware ALSO applied to Controller
    Route::resource('/admin/users', 'Admin\UserController')->middleware('role:Admin');
    Route::resource('/admin/roles', 'Admin\RoleController')->middleware('role:Admin');
    // Forced route to call 'Destroy' from href (which only has 'GET' form method instead of required 'DELETE' method
    Route::get('/admin/roles/delete/{id}', ['as' => 'roles.delete', 'uses' => 'Admin\RoleController@destroy'])->middleware('role:Admin');
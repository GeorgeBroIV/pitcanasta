<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Guest routes
    |--------------------------------------------------------------------------
    */
    // Welcome view
    Route::get('/', 'WelcomeController@index');

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

    // The 'get' route handles what would normally result in an untrapped error (e.g. a user right-clicking "Logout" and opening in a new tab).
    Route::get('/logout', 'Auth\LogoutController@logout')->name('logout')->middleware('auth');
    Route::post('/logout', 'Auth\LogoutController@logout')->name('logout')->middleware('auth');

    /*
    |--------------------------------------------------------------------------
    | Verified routes
    |--------------------------------------------------------------------------
    */

    // Profile Routes
    Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('verified');
    Route::post('/profile/edit', 'ProfileController@edit')->name('profile.edit')->middleware('verified');
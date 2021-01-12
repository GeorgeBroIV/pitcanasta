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
    
    // WebApp authentication (login, redirects, etc)
    Auth::routes(['verify' => true]);
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verify');
    
    
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
    Route::get('/profile', 'Profile\ProfileController@index')->name('profile')->middleware('verified');
    Route::post('/profile/edit', 'Profile\ProfileController@edit')->name('profile.edit')->middleware('verified');
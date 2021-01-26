<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    /**
     * Render an exception into an HTTP response.
     * https://laracasts.com/discuss/channels/laravel/redirect-to-login-page-after-session-timeout
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|void
     */
    public function render($request, $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect('login')->with(['message' => 'Your session expired due to inactivity, please log back in.']);
        } elseif (!$this->isHttpException($exception)) {
            $exception = new HttpException(500);
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
}
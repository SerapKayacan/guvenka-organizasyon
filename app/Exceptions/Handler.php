<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            // Redirect to the home page
            return redirect('/');
        }

        // Catch file too big exceptions
        if ($exception instanceof \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig || $exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
            return redirect()->back()->with('error', 'Yüklemeye çalıştığınız dosya boyutu çok büyük. Lütfen maksimum 10 MB boyutunda bir dosya yükleyin.')->withInput();
        }

        return parent::render($request, $exception);
    }

}

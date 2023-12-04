<?php

namespace App\Exceptions;

use App\Traits\ApiResponsesTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PDepend\Util\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponsesTrait;

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

        if (request()->is('api/*')) {
            $this->renderable(function (NotFoundHttpException $e) {
                Log::debug('Record not found. \n'.$e->getMessage());

                return $this->errorResponse('Record not found.', 404);
            });
            $this->renderable(function (ModelNotFoundException $e) {
                Log::debug('Model not found. \n'.$e->getMessage());

                return $this->errorResponse('Model not found.', 404);
            });
        }

    }
}

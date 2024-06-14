<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
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

    public function render($request, Throwable $exception)
    {
        /** ERROR EN FORMATO VISUAL (html) --> por defecto */
        // return parent::render($request, $exception);

        /** ERROR EN FORMATO JSON */
        if ($exception instanceof GenericException) {
            return response()->json([
                'success' => false,
                'message' => empty( $exception->getMessage()) ? $exception->getTrace(): $exception->getMessage(),
                'errorCode' => spl_object_hash($exception)
            ], $exception->getStatus());
        }

        return response()->json([
            'success' => false,
            'message' => empty( $exception->getMessage()) ? $exception->getTrace(): $exception->getMessage(),
            'errorCode' => spl_object_hash($exception)
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

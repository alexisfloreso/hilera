<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render( $request,Throwable $exception ){


        if( $exception instanceof ValidationException ){

            return response()->json([
                'message' => 'Hubo un rror al procesar los datos recibidos',
                'errors' => $exception->errors()
            ], 422);

        }

        if( $exception instanceof QueryException ){

            return response()->json([
                'message' => 'Hubo un error con la base de datos',
                'errors' => $exception->getMessage()
            ], 500);

        }

        if( $exception instanceof ModelNotFoundException ){

            return response()->json([
                'message' => 'El recurso solicitado no se encontró'
            ], 404);

        }

        if( $exception instanceof NotFoundHttpException ){

            return response()->json([
                'message' => 'La ruta solicitada no existe',
                'errors' => $exception->getMessage()
            ],404);

        }

        return response()->json([
            'message' => 'Ocurrió un error inesperado',
            'errors' => $exception->getMessage()
        ], 500);

    }
    
}

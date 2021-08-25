<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

use function GuzzleHttp\Promise\exception_for;

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

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'response' => __('Los datos que usted ha ingresado no son validos, ¡Error!'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                'response' => false,
                'errors' => 'No hemos encontrado la informacion solicitada, ¡Error!'
            ], Response::HTTP_NOT_FOUND);
        }

        if($exception instanceof RouteNotFoundException){
            return response()->json([
                'response' => false,
                'errors' => 'No posee los permisos necesarios para acceder a esta ruta, ¡Error!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $exception);
    }
}

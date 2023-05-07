<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\ApiV1\Modules\Appointments\Controllers\AppointmentController;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    /**
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException)
        {
            return response()->json(new ErrorPathResource($request), 404);
        }

        if ($request->is('api/v1/*')) {
            if ($e instanceof ModelNotFoundException) {
                EmptyResourceController::$code = 404;
                EmptyResourceController::$message = $e->getMessage();
                return response()->json(new EmptyResource($request), 404);
            }
            if ($e instanceof ValidationException || $e instanceof TypeError) {
                EmptyResourceController::$code = 400;
                EmptyResourceController::$message = $e->getMessage();
                return response()->json(new EmptyResource($request), 400);
            }

            EmptyResourceController::$code = 500;
            EmptyResourceController::$message = $e->getMessage();
            return response()->json(new EmptyResource($request), 500);
        }

        return parent::render($request, $e);
    }
}

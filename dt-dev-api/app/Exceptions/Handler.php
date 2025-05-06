<?php


namespace App\Exceptions;

use App\Concerns\ExpectResponseJson;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ExpectResponseJson;

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            // if (! $this->shouldReturnJson($request, $e)) {
            //     return null;
            // }

            if ($e instanceof ValidationException) {
                return $this->responseJsonError(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    $e->validator->errors()->toArray()
                );
            }

            if (
                $e instanceof NotFoundHttpException
                || $e instanceof RouteNotFoundException
                || $e instanceof MethodNotAllowedHttpException
                || $e instanceof ModelNotFoundException
            ) {
                return $this->responseJsonError(Response::HTTP_NOT_FOUND, $e->getMessage());
            }

            if ($e instanceof AuthenticationException) {
                return $this->responseJsonError(Response::HTTP_UNAUTHORIZED, $e->getMessage());
            }

            if (
                $e instanceof AuthorizationException
                || $e instanceof AccessDeniedHttpException
            ) {
                return $this->responseJsonError(Response::HTTP_FORBIDDEN, $e->getMessage());
            }

            $statusCode = (method_exists($e, 'getStatusCode') ? $e->getStatusCode() : $e->getCode());

            if (! app()->hasDebugModeEnabled()) {
                return $this->responseJsonError(
                    $this->isInvalidStatusCode($statusCode)
                        ? $statusCode
                        : Response::HTTP_INTERNAL_SERVER_ERROR,
                    Response::$statusTexts[$statusCode] ?? 'Server error'
                );
            }

            return $this->responseJsonError(
                $this->isInvalidStatusCode($statusCode)
                    ? $statusCode :
                    Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage(),
                [
                    'code' => $statusCode,
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ],
            );
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->responseJsonError(Response::HTTP_UNAUTHORIZED, $exception->getMessage());
    }

    protected function isInvalidStatusCode($code): bool
    {
        try {
            response(status: $code);

            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }
}

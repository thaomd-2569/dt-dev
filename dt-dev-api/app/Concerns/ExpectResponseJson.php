<?php

namespace App\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

trait ExpectResponseJson
{
    protected array $responseJsonHeaders = [];

    protected mixed $responseJsonData;

    protected mixed $responseJsonMessage;

    protected mixed $responseJsonMessageDetail;

    protected int $responseJsonHttpStatusCode;

    protected int $responseJsonOptions = 0;

    public function setResponseJsonHttpStatusCode(int $httpStatusCode): static
    {
        $this->responseJsonHttpStatusCode = $httpStatusCode;

        return $this;
    }

    public function setResponseJsonHeaders(array $headers): static
    {
        $this->responseJsonHeaders = $headers;

        return $this;
    }

    public function setResponseJsonData($data): static
    {
        $this->responseJsonData = $data;

        return $this;
    }

    public function setResponseJsonMessage($message): static
    {
        $this->responseJsonMessage = $message;

        return $this;
    }

    public function setResponseJsonMessageDetail($message): static
    {
        $this->responseJsonMessageDetail = $message;

        return $this;
    }

    public function setResponseJsonOptions(int $options): static
    {
        $this->responseJsonOptions = $options;

        return $this;
    }

    public function responseJson(): JsonResponse
    {
        $data = [
            // 'response_id' => Str::uuid(),
            'timestamp' => now()->timestamp,
            'status_code' => $httpsStatusCode = $this->responseJsonHttpStatusCode ?? Response::HTTP_OK,
        ];

        if (isset($this->responseJsonData)) {
            $data['data'] = $this->responseJsonData;
        }

        if (isset($this->responseJsonMessage)) {
            $data['message'] = $this->responseJsonMessage;
        }

        if (! app()->hasDebugModeEnabled() && isset($this->responseJsonMessageDetail)) {
            $data['message_detail'] = $this->responseJsonMessageDetail;
        }

        return response()->json(
            $data,
            $httpsStatusCode,
            $this->responseJsonHeaders,
            $this->responseJsonOptions
        );
    }

    public function responseJsonSuccess(
        $data = null,
        $message = null,
        int $httpStatusCode = Response::HTTP_OK
    ): JsonResponse {
        return $this->setResponseJsonHttpStatusCode($httpStatusCode)
            ->setResponseJsonMessage($message)
            ->setResponseJsonData($data)
            ->responseJson();
    }

    public function responseJsonError(
        int $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        $message = null,
        $messageDetail = null,
        $data = null
    ): JsonResponse {
        return $this->setResponseJsonHttpStatusCode($httpStatusCode)
            ->setResponseJsonMessage($message)
            ->setResponseJsonMessageDetail($messageDetail)
            ->setResponseJsonData($data)
            ->responseJson();
    }
}

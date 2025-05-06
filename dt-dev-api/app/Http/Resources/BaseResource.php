<?php

namespace App\Http\Resources;

use App\Concerns\ExpectResponseJson;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    use ExpectResolvePurposeMethod, ExpectResponseJson;

    public static $wrap = null;

    protected ?string $purpose;

    public function __construct($resource, ?string $purpose = null)
    {
        $this->purpose = $purpose;

        parent::__construct($resource);
    }

    public function toResponse($request)
    {
        return (new ResourceResponse($this))->toResponse($request);
    }

    protected function hasPurposeMethod(): bool
    {
        return ! is_null($this->purpose) && method_exists(static::class, $this->purpose);
    }
}

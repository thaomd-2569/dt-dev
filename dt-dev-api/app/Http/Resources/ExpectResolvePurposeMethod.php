<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

trait ExpectResolvePurposeMethod
{
    public function resolve($request = null): array
    {
        $request = $request ?: request();

        if ($this->hasPurposeMethod()) {
            $data = $this->{$this->purpose}($request);
        } else {
            $data = $this->toArray($request);
        }

        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        } elseif ($data instanceof JsonSerializable) {
            $data = $data->jsonSerialize();
        }

        return $this->filter((array) $data);
    }
}

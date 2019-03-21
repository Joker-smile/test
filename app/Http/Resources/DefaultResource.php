<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DefaultResource extends Resource
{
    public function toArray($request)
    {
        return $this->resource['_source'];

    }
}

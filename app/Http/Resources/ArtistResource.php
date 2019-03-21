<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArtistResource extends Resource
{
    public function toArray($request)
    {
        $resource = $this->resource;
        $source = $resource['_source'];

        return $source;
    }

}
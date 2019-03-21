<?php

namespace App\Searchs\Rules;

use ScoutElastic\SearchRule;

class Artist extends SearchRule
{
    // This method returns an array, describes how to highlight the results.
    // If null is returned, no highlighting will be used.
    public function buildHighlightPayload()
    {
        return null;
    }

    // This method returns an array, that represents bool query.
    public function buildQueryPayload()
    {
        return [
            'must' => [
                'match' => [
                    'artist_name' => $this->builder->query
                ]
            ]
        ];
    }
}
<?php

return [
    'client' => [
        'hosts' => [
            env('SCOUT_ELASTIC_HOST', 'localhost:9200')
        ]
    ],
    'update_mapping' => env('SCOUT_ELASTIC_UPDATE_MAPPING', false),
    'indexer' => env('SCOUT_ELASTIC_INDEXER', 'bulk'),
    'document_refresh' => env('SCOUT_ELASTIC_DOCUMENT_REFRESH'),

    'models' => [
        'artists' => \App\User::class,
    ],

    'resources' => [
        'artists' => \App\Http\Resources\ArtistResource::class,
    ],
];
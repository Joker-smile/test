<?php

namespace App\Searchs\Indexers;

use ScoutElastic\IndexConfigurator;

class Artist extends IndexConfigurator
{
    // It's not obligatory to determine name. By default it'll be a snaked class name without `IndexConfigurator` part.
    protected $name = '4u2_artists';

    // You can specify any settings you want, for example, analyzers.
    protected $settings = [
        'index' => [
            'max_result_window' => 500000
        ],
        'analysis' => [
            'analyzer' => [
                'en_std' => [
                    'type' => 'standard',
                    'stopwords' => '_english_'
                ]
            ]
        ]
    ];
}
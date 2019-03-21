<?php
namespace App\Searchs\Traits;

use ScoutElastic\Searchable;
use App\Searchs\Rules\Artist as Rule;
use App\Searchs\Indexers\Artist as Indexer;

trait Artist
{
    use Searchable;

    public $searchRules = [
        Rule::class
    ];

    public $indexConfigurator = Indexer::class;

    public function toSearchableArray()
    {
        return [
            'id'      => $this->id,
            'name' => $this->name,
            'email'  => $this->email
        ];
    }

    protected $mapping = [
        'properties' => [
            "id" => [
                "type" => "long"
            ],
            "name" => [
                "type" => "text"
            ],
            "email" => [
                "type" => "text"
            ]
        ]
    ];
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\DefaultResource;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PlasticController extends Controller
{
    public function search(Request $request)
    {
        $models = config('scout_elastic.models');
        $this->validate($request, [
            'type'      => 'required|string|in:' . implode(",", array_keys($models)),
            'direction' => 'string|in:asc,desc',
            'sort'      => 'string|in:recommend_price,created_at',
            'page'      => 'integer|min:1',
            'limit'     => 'integer|min:1',
        ]);

        $type = $request->get('type');
        $model = Arr::get($models, $type);
        $model = new $model;

        try {
            $query   = $this->buildQuery($request, $model);
            $results = $model->searchRaw($query);
        } catch (ElasticsearchException $e) {
            return DefaultResource::collection(new LengthAwarePaginator([], 0, 10));
        }

        return $this->handleResult($request, $results);
    }

    private function handleResult($request, $results)
    {
        $limit = $request->get('limit') ?: 16;
        if (!$total = Arr::get($results, 'hits.total')) {
            return DefaultResource::collection(new LengthAwarePaginator([], 0, $limit));
        }

        $hits = Arr::get($results, 'hits.hits');
        foreach ($hits as $key => $hit) {

            foreach ($hit['_source'] as $k => $v) {
                if (Str::endsWith($k, ['price', 'cost']) && is_integer($v)) {
                    $hit['_source'][$k] = format_money($v);
                }
            }

            $hits[$key] = $hit;
        }

        $type = $request->get('type');
        $paginate = new LengthAwarePaginator($hits, $total, $limit);
        if ($resource = config("scout_elastic.resources.{$type}")) {
            return $resource::collection($paginate);
        }

        return DefaultResource::collection($paginate);
    }

    private function buildQuery($request, $model)
    {
        $keyword   = (string)$request->get('keyword', '*');  //关键词
        $sort      = $request->get('sort', 'id'); //排序字段
        $direction = $request->get('direction', 'desc'); //排序规则
        $queries   = $request->except(['type', 'keyword', 'sort', 'direction', 'page', 'limit', '_session_id']);
        $q = $model->search($keyword ?: "*");

        foreach ($queries as $key => $query) {
            if (is_array($query)) {
                $q = $q->whereIn($key, $query);
            } else {
                $q = $q->where($key, $query);
            }
        }

        $q     = $q->orderBy($sort, $direction);
        $page  = $request->get("page") ?: 1;
        $limit = $request->get('limit') ?: 16;
        $q     = $q->from($limit * --$page)->take($limit);

        return $q->buildPayload()[0]['body'];
    }
}
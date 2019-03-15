<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ExchangeRateController extends Controller
{
    //获取实时汇率
    public function exchangeRate() {
        return Cache::remember('exchange_rate', 2, function() {
            $client = new Client();
            try {
                $res = $client->request('GET', 'https://ali-waihui.showapi.com/waihui-transform', [
                    'headers' => ['Authorization' => 'APPCODE ' . 'e2163b762b334ca6aa06d5515098a978'],
                    'query' => [
                        'fromCode' => 'USD',
                        'money'    =>  1,
                        'toCode'   =>  'CNY'
                    ]
                ]);
                $content = $res->getBody()->getContents();
                $res = json_decode($content, true);
                if ($res['showapi_res_code'] == 0) {
                    return [
                        'update_time'   =>  date('Y-m-d H:i:s'),
                        'exchange_rate' =>  $res['showapi_res_body']['money']
                    ];
                } else {
                    logger()->error("request exchange rate error:" . $res['showapi_res_error']);
                    return false;
                }
            } catch (\Exception $exception) {
                logger()->error("request exchange rate error:" . $exception->getMessage());
                return false;
            }
        });
    }
}
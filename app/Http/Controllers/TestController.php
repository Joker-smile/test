<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{
    // 首页
    public function home()
    {
        return view("home");
    }
    // 列表
    public function list()
    {
        return view("list");
    }
    // 后端控制
    public function back()
    {
        if (request()->method() == 'POST') {
            $this->curl_get($this->getUrl());
            return json_encode(['code'=>200,"message"=>"成功"]);
        } else {
            return view("back");
        }

    }
    // 获取要请求swoole websocet服务地址
    protected function getUrl():string
    {
        // 域名 端口 请求swoole服务的方法
        $sBase = request()->server('HTTP_HOST');
        $iPort = 9401;
        $sFunc = request()->post('func');
        $sPage = "back";
        return '192.168.33.10'.":".$iPort."?func=".$sFunc."&token=123456&page=".$sPage;
    }
    // curl 推送
    protected function curl_get(string $url):string
    {
        $ch_curl = curl_init();
        curl_setopt ($ch_curl, CURLOPT_TIMEOUT_MS, 3000);
        curl_setopt($ch_curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch_curl, CURLOPT_HEADER,false);
        curl_setopt($ch_curl, CURLOPT_HTTPGET, 1);
        curl_setopt($ch_curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt ($ch_curl, CURLOPT_URL,$url);
        $str  = curl_exec($ch_curl);
        curl_close($ch_curl);
        return $str;
    }
}

<?php


namespace App\Http\Controllers;


use EasyWeChat\Factory;
use Illuminate\Support\Facades\Log;

class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');

        $app         = app('wechat.official_account');
        $response = $app->server->serve();

        return $response;
    }

    public function profile()
    {
        $userinfo = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($userinfo);
    }
}

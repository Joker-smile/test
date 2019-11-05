<?php


namespace App\Http\Controllers;


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
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app         = app('wechat.official_account');
        $accessToken = $app->access_token;
        $token       = $accessToken->getToken(); // token 数组  token['access_token'] 字符串
        $token       = $accessToken->getToken(true);

        return $token;
    }

    public function profile()
    {
        $userinfo = session('wechat_user'); // 拿到授权用户资料
        dd($userinfo);
    }
}

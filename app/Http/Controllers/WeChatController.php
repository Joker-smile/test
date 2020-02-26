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
        Log::info('request arrived.');

        $app         = app('wechat.official_account');
        $accessToken = $app->access_token;
        $token       = $accessToken->getToken(); // token 数组  token['access_token'] 字符串

        return $token;
    }

    public function profile()
    {
        $userinfo = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($userinfo);
    }
}

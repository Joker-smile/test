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

        $app = app('wechat.official_account');
        $accessToken = $app->access_token;
        $token = $accessToken->getToken(); // token 数组  token['access_token'] 字符串
        $token = $accessToken->getToken(true);

        return $token;
    }

    public function profile()
    {

        $app   = app('wechat.official_account');
        $oauth = $app->oauth;

// 未登录
        if (empty($_SESSION['wechat_user'])) {

            $_SESSION['target_url'] = 'user/profile';

            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }

// 已经登录过
        $user = $_SESSION['wechat_user'];

        dd($user);

    }

    public function auth()
    {
        $app   = app('wechat.official_account');
        $oauth = $app->oauth;

// 获取 OAuth 授权结果用户信息
        $user = $oauth->user();

        $_SESSION['wechat_user'] = $user->toArray();

        $targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];

        return redirect($targetUrl);
    }
}

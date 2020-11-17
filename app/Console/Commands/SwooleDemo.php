<?php

namespace App\Console\Commands;

use Closure;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SwooleDemo extends Command
{
    // 命令名称
    protected $signature = 'swoole:demo';
    // 命令说明
    protected $description = '这是关于swoole websocket的一个测试demo';
    // swoole websocket服务
    private static $server = null;

    public function __construct()
    {
        parent::__construct();
    }

    // 入口
    public function handle()
    {
        $this->redis = Redis::connection();
        $server = self::getWebSocketServer();
        $server->on('open',[$this,'onOpen']);
        $server->on('message', [$this, 'onMessage']);
        $server->on('close', [$this, 'onClose']);
        $server->on('request', [$this, 'onRequest']);
        $this->line("swoole服务启动成功 ...");
        $server->start();
    }

    // 获取服务
    public static function getWebSocketServer()
    {
        if (!(self::$server instanceof \swoole_websocket_server)) {
            self::setWebSocketServer();
        }
        return self::$server;
    }
    // 服务处始设置
    protected static function setWebSocketServer():void
    {
        self::$server  = new \swoole_websocket_server("0.0.0.0", 9401);
        self::$server->set([
            'worker_num' => 1,
            'heartbeat_check_interval' => 60,    // 60秒检测一次
            'heartbeat_idle_time' => 121,        // 121秒没活动的
        ]);
    }

    // 打开swoole websocket服务回调代码
    public function onOpen($server, $request)
    {
        if ($this->checkAccess($server, $request)) {
            self::$server->push($request->fd,json_encode(["code"=>200,"message"=>"打开swoole服务成功"]));
        }
    }
    // 给swoole websocket 发送消息回调代码
    public function onMessage($server, $frame)
    {

    }
    // http请求swoole websocket 回调代码
    public function onRequest($request,$response)
    {
        if ($this->checkAccess("", $request)) {
            $param = $request->get;
            // 分发处理请求逻辑
            if (isset($param['func'])) {
                if (method_exists($this,$param['func'])) {
                    call_user_func([$this,$param['func']],$request);
                }
            }
        }
    }

    // websocket 关闭回调代码
    public function onClose($serv,$fd)
    {
        $this->redis->hdel('swoole:fds', $fd);
        $this->line("客户端 {$fd} 关闭");
    }

    // 校验客户端连接的合法性,无效的连接不允许连接
    public function checkAccess($server, $request):bool
    {
        $bRes = true;
        if (!isset($request->get) || !isset($request->get['token'])) {
            self::$server->close($request->fd);
            $this->line("接口验证字段不全");
            $bRes = false;
        } else if ($request->get['token'] != 123456) {
            $this->line("接口验证错误");
            $bRes = false;
        }
        $this->storeUrlParamToRedis($request);
        return $bRes;
    }

    // 将每个界面打开websocket的url 存储起来
    public function storeUrlParamToRedis($request):void
    {
        // 存储请求url带的信息
        $sContent = json_encode(
            [
                'page' => $request->get['page'],
                'fd' => $request->fd,
            ], true);
        $this->redis->hset("swoole:fds", $request->fd, $sContent);
    }

    /**
     * @param $request
     * @see 循环逻辑处理
     */
    public function eachFdLogic(Closure $callback = null)
    {
        foreach (self::$server->connections as $fd) {
            if (self::$server->isEstablished($fd)) {
                $aContent = json_decode($this->redis->hget("swoole:fds",$fd),true);
                $callback($aContent,$fd,$this);
            } else {
                $this->redis->hdel("swoole:fds",$fd);
            }
        }
    }
    // 往首页推送逻辑处理
    public function pushHomeLogic($request)
    {
        $callback = function (array $aContent,int $fd,SwooleDemo $oSwoole)use($request) {
            if ($aContent && $aContent['page'] == "home") {
                $aRes['message'] = "后端按了按钮1";
                $aRes['code'] = "200";
                $oSwoole::$server->push($fd,json_encode($aRes));
            }
        };
        $this->eachFdLogic($callback);
    }
    // 往列表页推送逻辑处理
    public function pushListLogic($request)
    {
        $callback = function (array $aContent,int $fd,SwooleDemo $oSwoole)use($request) {
            if ($aContent && $aContent['page'] == "list") {
                $aRes['message'] = "后端按了按钮2";
                $aRes['code'] = "200";
                $oSwoole::$server->push($fd,json_encode($aRes));
            }
        };
        $this->eachFdLogic($callback);
    }

    // 启动websocket服务
    public function start()
    {
        self::$server->start();
    }
}

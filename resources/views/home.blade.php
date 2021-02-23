<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>swoole首页</title>
    <meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
</head>
<body>
<h1>这是首页</h1>
</body>
<script>
    var ws;//websocket实例
    var lockReconnect = false;//避免重复连接
    var wsUrl = 'ws://testdev.com:9401?page=home&token=123456';

    createWebSocket(wsUrl);
    function initEventHandle() {
        if ("WebSocket" in window) {
            console.log("您的浏览器支持 websocket\n");
            var ws = new WebSocket(wsUrl);//创建 websocket 对象
            ws.onopen = function () {
                // ws.send("连接已建立\n");
                ws.send('123456');
                console.log("数据发送中");
            }

            ws.onmessage = function (evt) {
                var recv_msg = evt.data;
                console.log("接受到的数据为:" + recv_msg);
            }

            ws.onerror = function (evt, e) {
                console.log("错误信息为" + e);
            }

            ws.onclose = function () {
                console.log("连接已关闭");
            }

        } else {
            console.log("您的浏览器不支持 websocket\n");
        }

    }

    /**
     * 创建链接
     * @param url
     */
    function createWebSocket(url) {
        try {
            // ws = new WebSocket(url);
            initEventHandle();
        } catch (e) {
            reconnect(url);
        }
    }

    function reconnect(url) {
        if (lockReconnect) return;
        lockReconnect = true;
        //没连接上会一直重连，设置延迟避免请求过多
        setTimeout(function () {
            createWebSocket(url);
            lockReconnect = false;
        }, 2000);
    }

    //心跳检测
    var heartCheck = {
        timeout: 60000,//60秒
        timeoutObj: null,
        serverTimeoutObj: null,
        reset: function () {
            clearTimeout(this.timeoutObj);
            clearTimeout(this.serverTimeoutObj);
            return this;
        },
        start: function () {
            var self = this;
            this.timeoutObj = setTimeout(function () {
                //这里发送一个心跳，后端收到后，返回一个心跳消息，
                //onmessage拿到返回的心跳就说明连接正常
                ws.send("heartbeat");
                self.serverTimeoutObj = setTimeout(function () {//如果超过一定时间还没重置，说明后端主动断开了
                    ws.close();//如果onclose会执行reconnect，我们执行ws.close()就行了.如果直接执行reconnect 会触发onclose导致重连两次
                }, self.timeout);
            }, this.timeout);
        },
        header: function (url) {
            window.location.href = url
        }

    }
</script>
</html>

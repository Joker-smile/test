<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function payByAlipay()
    {
        $order_number = time();
        return app('alipay')->web([
            'out_trade_no' => $order_number, // 订单编号，需保证在商户端不重复
            'total_amount' => 100, // 订单金额，单位元，支持小数点后两位
            'subject'      => '支付 Laravel Shop 的订单：'.$order_number, // 订单标题
        ]);
    }

    public function alipayReturn()
    {
        try {
            app('alipay')->verify();
        } catch (\Exception $e) {
            return view('', ['msg' => '数据不正确']);
        }

        return view('', ['msg' => '付款成功']);
    }

    public function alipayNotify()
    {
        $data = app('alipay')->verify();
        \Log::debug('Alipay notify', $data->all());

//        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
//        $order = Order::where('no', $data->out_trade_no)->first();
//        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
//        if (!$order) {
//            return 'fail';
//        }
//        // 如果这笔订单的状态已经是已支付
//        if ($order->paid_at) {
//            // 返回数据给支付宝
//            return app('alipay')->success();
//        }
//        $order->update([
//            'paid_at'        => Carbon::now(), // 支付时间
//            'payment_method' => 'alipay', // 支付方式
//            'payment_no'     => $data->trade_no, // 支付宝订单号
//        ]);

//        其中 app('alipay')->success() 返回数据给支付宝，
//        支付宝得到这个返回之后就认为我们已经处理好这笔订单，
//        不会再发生这笔订单的回调了。如果我们返回其他数据给支付宝，
//        支付宝就会每隔一段时间就发送一次服务器端回调，直到我们返回了正确的数据为准。

        return app('alipay')->success();
    }


    public function payByWechat()
    {
        $order_number = time();
        // scan 方法为拉起微信扫码支付
        $wechatOrder = app('wechat_pay')->scan([
            'out_trade_no' => $order_number,  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee' => 10 * 100, // 与支付宝不同，微信支付的金额单位是分。
            'body'      => '支付 Laravel Shop 的订单：'.$order_number, // 订单描述
        ]);

        $qrCode = new QrCode($wechatOrder->code_url);

        // 将生成的二维码图片数据以字符串形式输出，并带上相应的响应类型
        return response($qrCode->writeString(), 200, ['Content-Type' => $qrCode->getContentType()]);
    }

    public function wechatNotify()
    {
        // 校验回调参数是否正确
        $data  = app('wechat_pay')->verify();
        // 找到对应的订单
        $order = Order::where('no', $data->out_trade_no)->first();
        // 订单不存在则告知微信支付
        if (!$order) {
            return 'fail';
        }
        // 订单已支付
        if ($order->paid_at) {
            // 告知微信支付此订单已处理
            return app('wechat_pay')->success();
        }

        // 将订单标记为已支付
        $order->update([
            'paid_at'        => Carbon::now(),
            'payment_method' => 'wechat',
            'payment_no'     => $data->transaction_id,
        ]);

        return app('wechat_pay')->success();
    }

    public function creditCardNotify(Request $request)
    {
//       $data = simplexml_load_string($request->getContent());
       logger($request->getContent());

       return response()->json('receive-ok', 200);
    }

    public function back(Request $request)
    {
      $test =$request->all();
      if ($test['payment_status'] == 1){
          dd($test['payment_details']);
      }

      if($test['payment_status'] == 0){
          dd($test['payment_details']);
      }
    }
}
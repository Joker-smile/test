<?php
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 19-3-6
 * Time: 下午3:42
 */

namespace App\Http\Controllers;


class PaymentController extends Controller
{

    public function payByAlipay()
    {
        $order_number = time();
dd('{"gmt_create":"2019-03-06 17:23:46","charset":"GBK","gmt_payment":"2019-03-06 17:23:55","notify_time":"2019-03-06 17:23:55","subject":"支付 Laravel Shop 的订单：1551864200","sign":"AHrTmgnfjRVyYNtB4+AGs6HStx2lBCVJV8hAzPAp/0e/nT5ylgyczFLRSBtdh1uhUeuujCRjcC3KghJYOikUDqhgGwLBq8/aOc2yf5Ru8EPfuKCK9B+wQOQBvmVa180Iivh513nfKbgndpkH8e/V7Z8BxRkNJDWlk0OWG7/2YJtz5rDAS30PK6ItDn5e9dXuOG8Cw6Wq5kAHk14fQdkKdpwIbH0jbtoqCOeZQP54XyLYVpk88MSbUdeldDGwEtqNmOwhKFmrbDONXShlw7CM1EZmm/Pxv7JKeKz6SU+2sQ5UcmL25G6Y4MsOUNW34WSPpzWwFOOT0WcGxSfUwADcog==","buyer_id":"2088102177667610","invoice_amount":"100.00","version":"1.0","notify_id":"9af733e2c58739103c6da856c9c5cf8kpl","fund_bill_list":"[{\"amount\":\"100.00\",\"fundChannel\":\"ALIPAYACCOUNT\"}]","notify_type":"trade_status_sync","out_trade_no":"1551864200","total_amount":"100.00","trade_status":"TRADE_SUCCESS","trade_no":"2019030622001467610500701553","auth_app_id":"2016082000295641","receipt_amount":"100.00","point_amount":"0.00","app_id":"2016082000295641","buyer_pay_amount":"100.00","sign_type":"RSA2","seller_id":"2088102172237210"}');
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
}
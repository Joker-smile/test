<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index()
    {

        $secureCode = '*钱海提供的安全码*';
        $data['account'] = '*钱海测试帐号*';
        $data['terminal'] = '*钱海测试端号*';
        $data['backUrl'] = '　*前端回调路由*';
        $data['noticeUrl'] = '*服务端通知路由*';
        $data['methods'] = 'Credit Card';
        $data['order_number'] = '20190115081630370256';
        $data['order_currency'] = 'USD';
        $data['order_amount'] = 100;
        $data['billing_firstName'] = 'Frances L';
        $data['billing_lastName'] = 'Adams';
        $data['billing_email'] = 'zai1020733278@gmail.com';
        $data['billing_phone'] = '817-982-3149';
        $data['billing_country'] = 'US';
        $data['billing_state'] = 'texas';
        $data['billing_city'] = 'Dallas';
        $data['billing_address'] = '433 New York Avenue';
        $data['billing_zip'] = '75212';
        $data['signValue'] = hash("sha256",$data['account'].$data['terminal'].$data['backUrl']. $data['order_number'].$data['order_currency'].$data['order_amount'].$data['billing_firstName'].$data['billing_lastName'].$data['billing_email'].$secureCode);
        $data['ship_firstName'] = 'Frances L';
        $data['ship_lastName'] = 'Adams';
        $data['ship_phone'] = '817-982-3149';
        $data['ship_country'] = 'US';
        $data['ship_state'] = 'texas';
        $data['ship_city'] = 'Dallas';
        $data['ship_addr'] = '433 New York Avenue';
        $data['ship_zip'] = '75212';
        $data['order_notes'] =24;

        return view('pages.home')->with(compact('data'));
    }
}

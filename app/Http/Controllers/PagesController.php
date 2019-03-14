<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index()
    {
        $data['account'] = '191224';
        $data['terminal'] = '19122401';
        $data['backUrl'] = 'https://loveinyeu.cn/payment/back/';
        $data['noticeUrl'] = 'https://loveinyeu.cn/payment/notify/';
        $data['methods'] = 'Credit Card';
        $data['order_number'] = '20190108071616707004';
        $data['order_currency'] = 'USD';
        $data['order_amount'] = 100;
        $data['billing_firstName'] = 'Frances L';
        $data['billing_lastName'] = 'Adams';
        $data['billing_email'] = 'zai1020733278@gmail.com';
        $data['billing_phone'] = '817-982-3149';
        $data['billing_country'] = 'US';
        $data['billing_city'] = 'Dallas';
        $data['billing_address'] = '433 New York Avenue';
        $data['billing_zip'] = '75212';
        $data['secureCode'] = 't4RxrL4p46l4v2Rp8Tp62460208z42TH0Z2zN8dT6p8nr2zJ2H446p6n8n8fp4bt';
        $data['signValue'] = hash("sha256",$data['account'].$data['terminal'].$data['backUrl']. $data['order_number'].$data['order_currency'].$data['order_amount'].$data['billing_firstName'].$data['billing_lastName'].$data['billing_email'].$data['secureCode']);

        return view('pages.home')->with(compact('data'));
    }
}

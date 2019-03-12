<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $data['account'] = '191224';
        $data['terminal'] = '19122401';
        $data['backUrl'] = 'https://loveinyeu.cn/payment/back/';
        $data['noticeUrl'] = 'https://loveinyeu.cn/payment/notify/';
        $data['methods'] = 'Credit Card';
        $data['order_number'] = '2019030117011783110';
        $data['order_currency'] = 'USD';
        $data['order_amount'] = 100;
        $data['billing_firstName'] = 'N/A';
        $data['billing_lastName'] = 'N/A';
        $data['billing_email'] = 'zai1020733278@gmail.com';
        $data['billing_phone'] = 'N/A';
        $data['billing_country'] = 'N/A';
        $data['billing_city'] = 'N/A';
        $data['billing_address'] = 'N/A';
        $data['billing_zip'] = 'N/A';
        $data['secureCode'] = 't4RxrL4p46l4v2Rp8Tp62460208z42TH0Z2zN8dT6p8nr2zJ2H446p6n8n8fp4bt';
        $data['signValue'] = hash("sha256",$data['account'].$data['terminal'].$data['backUrl']. $data['order_number'].$data['order_currency'].$data['order_amount'].$data['billing_firstName'].$data['billing_lastName'].$data['billing_email'].$data['secureCode']);

        return view('pages.home')->with(compact('data'));
    }
}
<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use PDF;

class DomPdfController extends Controller
{
    public function createPdf()
    {
        $secureCode             = 'b462r46nX202Zhrz866fZd46N6x60f884B2r0p0h46H488lhj840022zB622tvtp';
        $data['account']        = '191224';
        $data['terminal']       = '19122402';
        $data['backUrl']        = 'https://baidu.com';
        $data['noticeUrl']      = 'http://requestbin.fullcontact.com/1mbu77c1';
        $data['methods']        = 'Credit Card';
        $data['order_number']   = '2019011508163037025665d';
        $data['order_currency']    = 'USD';
        $data['order_amount']      = 100;
        $data['billing_firstName'] = 'Frances L';
        $data['billing_lastName']  = 'Adams';
        $data['billing_email']     = 'zai1020733278@gmail.com';
        $data['billing_phone']     = '817-982-3149';
        $data['billing_country']   = 'US';
        $data['billing_state']     = 'texas';
        $data['billing_city']      = 'Dallas';
        $data['billing_address']   = '433 New York Avenue';
        $data['billing_zip']       = '75212';
        $data['signValue']         = hash("sha256", $data['account'] . $data['terminal'] . $data['backUrl'] . $data['order_number'] . $data['order_currency'] . $data['order_amount'] . $data['billing_firstName'] . $data['billing_lastName'] . $data['billing_email'] . $secureCode);
        $data['ship_firstName'] = 'Frances L';
        $data['ship_lastName']  = 'Adams';
        $data['ship_phone']     = '817-982-3149';
        $data['ship_country']   = 'US';
        $data['ship_state']     = 'texas';
        $data['ship_city']      = 'Dallas';
        $data['ship_addr']      = '433 New York Avenue';
        $data['ship_zip']       = '75212';
        $data['order_notes']    = 24;

        $pdf                       = PDF::loadView('pages.home', ['data' => $data]);// 根据视图文件生成 PDF

        return $pdf->stream();// 参数为文件名
    }
}

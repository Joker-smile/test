<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TencentCloud\Cvm\V20170312\CvmClient;
// 导入要请求接口对应的Request类
use TencentCloud\Cvm\V20170312\Models\DescribeZonesRequest;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Common\Credential;

class PagesController extends Controller
{
    public function index()
    {
        $data['account']           = '191224';
        $data['terminal']          = '19122402';
        $data['backUrl']           = 'https://loveinyeu.cn/payment/back/';
        $data['noticeUrl']         = 'https://en94i3utw52dn.x.pipedream.net';
        $data['methods']           = 'Credit Card';
        $data['order_number']      = '201903011701178310';
        $data['order_currency']    = 'USD';
        $data['order_amount']      = 100;
        $data['billing_firstName'] = 'Li';
        $data['billing_lastName']  = 'Derek';
        $data['billing_email']     = 'zai1020733278@gmail.com';
        $data['billing_phone']     = '18659682239';
        $data['billing_country']   = 'America';
        $data['billing_city']      = 'Cleveland';
        $data['billing_address']   = '3980  Sunny Glen Lane';
        $data['billing_zip']       = '44115';
        $data['secureCode']        = 'b462r46nX202Zhrz866fZd46N6x60f884B2r0p0h46H488lhj840022zB622tvtp';
        $data['signValue']         = hash("sha256", $data['account'] . $data['terminal'] . $data['backUrl'] . $data['order_number'] . $data['order_currency'] . $data['order_amount'] . $data['billing_firstName'] . $data['billing_lastName'] . $data['billing_email'] . $data['secureCode']);

        return view('pages.home')->with(compact('data'));
    }

    public function getRequest(Request $request)
    {
        try {
            // 实例化一个证书对象，入参需要传入腾讯云账户secretId，secretKey
            $cred = new Credential("AKIDd4A1lQi1xhCZibwfKoAOQRE2dDoHGWKs", "aVBnUzINC8zf7JQM5gv53sUs272WlkVt");

            // # 实例化要请求产品(以cvm为例)的client对象
            $client = new CvmClient($cred, "ap-guangzhou");

            // 实例化一个请求对象
            $req = new DescribeZonesRequest();

            // 通过client对象调用想要访问的接口，需要传入请求对象
            $resp = $client->DescribeZones($req);

            print_r($resp->toJsonString());
        }
        catch(TencentCloudSDKException $e) {
            echo $e;
        }
    }
}

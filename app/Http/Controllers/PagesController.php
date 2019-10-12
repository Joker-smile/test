<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class PagesController extends Controller
{
    public function index()
    {

        $client = new Client();
        $r      = $client->request('POST', 'http://admin.agent.com/api/v1/business/mabangs/sync/order', [
            'form_params' => [
                'platform_order_id' => '59366381247265001350730',
                'company_id'        => '100003'
            ]
        ]);
        dd($r->getBody()->getContents());

        return view('pages.home')->with(compact('data'));
    }
}

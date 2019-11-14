<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function index()
    {
        return 'Hello world!';
    }

    public function getRequest(Request $request)
    {
//        Log::info($request->getContent());
        Log::info($request->get('store'));
        Log::info(json_decode($request->getContent()));
    }
}

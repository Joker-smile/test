<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        Log::info($request->getContent());
        Log::info($request);
        return view('pages.home');
    }
}

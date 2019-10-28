<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }
}

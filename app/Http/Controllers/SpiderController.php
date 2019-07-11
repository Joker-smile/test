<?php
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 19-6-21
 * Time: 上午9:43
 */

namespace App\Http\Controllers;

use QL\QueryList;

class SpiderController extends Controller
{
    public function getImages()
    {
        return QueryList::get('https://www.forudesigns.com/')->find('li<img')->attrs('src');
    }
}
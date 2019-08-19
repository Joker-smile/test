<?php
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 19-6-21
 * Time: 上午9:43
 */

namespace App\Http\Controllers;

use Mohuishou\ImageOCR\Image;

class SpiderController extends Controller
{
    public function getImages()
    {
        $image=new Image($img_path);
        $image_ocr=new ImageOCR($image);
        $image_ocr->setStandardWidth(13);
        $image_ocr->setStandardHeight(20);
        $image_ocr->setDebug(true);

        try{
            $image_ocr->grey();
        }catch (\Exception $e){
            echo $e->getMessage();
        }

        try{
            $image_ocr->hash($max_grey=null,$min_grey=null);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}
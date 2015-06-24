<?php

namespace app\helpers;
use Yii;

class Helper {

    public static function pp($ar = ''){
        echo "<pre>";
        print_r($ar);
        echo "</pre>";
    }

}
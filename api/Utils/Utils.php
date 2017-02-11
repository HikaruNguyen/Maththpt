<?php

/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 17/1/2017
 * Time: 7:57 PM
 */
class Utils
{
    const X_Math_Api_Key = "manh123@abc";

    function checkHeader()
    {
        $header = getallheaders();
        if ($header['X-Math-Api-Key'] == self::X_Math_Api_Key) {
            return true;
        } else {
            return false;
        }
    }
}
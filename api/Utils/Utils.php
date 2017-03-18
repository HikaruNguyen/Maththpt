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
    const DB_CATEGORY = "tbl_category";
    const DB_BODE = "tbl_test";
    const DB_CONTAIN = "tbl_content";
    const DB_USER = "user";
    const DB_MANAGER = "tbl_manager";

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
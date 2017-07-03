<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 17/1/2017
 * Time: 9:21 AM
 */

include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');

$utils = new Utils();
$response = array();
const  per_page = 10;
if ($utils->checkHeader() == true) {
    $db = new DB_ADAPTER();
    $sql_querry = "SELECT tbl_category.id, tbl_category.name, COUNT(tbl_category.id) as countQuestion FROM tbl_category, tbl_content WHERE tbl_category.id = tbl_content.cateID GROUP BY tbl_category.id, tbl_category.name";

    $result = $db->get_data_use_query($sql_querry);

    if (http_response_code() == 200) {
        $response['success'] = true;

    } else {
        $response['success'] = false;
    }
    $response['status'] = http_response_code();
    $response['data'] = $result;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


?>
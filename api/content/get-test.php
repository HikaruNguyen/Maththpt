<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 17/1/2017
 * Time: 9:52 PM
 */
include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');

$utils = new Utils();
$response = array();
const  per_page = 10;
if ($utils->checkHeader() == true) {
    $db = new DB_ADAPTER();
    $sql_get_count = "SELECT count(id) as SL from tbl_test";
    $count_result = $db->get_data_use_query($sql_get_count);
    $total_record = (int)$count_result[0]['SL'];
    $total_page = $total_record / per_page;
    if (!isset($_GET['page'])) {
        $page = 0;
    } else {
        try {
            $page = (int)$_GET['page'];
        } catch (Exception $ex) {
            $page = 0;
        }
    }
    $begin_record = $page * per_page;
    $result = $db->get_all_record_paging('tbl_test', $begin_record, per_page);

    if (http_response_code() == 200) {
        $response['success'] = true;

    } else {
        $response['success'] = false;
    }
    $response['status'] = http_response_code();
    $response['totalPage'] = round($total_page, 0);
    $response['currentPage'] = round($page, 0);
    $response['data'] = $result;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


?>
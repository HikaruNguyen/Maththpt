<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 16/2/2017
 * Time: 9:02 PM
 */
include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');

$utils = new Utils();
$response = array();
const  per_page = 10;
const TYPE_CATEGORY = 1;
const TYPE_TESTS = 2;
if ($utils->checkHeader() == true) {
    $db = new DB_ADAPTER();
    if (!isset($_GET['type'])) {
        $type = 0;
    } else {
        try {
            $type = (int)$_GET['type'];
        } catch (Exception $ex) {
            $type = 0;
        }
    }
    $testID = 0;
    $cateID = 0;
    if ($type == 0) {
        $response['success'] = false;
        $response['status'] = 404;
        $response['message'] = 'Missing type content';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $sql_get_count = 0;
        $con = null;
        if ($type == TYPE_CATEGORY) {
            if (!isset($_GET['cateID'])) {
                $cateID = 0;
            } else {
                try {
                    $cateID = (int)$_GET['cateID'];
                } catch (Exception $ex) {
                    $cateID = 0;
                }
            }

            $sql_get_count = "SELECT count(id) as SL from " . Utils::DB_CONTAIN . " where cateID = " . $cateID;
            $con = array("cateID" => $cateID);
            //update review
            $result_countReview = $db->get_data_use_query("select countReview FROM " . Utils::DB_CATEGORY . " WHERE id= " . $cateID);
            $count_result = (int)$result_countReview[0]["countReview"];
            $count_result++;
            $db->update(Utils::DB_CATEGORY, array("countReview" => $count_result), array("id" => $cateID));

        } elseif ($type == TYPE_TESTS) {
            if (!isset($_GET['testID'])) {
                $testID = 0;
            } else {
                try {
                    $testID = (int)$_GET['testID'];
                } catch (Exception $ex) {
                    $testID = 0;
                }
            }
            $sql_get_count = "SELECT count(id) as SL from " . Utils::DB_CONTAIN . "  where testID = " . $testID;
            $con = array("testID" => $testID);
            //update review
            $result_countReview = $db->get_data_use_query("select countReview FROM " . Utils::DB_BODE . " WHERE id= " . $testID);
            $count_result = (int)$result_countReview[0]["countReview"];
            $count_result++;
            $db->update(Utils::DB_BODE, array("countReview" => $count_result), array("id" => $testID));
        }

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
        $con = null;
        if ($type == TYPE_CATEGORY) {
            $con = array("cateID" => $cateID);

        } elseif ($type == TYPE_TESTS) {
            $con = array("testID" => $testID);
        }
        $result = $db->get_by_conditions('tbl_content', $con);
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
    }

} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
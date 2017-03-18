<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 21/2/2017
 * Time: 8:46 PM
 */

include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');

$utils = new Utils();
$response = array();
if ($utils->checkHeader() == true) {
    $db = new DB_ADAPTER();
    $cateIDs = null;
    $number = 50;
    if (isset($_GET['cateIDs'])) {
        $cateIDs = $_GET['cateIDs'];
    }
    $arrCateID = explode("-", $cateIDs);
    if (isset($_GET['number'])) {
        $number = (int)$_GET['number'];
    }
    if (count($arrCateID) > 0 && $arrCateID[0] != "") {
        $sql = "SELECT * FROM tbl_content ";
        $sql .= " WHERE cateID = " . $arrCateID[0];
        if (count($arrCateID) > 1) {
            for ($i = 1; $i < count($arrCateID); $i++) {
                $sql .= " OR cateID = " . $arrCateID[$i];
            }
        }
        $sql .= " ORDER BY rand() LIMIT " . $number;
        if (http_response_code() == 200) {
            $response['success'] = true;

        } else {
            $response['success'] = false;
        }
        $result = $db->get_data_use_query($sql);
        $response['status'] = http_response_code();
        $response['data'] = $result;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        //update exam
        if (count($arrCateID) > 1) {
            for ($i = 1; $i < count($arrCateID); $i++) {
                $result_countExam = $db->get_data_use_query("select countExam FROM " . Utils::DB_CATEGORY . " WHERE id= " . $arrCateID[$i]);
                $count_result = (int)$result_countReview[0]["countExam"];
                $count_result++;
                $db->update(Utils::DB_CATEGORY, array("countExam" => $count_result), array("id" => $arrCateID[$i]));
            }
        }

    } else {
        $response['success'] = false;
        $response['status'] = '404';
        $response['message'] = 'Mã chuyên đề trống';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }


} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


?>
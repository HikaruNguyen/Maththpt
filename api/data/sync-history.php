<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.duc.manh
 * Date: 25/04/2017
 * Time: 10:04
 */
include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');
$utils = new Utils();
$response = array();
if ($utils->checkHeader() == true) {
    $listparam = [];
    if (!isset($_POST['datajson'])) {
        $response['success'] = true;
        $response['status'] = '200';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $param_string = $_POST['datajson'];
        $listparam = split(";", $param_string);
        if (sizeof($listparam) > 0) {
            $listobject = [];
            foreach ($listparam as $param) {
                $arr_param = split("\+", $param);
                $arr_param_tmp = array("point" => $arr_param[0], "time" => $arr_param[1], "userID" => $arr_param[2], "numQuestion" => $arr_param[3], "timeQuestion" => $arr_param[4], "listCate" => $arr_param[5], "totalQuestionTrue" => $arr_param[6]);
                array_push($listobject, $arr_param_tmp);
            }
//            var_dump($listobject);
            $db = new DB_ADAPTER();
            $insert = $db->insert_to_database_multiple_rows(Utils::DB_HISTORY, $listobject);
            if ($insert == true) {
                $response['success'] = true;
                $response['status'] = '200';
                $response['message'] = 'Đồng bộ thành công';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $response['success'] = false;
                $response['status'] = '500';
                $response['message'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $response['success'] = false;
            $response['status'] = '404';
            $response['message'] = 'Dữ liệu trống';
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }

    }

} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>

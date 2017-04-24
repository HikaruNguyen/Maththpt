<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 20/2/2017
 * Time: 10:53 PM
 */
include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');
$utils = new Utils();
$response = array();
if ($utils->checkHeader() == true) {
    $fullname = "";
    $email = "";
    $avatar = "";
    $fbId = "";
    if (!isset($_POST['email'])) {
        $email = "";
    } else {
        $email = $_POST['email'];
    }
    if (!isset($_POST['fullname'])) {
        $fullname = "";
    } else {
        $fullname = $_POST['fullname'];
    }
    if (!isset($_POST['fbId'])) {
        $fbId = "";
    } else {
        $fbId = $_POST['fbId'];
    }
    if (empty(trim($email))) {
        $response['success'] = false;
        $response['status'] = '401';
        $response['message'] = 'Email không được để trống';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } elseif (empty(trim($fbId))) {
        $response['success'] = false;
        $response['status'] = '401';
        $response['message'] = 'FacebookId không được để trống';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $db = new DB_ADAPTER();
        $con = array("fbId" => $fbId);
        $result = $db->get_by_conditions(Utils::DB_USER, $con);
        $token = sha1($fbId + time());
        if (count($result) > 0) {
            $object = array("token" => $token, "update_at" => time());
            $condistion = array("fbId" => $result[0]['fbId']);
            $update = $db->update(Utils::DB_USER, $object, $condistion);
            if ($update == true) {
                $response['success'] = true;
                $response['status'] = '200';
                $data['id'] = $result[0]['id'];
                $data['username'] = $result[0]['username'];
                $data['fullname'] = $result[0]['fullname'];
                $data['email'] = $result[0]['email'];
                $data['type'] = $result[0]['type'];
                $data['fbId'] = $result[0]['fbId'];
                $data['token'] = $result[0]['token'];
                $data['creat_at'] = $result[0]['creat_at'];
                $data['update_at'] = $result[0]['update_at'];
                $response['data'] = $data;
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $response['success'] = false;
                $response['status'] = '500';
                $response['message'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $time = time();
            $object = array(
                "username" => $fullname,
                "token" => $token,
                "fullname" => $fullname,
                "email" => $email,
                "type" => 1,
                "fbId" => $fbId,
                "creat_at" => $time,
                "update_at" => $time);
            $insert = $db->insert_to_database(Utils::DB_USER, $object);
            if ($insert == true) {
                $result = $db->get_by_conditions(Utils::DB_USER, $con);
                $response['success'] = true;
                $response['status'] = '200';
                $data['id'] = $result[0]['id'];
                $data['username'] = $result[0]['username'];
                $data['fullname'] = $result[0]['fullname'];
                $data['email'] = $result[0]['email'];
                $data['type'] = $result[0]['type'];
                $data['fbId'] = $result[0]['fbId'];
                $data['token'] = $result[0]['token'];
                $data['creat_at'] = $result[0]['creat_at'];
                $data['update_at'] = $result[0]['update_at'];
                $response['data'] = $data;
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $response['success'] = false;
                $response['status'] = '500';
                $response['message'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        }
    }
} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>

<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 20/2/2017
 * Time: 9:39 PM
 */
include '../../db/configdb.php';
require_once('../../db/DB_ADAPTER.php');
require_once('../Utils/Utils.php');
$utils = new Utils();
$response = array();
if ($utils->checkHeader() == true) {
    $username = "";
    $password = "";
    if (!isset($_POST['username'])) {
        $username = "";
    } else {
        $username = $_POST['username'];
    }
    if (!isset($_POST['password'])) {
        $password = "";
    } else {
        $password = $_POST['password'];
    }
    if (empty(trim($username))) {
        $response['success'] = false;
        $response['status'] = '401';
        $response['message'] = 'Tên đăng nhập không được để trống';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } elseif (empty(trim($password))) {
        $response['success'] = false;
        $response['status'] = '401';
        $response['message'] = 'Mật khẩu không được để trống';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $db = new DB_ADAPTER();
        $con = array("username" => $username, "password" => sha1($password));
        $result = $db->get_by_conditions(Utils::DB_USER, $con);
        if (count($result) == 0 || $result[0]['type'] == 1) {
            $response['success'] = false;
            $response['status'] = '401';
            $response['message'] = "Tên đăng nhập hoặc mật khẩu không đúng, vui lòng kiểm tra lại";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            //update token
            $token = sha1($username + time());
            $object = array("token" => $token, "update_at" => time());
            $condistion = array("id" => $result[0]['id']);
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
        }
    }
} else {
    $response['success'] = false;
    $response['status'] = '401';
    $response['message'] = 'Missing api key';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>

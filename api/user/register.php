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
    $username = "";
    $fullname = "";
    $password = "";
    $email = "";
    $avatar = "";
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
    if (!isset($_POST['avatar'])) {
        $avatar = "";
    } else {
        $avatar = $_POST['avatar'];
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
    } elseif (empty(trim($email))) {
        $response['success'] = false;
        $response['status'] = '401';
        $response['message'] = 'Email không được để trống';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $db = new DB_ADAPTER();
        $con = array("username" => $username);
        $result = $db->get_by_conditions('user', $con);
        if (count($result) > 0) {
            $response['success'] = false;
            $response['status'] = '401';
            $response['message'] = "Tên đăng nhập đã tồn tại";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $con = array("email" => $email);
            $result = $db->get_by_conditions('user', $con);
            if (count($result) > 0) {
                $response['success'] = false;
                $response['status'] = '401';
                $response['message'] = "Email đã tồn tại";
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $token = sha1($username + time());
                $object = array("username" => $username, "password" => sha1($password), "token" => $token, "fullname" => $fullname, "email" => $email,"type"=>2,"avatar"=>$avatar);
                $insert = $db->insert_to_database("user", $object);
                if ($insert == true) {
                    $response['success'] = true;
                    $response['status'] = '200';
                    $response['message'] = 'Đăng ký thành công';
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                } else {
                    $response['success'] = false;
                    $response['status'] = '500';
                    $response['message'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }
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

<?php
session_start();
include '../db/configdb.php';
require_once('../db/DB_ADAPTER.php');
require_once('utils/CRUDUtils.php');
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>HỆ THỐNG TRẮC NGHIỆM TOÁN HỌC THPT</title>
        <link href="../public/Content/bootstrap.min.css" rel="stylesheet"/>
        <link href="../public/Styles/Login.css" rel="stylesheet"/>
    </head>
    <body>
    <form action="login.php" method="post">
        <div class="login  container">
            <div class="logo">
                <img src="Images/logo.png" alt="" width="100" height="100" style="display: block;margin: 0 auto;"/>
            </div>

            <div class="form_login col-lg-4 col-lg-offset-4">
                <div class="content">
                    <!-- BEGIN LOGIN FORM -->
                    <label>ĐĂNG NHẬP HỆ THỐNG</label>
                    <div class="form-group" style="margin-top: 25px;">
                        <input id="txtUserName" name="txtUserName"
                               class="form-control form-control-solid placeholder-no-fix"
                               placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <input type="password" name="txtPassword" placeholder="Mật khẩu" id="txtPassword"
                               class="form-control form-control-solid placeholder-no-fix">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success uppercase">Đăng nhập</button>
                    </div>
                    <!-- END LOGIN FORM -->
                </div>

            </div>

        </div>
    </form>
    </body>
    </html>
<?php
if (isset($_POST['txtUserName']) && isset($_POST['txtPassword'])) {
    if ($_POST['txtUserName'] == null || trim($_POST['txtUserName']) == "" || $_POST['txtPassword'] == null || trim($_POST['txtPassword']) == "") {
        $message = "Vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $username = $_POST['txtUserName'];
        $password = $_POST['txtPassword'];
        $db = new DB_ADAPTER();
        $con = array("username" => $username, "password" => sha1($password));
        $result = $db->get_by_conditions(CRUDUtils::$DB_MANAGER, $con);
        if (count($result) > 0) {
            $_SESSION['token'] = sha1($username + $password);
            $_SESSION['username'] = $username;
            $_SESSION['typeUser'] = $result[0]['type'];
            header('location:views/home');
        } else {
            $message = "Kiểm tra lại tài khoản và mật khẩu ";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}

?>
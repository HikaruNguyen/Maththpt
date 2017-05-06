<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.duc.manh
 * Date: 14/04/2017
 * Time: 10:20
 */

session_start();
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    require_once('../../utils/CRUDUtils.php');
    include '../includes/header.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = 0;
        $result = CRUDUtils::resetPasswordManager($id);
        if ($result == 1) {
            echo '<script language="javascript">';
            echo 'alert("Khôi phục mật khẩu thành công")';
            echo '</script>';
            echo "<script>history.go(-1);</script>";

        } else {
            echo '<script language="javascript">';
            echo 'alert("Xảy ra lỗi, vui lòng thử lại sau")';
            echo '</script>';
        }

    }
}
?>

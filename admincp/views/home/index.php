<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 4:21 PM
 */

session_start();
//unset($_SESSION['token']);
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    include '../includes/header.php';
    include '../../includes/home.php';
    include '../../includes/footer.php';
} else {
    header('location:../../login.php');
}

?>
<html>
<head>
    <link href="../../../public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
</head>
</html>

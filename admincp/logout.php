<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 4:30 PM
 */
session_start();
unset($_SESSION['username']);
unset($_SESSION['token']);
unset($_SESSION['typeUser']);
header('location: login.php');
?>
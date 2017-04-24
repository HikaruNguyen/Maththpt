<?php

session_start();
if (isset($_SESSION['token'])) {
    header('location:views/home');
} else {
    header('location:login.php');
}
?>
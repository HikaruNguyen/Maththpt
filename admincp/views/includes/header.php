<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 10:55 AM
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>HỆ THỐNG TRẮC NGHIỆM TOÁN HỌC THPT</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="HỆ THỐNG TRẮC NGHIỆM TOÁN HỌC THPT" name="description"/>
    <meta content="Nguyen Duc Manh" name="author"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="../../../public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="../../../public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"/>
    <link href="../../../public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../../public/assets/global/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
    <link href="../../../public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"/>

    <!-- BEGIN PAGE STYLES -->
    <link href="../../../public/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="../../../public/assets/global/css/components.css" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="../../../public/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="../../../public/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="../../../public/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>

    <link href="../../../public/Styles/main.css" rel="stylesheet"/>

</head>
<body>
<div id="form1"
     class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <img src="../../Images/logo.png" Width="40" Height="40"/>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle"
                                 src="../../../public/assets/admin/layout/img/avatar3_small.jpg"/>
                            <span class="username username-hide-on-mobile">
                                    <label id="txtUserName">

                                        Xin chào
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                            echo trim($_SESSION['username']);
                                        }
                                        ?>
                                    </label>
                                </span>
                        </a>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="../../logout.php" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>

    <div class="clearfix"></div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div id="mymenu " class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200">
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <li class="sidebar-toggler-wrapper" style="margin-bottom: 12px;">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler">
                        </div>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                    </li>

                    <li class="" id="Menu_Home">
                        <a href="../home">
                            <i class="icon-home"></i>
                            <span class="title">Trang chủ</span>
                            <span class="selected"></span>

                        </a>
                    </li>
                    <li id="Menu_ChuyenDe">
                        <a href="../category">
                            <i class="fa fa-bookmark"></i>
                            <span class="title">Quản lý chuyên đề</span>

                        </a>
                    </li>
                    <li id="Menu_BoDe">
                        <a href="../test">
                            <i class="fa fa-book"></i>
                            <span class="title">Quản lý bộ đề</span>
                        </a>
                    </li>
                    <li id="Menu_Contain">
                        <a href="../content">
                            <i class="fa fa-file"></i>
                            <span class="title">Quản lý câu hỏi</span>
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['typeUser'])) {
                        if ((int)$_SESSION['typeUser'] == 1) {
                            echo "<li id=\"Menu_User\">
                        <a href=\"../user\">
                            <i class=\"fa fa-group\"></i>
                            <span class=\"title\">Quản lý người dùng</span>
                        </a>
                    </li>
                    <li id=\"Menu_Manager\">
                        <a href=\"../manager\">
                            <i class=\"icon-user\"></i>
                            <span class=\"title\">Quản lý quản trị viên</span>

                        </a>
                    </li>";
                        }
                    }
                    ?>

                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content" style="min-height: 873px">

<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 15/1/2017
 * Time: 10:45 AM
 */

session_start();
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    require_once('../../utils/CRUDUtils.php');
    include '../includes/header.php';
    $db = new DB_ADAPTER();
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        $idContent = "";
        $nameContent = "";
        $authorContain = "";
        $activated = 1;
        if ($type == 'edit' || $type == 'delete') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $con = array("id" => $id);
                $data = $db->get_by_conditions("tbl_test", $con);
                if (count($data) > 0) {
                    $idContent = $data[0]['id'];
                    $nameContent = $data[0]['displayname'];
                    $authorContain = $data[0]['author'];
                    $activated = (int)$data[0]['activated'];
                }
            }
        }
        ?>
        <form action="" method="post">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bookmark"></i>
                        <?php
                        if ($type == "add") {
                            echo "Thêm bộ đề";
                        } else if ($type == "edit") {
                            echo "Sửa bộ đề";
                        } else if ($type == "delete") {
                            echo "Xóa bộ đề";
                        }
                        ?>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="alert alert-danger" id="div_error" style="display: none">
                        <span>
        <!--                    <asp:Label ID="lblError" runat="server" Text="Đã xảy ra lỗi"></asp:Label>-->

                        </span>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            Mã bộ đề
                            (*)
                            <input id="txtID" name="txtID" class="form-control" readonly
                                   value="<?php echo $idContent ?>">
                        </div>
                        <div class="form-group">
                            Tên bộ đề
                            (*)
                            <input id="txtName" name="txtName" class="form-control" value="<?php echo $nameContent ?>">
                        </div>
                        <div class="form-group">
                            Tác giả
                            (*)
                            <input id="txtAuthor" name="txtAuthor" class="form-control"
                                   value="<?php echo $authorContain ?>">
                        </div>
                        <div class="form-group">
                            Kích hoạt
                            (*)
                            <select class="form-control" name="activated" id="activated">
                                <option value="1"
                                    <?php
                                    if ($activated == 1) {
                                        echo " Selected='selected'";
                                    }
                                    ?>
                                >Hiển thị
                                </option>
                                <option value="0"
                                    <?php
                                    if ($activated == 0) {
                                        echo " Selected='selected'";
                                    }
                                    ?>>Ẩn
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <button id="btnCancel" type="button" class="btn default">Hủy</button>
                        <button id="btnOK" type="submit" class="btn green">
                            <?php
                            if ($type == 'add') {
                                echo "Thêm";
                            } else if ($type == 'edit') {
                                echo "Sửa";
                            } else if ($type == 'delete') {
                                echo "Xóa";
                            }
                            ?>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php

        include '../includes/footer.php';

        ?>
        <script>
            document.getElementById("Menu_BoDe").className = "active open";
        </script>
        <?php
        if (!empty($_POST)) {
            ob_start();

            if ($type != null && trim($type) != "") {
                if ((isset($_POST['txtID']) || $type == 'add') && isset($_POST['txtName']) && isset($_POST['txtAuthor'])) {

                    if ((($_POST['txtID'] != null && trim($_POST['txtID']) != "") || $type == 'add') && $_POST['txtName'] != null && trim($_POST['txtName']) != ""
                        && $_POST['txtAuthor'] != null && trim($_POST['txtAuthor'])
                    ) {
                        $result = 0;
                        $result = CRUDUtils::manageBoDe($type, $_POST['txtID'], $_POST['txtName'], $_POST['txtAuthor'], $_POST['activated']);
//            var_dump("result " . $result);
                        if ($result == 1) {
//                    header('location:../test');
                            echo "<script>history.go(-2);</script>";
                        }
                    }
                }

            }
            ob_end_flush();
        }
    }
} else {
    header('location:../../login.php');
}
?>
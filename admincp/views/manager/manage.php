<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 15/3/2017
 * Time: 9:25 PM
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
        $idUser = "";
        $userName = "";
        $fullName = "";
        $email = "";
        $typeUser = "";
        if ($type == 'edit' || $type == 'delete') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $con = array("id" => $id);
                $data = $db->get_by_conditions(CRUDUtils::$DB_MANAGER, $con);
                if (count($data) > 0) {
                    $idUser = $data[0]['id'];
                    $userName = $data[0]['username'];
                    $fullName = $data[0]['fullname'];
                    $email = $data[0]['email'];
                    $typeUser = $data[0]['type'];
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
                            echo "Thêm quản trị viên";
                        } else if ($type == "edit") {
                            echo "Sửa quản trị viêng";
                        } else if ($type == "delete") {
                            echo "Xóa quản trị viên";
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
                            Mã quản trị viên
                            (*)
                            <input id="txtID" name="txtID" class="form-control" readonly
                                   value="<?php echo $idUser ?>">
                        </div>
                        <div class="form-group">
                            Tên đăng nhập
                            (*)
                            <input id="txtUserName" name="txtUserName" class="form-control"
                                   value="<?php echo $userName ?>">
                        </div>
                        <div class="form-group">
                            Tên đầy đủ
                            (*)
                            <input id="txtFullName" name="txtFullName" class="form-control"
                                   value="<?php echo $fullName ?>">
                        </div>
                        <div class="form-group">
                            Email quản trị viên
                            (*)
                            <input id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            Vai trò
                            (*)
                            <select class="form-control" name="txtType" id="activated">
                                <option value="1"
                                    <?php
                                    if ($typeUser == 1) {
                                        echo " Selected='selected'";
                                    }
                                    ?>
                                >Admin
                                </option>
                                <option value="0"
                                    <?php
                                    if ($typeUser == 2) {
                                        echo " Selected='selected'";
                                    }
                                    ?>>Editor
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
    }
    include '../includes/footer.php';
} else {
    header('location:../../login.php');
}
?>
    <script>
        document.getElementById("Menu_Manager").className = "active open";
    </script>
<?php
if (!empty($_POST)) {
    ob_start();

    if ($type != null && trim($type) != "") {
        if ((isset($_POST['txtID']) || $type == 'add') && isset($_POST['txtUserName'])
            && isset($_POST['txtFullName']) && isset($_POST['txtEmail'])
        ) {

            if ((($_POST['txtID'] != null && trim($_POST['txtID']) != "") || $type == 'add') && $_POST['txtUserName'] != null && trim($_POST['txtUserName']) != ""
                && $_POST['txtFullName'] != null && trim($_POST['txtFullName']) != ""
                && $_POST['txtEmail'] != null && trim($_POST['txtEmail']) != ""

            ) {
                $result = 0;
                $result = CRUDUtils::manageManager($type, $_POST['txtID'], $_POST['txtUserName'], $_POST['txtFullName'], $_POST['txtEmail'], $_POST['txtType']);
//            var_dump("result " . $result);
                if ($result == 1) {
                    header('location:../manager');
                }
            }
        }

    }
    ob_end_flush();
}
?>
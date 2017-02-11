<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 5:04 PM
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
        if ($type == 'edit' || $type == 'delete') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $con = array("id" => $id);
                $data = $db->get_by_conditions("tbl_category", $con);
                if (count($data) > 0) {
                    $idContent = $data[0]['id'];
                    $nameContent = $data[0]['name'];
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
                            echo "Thêm chuyên đề";
                        } else if ($type == "edit") {
                            echo "Sửa chuyên đề";
                        } else if ($type == "delete") {
                            echo "Xóa chuyên đề";
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
                            Mã chuyên đề
                            (*)
                            <input id="txtID" name="txtID" class="form-control" readonly
                                   value="<?php echo $idContent ?>">
                        </div>
                        <div class="form-group">
                            Tên chuyên đề
                            (*)
                            <input id="txtName" name="txtName" class="form-control" value="<?php echo $nameContent ?>">
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
        document.getElementById("Menu_ChuyenDe").className = "active open";
    </script>
<?php
if (!empty($_POST)) {
    ob_start();

    if ($type != null && trim($type) != "") {
        if ((isset($_POST['txtID']) || $type == 'add') && isset($_POST['txtName'])) {

            if ((($_POST['txtID'] != null && trim($_POST['txtID']) != "") || $type == 'add') && $_POST['txtName'] != null && trim($_POST['txtName']) != "") {
                $result = 0;
                $result = CRUDUtils::manageChuyenDe($type, $_POST['txtID'], $_POST['txtName']);
//            var_dump("result " . $result);
                if ($result == 1) {
                    header('location:../category');
                }
            }
        }

    }
    ob_end_flush();
}
?>
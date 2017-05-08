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
    if (isset($_GET['id'])) {
        $userID = $_GET['id'];
        $con = array("userID" => $userID);
        $data = $db->get_by_conditions(CRUDUtils::$DB_HISTORY, $con);
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bookmark"></i>Lịch sử người dùng
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <button type="button" id="btnAdd" class="btn green"
                                                onclick="location.href = 'manage.php?type=add';">Thêm mới
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>STT
                                </th>
                                <th>Ngày/tháng/năm
                                </th>
                                <th>Số câu
                                </th>
                                <th>Thời gian (phút)
                                </th>
                                <th>Danh sách chuyên đề
                                </th>
                                <th>Điểm
                                </th>
                            </tr>
                            </thead>
                            <tbody class="body_table">
                            <?php
                            if (count($data) > 0) {
                                $row_table = "";
                                for ($i = 0; $i < count($data); $i++) {
//                            echo $result[$i]['name'];
//                            echo "<br/>";
                                    $row_table = $row_table . "<tr><td>" . ($i + 1) . "</td>";
                                    $row_table = $row_table . "<td>" . date('d/m/Y', $data[$i]['time'] / 1000) . "</td>";
                                    $row_table = $row_table . "<td>" . $data[$i]['numQuestion'] . "</td>";
                                    $row_table = $row_table . "<td>" . gmdate('H\h:ip', $data[$i]['timeQuestion'] / 1000) . "</td>";
                                    $row_table = $row_table . "<td>" . $data[$i]['listCate'] . "</td>";
                                    $row_table = $row_table . "<td>" . $data[$i]['point'] . "</td>";
                                    $row_table = $row_table . "</tr>";
                                }
                                echo $row_table;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <?php
    }
    include '../includes/footer.php';
} else {
    header('location:../../login.php');
}
?>
<script>
    document.getElementById("Menu_User").className = "active open";
</script>
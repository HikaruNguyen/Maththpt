<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 4:15 PM
 */
session_start();
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    include '../includes/header.php';
    $db = new DB_ADAPTER();
    $result = $db->get_all_record('tbl_category');
    ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bookmark"></i>Quản lý chuyên đề
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
                            <th>Mã chuyên đề
                            </th>
                            <th>Tên Chuyên đề
                            </th>
                            <th>Sửa
                            </th>
                            <th>Xóa
                            </th>
                        </tr>
                        </thead>
                        <tbody class="body_table">
                        <?php
                        if (count($result) > 0) {
                            $row_table = "";
                            for ($i = 0; $i < count($result); $i++) {
//                            echo $result[$i]['name'];
//                            echo "<br/>";
                                $row_table = $row_table . "<tr><td>" . ($i + 1) . "</td>";
                                $row_table = $row_table . "<td>" . $result[$i]['id'] . "</td>";
                                $row_table = $row_table . "<td>" . $result[$i]['name'] . "</td>";
                                $row_table = $row_table . "<td>" . "<a class='edit' href='manage.php?type=edit&id=" . $result[$i]['id'] . "'>Sửa</a>" . "</td>";
                                $row_table = $row_table . "<td>" . "<a class='delete' href='manage.php?type=delete&id=" . $result[$i]['id'] . "'>Xóa</a>" . "</td>";
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
    include '../includes/footer.php';
} else {
    header('location:../../login.php');
}
?>
<script>
    document.getElementById("Menu_ChuyenDe").className = "active open";
</script>
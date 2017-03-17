<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 15/3/2017
 * Time: 8:41 PM
 */
session_start();
$per_page = 10;
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    require_once('../../utils/CRUDUtils.php');
    include '../includes/header.php';
    $db = new DB_ADAPTER();
    if (!isset($_GET['page'])) {
        $page = 0;
    } else {
        try {
            $page = (int)$_GET['page'];
        } catch (Exception $ex) {
            $page = 0;
        }
    }
    $sql_get_count = "SELECT count(user.id) as SL from " . CRUDUtils::$DB_USER;
    $sql = "SELECT user.id, user.username, user.fullname, user.email, user.type FROM " . CRUDUtils::$DB_USER;

    $count_result = $db->get_data_use_query($sql_get_count);
    $total_record = (int)$count_result[0]['SL'];

    $total_page = $total_record / $per_page;
    $current_page = $page * $per_page;


    $sql = $sql . " LIMIT {$current_page},{$per_page}";
    $result = $db->get_data_use_query($sql);
    ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bookmark"></i>Quản lý người dùng
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button type="button" id="btnAdd" class="btn green"
                                            onclick="location . href = 'manage.php?type=add';">Thêm mới
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-bordered " id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>STT
                                </th>
                                <th>Mã người dùng
                                </th>
                                <th>Tên đăng nhập
                                </th>
                                <th>Tên đầy đủ
                                </th>
                                <th>Email
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
                                    $row_table = $row_table . "<tr><td > " . ($i + 1 + $page * $per_page) . "</td> ";
                                    $row_table = $row_table . "<td>" . $result[$i]['id'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['username'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['fullname'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['email'] . "</td> ";
                                    $row_table = $row_table . "<td> " . "<a class='edit' href = 'manage.php?type=edit&id=" . $result[$i]['id'] . "' > Sửa</a> " . "</td> ";
                                    $row_table = $row_table . "<td> " . "<a class='delete' href = 'manage.php?type=delete&id=" . $result[$i]['id'] . "' > Xóa</a> " . "</td> ";
                                    $row_table = $row_table . "</tr> ";
                                }
                                echo $row_table;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($total_page > 1) { ?>
                        <div class="dataTables_paginate paging_simple_numbers" id="sample_2_paginate">
                            <ul class="pagination">
                                <?php
                                if ($page > 0) {
                                    $pre_page = $page - 1;
                                    echo "<li class='paginate_button previous' aria-controls=\"sample_2\" tabindex=\"0\"
                                id='sample_2_previous'><a href='" . hrefFilter($per_page) . "'><i class='fa fa-angle-left'></i></a></li>";
                                }

                                for ($i = 0; $i < $total_page; $i++) {
                                    $li = "<li class='paginate_button ";
                                    if ($i == $page) {
                                        $li = $li . "active";
                                    }
                                    $li = $li . "' aria-controls='sample_2' tabindex='0'><a href='" . hrefFilter($i) . "'>{$i}</a></li>";
                                    echo $li;
                                }

                                if ($page <= $total_page - 1) {
                                    $next_page = $page + 1;
                                    echo " <li class='paginate_button next' aria-controls='sample_2' tabindex='0' id='sample_2_next'><a
                                    href='" . hrefFilter($next_page) . "'><i class='fa fa-angle-right'></i></a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    <?php } ?>
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
    document.getElementById("Menu_User").className = "active open";
</script>
<?php
function hrefFilter($page)
{
    $link = "index.php?page={$page}";
    return $link;
}

?>
<script type="text/javascript" async
        src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=MML_CHTML">
    MathJax.Hub.Config({
        CommonHTML: {
            scale: 80
        }
    });
</script>
<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 15/1/2017
 * Time: 11:02 AM
 */
session_start();
$per_page = 10;
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
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
    $con = array();
    if (!isset($_GET['cateID'])) {
        $cate = 0;
    } else {
        try {
            $cate = (int)$_GET['cateID'];
            $con['cateID'] = $cate;
        } catch (Exception $ex) {
            $cate = 0;
        }
    }
    if (!isset($_GET['testID'])) {
        $test = 0;
    } else {
        try {
            $test = (int)$_GET['testID'];
            $con['testID'] = $test;
        } catch (Exception $ex) {
            $test = 0;
        }
    }
    $sql_get_count = "SELECT count(tbl_content.id) as SL from tbl_content";
    $sql = "SELECT DISTINCT tbl_content.id,question,answerA,answerB,answerC,answerD,answerTrue, tbl_category.name as 'chuyende', tbl_test.displayname as 'test'
FROM tbl_content
INNER JOIN tbl_category
on tbl_content.cateID = tbl_category.id
INNER JOIN tbl_test
ON tbl_content.testID = tbl_test.id";

    if (count($con) > 0) {

        $condistion_temp = "";
        foreach ($con as $key => $value) {
            $condistion_temp .= $key . "='" . $value . "' AND ";
        }
        trim($condistion_temp);
        $condistion = substr($condistion_temp, 0, strlen($condistion_temp) - 4);
        $sql .= " WHERE " . $condistion;
        $sql_get_count .= " WHERE " . $condistion;
    }
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
                        <i class="fa fa-bookmark"></i>Quản lý câu hỏi
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="btn-group">
                                    <button type="button" id="btnAdd" class="btn green"
                                            onclick="location . href = 'manage.php?type=add';">Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="test" id="test" title="test"
                                        onchange="filterContent()">
                                    <option value="0" <?php if ($test == 0) echo "selected='selected'" ?>>Tất cả
                                    </option>
                                    <?php
                                    $dataTest = $db->get_all_record("tbl_test");
                                    if (count($dataTest) > 0) {
                                        for ($i = 0; $i < count($dataTest); $i++) {
//                                        $op = "<option value='$dataCate[$i]['id']'";
                                            $op = "<option value='";
                                            $op = $op . $dataTest[$i]['id'];
                                            $op = $op . "' ";
                                            if ($test == $dataTest[$i]['id']) {
                                                $op = $op . "selected='selected'";
                                            }
                                            $op = $op . ">" . $dataTest[$i]['displayname'] . "</option>";
                                            echo $op;
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="category" id="category" title="category"
                                        onchange="filterContent()">
                                    <option value="0">Tất cả</option>
                                    <?php
                                    $dataCate = $db->get_all_record("tbl_category");
                                    if (count($dataCate) > 0) {
                                        for ($i = 0; $i < count($dataCate); $i++) {
//                                        $op = "<option value='$dataCate[$i]['id']'";
                                            $op = "<option value='";
                                            $op = $op . $dataCate[$i]['id'];
                                            $op = $op . "' ";
                                            if ($cate == $dataCate[$i]['id']) {
                                                $op = $op . "selected='selected'";
                                            }
                                            $op = $op . ">" . $dataCate[$i]['name'] . "</option>";
                                            echo $op;
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-bordered " id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>STT
                                </th>
                                <!--                            <th>Mã Câu hỏi-->
                                <!--                            </th>-->
                                <th>Câu hỏi
                                </th>
                                <th>ĐA 1
                                </th>
                                <th>ĐA 2
                                </th>
                                <th>ĐA 3
                                </th>
                                <th>ĐA 4
                                </th>
                                <th>ĐA Đúng
                                </th>
                                <th>Bộ đề
                                </th>
                                <th>Chuyên đề
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
                                    $row_table = $row_table . "<tr><td > " . ($i + 1) . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['question'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['answerA'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['answerB'] . "</td> ";
                                    $row_table = $row_table . "<td>  " . $result[$i]['answerC'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['answerD'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['answerTrue'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['test'] . "</td> ";
                                    $row_table = $row_table . "<td> " . $result[$i]['chuyende'] . "</td> ";
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
                                id='sample_2_previous'><a href='" . hrefFilter($per_page, $con) . "'><i class='fa fa-angle-left'></i></a></li>";
                                }

                                for ($i = 0; $i < $total_page; $i++) {
                                    $li = "<li class='paginate_button ";
                                    if ($i == $page) {
                                        $li = $li . "active";
                                    }
                                    $li = $li . "' aria-controls='sample_2' tabindex='0'><a href='" . hrefFilter($i, $con) . "'>{$i}</a></li>";
                                    echo $li;
                                }

                                if ($page <= $total_page - 1) {
                                    $next_page = $page + 1;
                                    echo " <li class='paginate_button next' aria-controls='sample_2' tabindex='0' id='sample_2_next'><a
                                    href='" . hrefFilter($next_page, $con) . "'><i class='fa fa-angle-right'></i></a></li><ul>";
                                }
                                ?>

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
    document.getElementById("Menu_Contain").className = "active open";
    function filterContent() {
        var cateID = $("#category").val();
        var testID = $("#test").val();
        var url = "index.php";
        if (cateID != 0) {
            url += "?cateID=" + cateID;
        }
        if (testID != 0) {
            if (cateID == 0) {
                url += "?testID=" + testID;
            } else {
                url += "&testID=" + testID;
            }

        }
        window.location.href = url;
    }
</script>

<?php
function hrefFilter($page, $con)
{
    $link = "index.php?page={$page}";
    if (is_array($con)) {
        if (count($con) > 0) {
            $condistion_temp = "";
            foreach ($con as $key => $value) {
                $condistion_temp .= "&" . $key . "=" . $value;
            }
            $link .= $condistion_temp;
        }
    }
    return $link;
}

?>
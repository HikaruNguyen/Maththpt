<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 4:21 PM
 */

session_start();
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    require_once('../../utils/CRUDUtils.php');
    include '../includes/header.php';
    $db = new DB_ADAPTER();
    $countTests = $db->get_count_use_query("SELECT COUNT(id) as SL from " . CRUDUtils::$DB_BODE);
    $countQuestion = $db->get_count_use_query("SELECT COUNT(id) as SL from " . CRUDUtils::$DB_CONTAIN);
    $countUser = $db->get_count_use_query("SELECT COUNT(id) as SL from " . CRUDUtils::$DB_USER);
    ?>
    <div class="row" style="margin-top: 10px">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat box1">
                <div class="visual">
                    <i class="fa fa-book"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $countTests ?>
                    </div>
                    <div class="desc">
                        Số lượng đề thi
                    </div>
                </div>
                <span class="more"></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat box2">
                <div class="visual">
                    <i class="fa fa-file"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $countQuestion ?>
                    </div>
                    <div class="desc">
                        Số lượng câu hỏi
                    </div>
                </div>
                <span class="more"></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat box3">
                <div class="visual">
                    <i class="fa fa-group"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $countUser ?>
                    </div>
                    <div class="desc">
                        Số lượng thành viên
                    </div>
                </div>
                <span class="more"></span>
            </div>
        </div>
    </div>
    <?php
    include '../includes/footer.php';
} else {
    header('location:../../login.php');
}
?>
<script>
    document.getElementById("Menu_Home").className = "active open";
</script>
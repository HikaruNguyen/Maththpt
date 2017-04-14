<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link href="../../../public/Styles/style.css" rel="stylesheet">
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 bordered">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800"> <?php echo $countTests ?></span>
                            <small class="font-green-sharp">Đề</small>
                        </h3>
                        <small>Số lượng đề thi</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 bordered">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800"> <?php echo $countQuestion ?></span>
                            <small class="font-green-sharp">Câu</small>
                        </h3>
                        <small>Số lượng câu hỏi</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 bordered">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800"> <?php echo $countUser ?></span>
                            <small class="font-green-sharp">thành viên</small>
                        </h3>
                        <small>Số lượng thành viên</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN CHART PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-haze"></i>
                        <span class="caption-subject bold uppercase font-green-haze"> Biểu đồ</span>
                        <span class="caption-helper">Thống kê tỷ lệ ôn tập theo chuyên đề</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_4" class="chart" style="height: 400px;">
                        <div id="chartCategory"></div>
                        <?php
                        $sql_count = "SELECT id,name, countReview*100/(select sum(countReview) from " . CRUDUtils::$DB_CATEGORY . " ) as countReview FROM " . CRUDUtils::$DB_CATEGORY;
                        $result = $db->get_data_use_query($sql_count);
                        $dataPoints = array();
                        if ($result != null && count($result) > 0) {
                            for ($i = 0; $i < count($result); $i++) {
                                array_push($dataPoints, array("y" => (float)round($result[$i]["countReview"], 2), "legendText" => $result[$i]["name"], "label" => $result[$i]["name"]));
                            }
                        }
                        ?>
                        <script type="text/javascript">
                            $(function () {
                                var chart = new CanvasJS.Chart("chartCategory", {
//                                    title: {
//                                        text: "Thống kê tỷ lệ ôn tập theo chuyên đề"
//                                    },
                                    animationEnabled: true,
                                    legend: {
                                        verticalAlign: "center",
                                        horizontalAlign: "left",
                                        fontSize: 15,
                                        fontFamily: "Roboto"
                                    },
                                    theme: "theme2",
                                    data: [
                                        {
                                            type: "pie",
                                            indexLabelFontFamily: "Garamond",
                                            indexLabelFontSize: 13,
                                            indexLabel: "{label} {y}%",
                                            startAngle: -20,
                                            showInLegend: true,
                                            toolTipContent: "{legendText} {y}%",
                                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                        }
                                    ]
                                });
                                chart.render();
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!-- END CHART PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN CHART PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-haze"></i>
                        <span class="caption-subject bold uppercase font-green-haze"> Biểu đồ</span>
                        <span class="caption-helper">Thống kê tỷ lệ kiểm tra theo chuyên đề</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_4" class="chart" style="height: 400px;">
                        <div id="chartCategoryExam"></div>
                        <?php
                        $sql_count = "SELECT id,name, countExam*100/(select sum(countExam) from " . CRUDUtils::$DB_CATEGORY . " ) as countReview FROM " . CRUDUtils::$DB_CATEGORY;
                        $result = $db->get_data_use_query($sql_count);
                        $dataPoints = array();
                        if ($result != null && count($result) > 0) {
                            for ($i = 0; $i < count($result); $i++) {
                                array_push($dataPoints, array("y" => (float)round($result[$i]["countReview"], 2), "legendText" => $result[$i]["name"], "label" => $result[$i]["name"]));
                            }
                        }
                        ?>
                        <script type="text/javascript">
                            $(function () {
                                var chart = new CanvasJS.Chart("chartCategoryExam", {
//                                    title: {
//                                        text: "Thống kê tỷ lệ kiểm tra theo chuyên đề"
//                                    },
                                    animationEnabled: true,
                                    legend: {
                                        verticalAlign: "center",
                                        horizontalAlign: "left",
                                        fontSize: 15,
                                        fontFamily: "Roboto"
                                    },
                                    theme: "theme2",
                                    data: [
                                        {
                                            type: "pie",
                                            indexLabelFontFamily: "Garamond",
                                            indexLabelFontSize: 13,
                                            indexLabel: "{label} {y}%",
                                            startAngle: -20,
                                            showInLegend: true,
                                            toolTipContent: "{legendText} {y}%",
                                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                        }
                                    ]
                                });
                                chart.render();
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!-- END CHART PORTLET-->
        </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN CHART PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-haze"></i>
                        <span class="caption-subject bold uppercase font-green-haze"> Biểu đồ</span>
                        <span class="caption-helper">Thống kê tỷ lệ ôn tập theo bộ đề</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_4" class="chart" style="height: 400px;">
                        <div id="chartTests"></div>
                        <?php
                        $sql_count = "SELECT id,displayname as name, countReview*100/(select sum(countReview) from " . CRUDUtils::$DB_BODE . " ) as countReview FROM " . CRUDUtils::$DB_BODE;
                        $result = $db->get_data_use_query($sql_count);

                        $dataTests = array();
                        if ($result != null && count($result) > 0) {
                            for ($i = 0; $i < count($result); $i++) {
                                array_push($dataTests, array("y" => (float)round($result[$i]["countReview"], 2), "legendText" => $result[$i]["name"], "label" => $result[$i]["name"]));
                            }
                        }
                        ?>
                        <script type="text/javascript">
                            $(function () {
                                var chart = new CanvasJS.Chart("chartTests", {
//                                    title: {
//                                        text: "Thống kê tỷ lệ ôn tập theo chuyên đề"
//                                    },
                                    animationEnabled: true,
                                    legend: {
                                        verticalAlign: "center",
                                        horizontalAlign: "left",
                                        fontSize: 15,
                                        fontFamily: "Roboto"
                                    },
                                    theme: "theme2",
                                    data: [
                                        {
                                            type: "pie",
                                            indexLabelFontFamily: "Garamond",
                                            indexLabelFontSize: 13,
                                            indexLabel: "{label} {y}%",
                                            startAngle: -20,
                                            showInLegend: true,
                                            toolTipContent: "{legendText} {y}%",
                                            dataPoints: <?php echo json_encode($dataTests, JSON_NUMERIC_CHECK); ?>
                                        }
                                    ]
                                });
                                chart.render();
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!-- END CHART PORTLET-->
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

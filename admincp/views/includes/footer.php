<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 10:57 AM
 */
?>
</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->


</div>


<script src="../../../public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../../public/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../../public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../../public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../../../public/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="../../../public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="../../../public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../../public/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../../public/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../../public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../../public/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../../public/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../../public/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../../public/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../../public/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="../../../public/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script src="../../../public/assets/admin/pages/scripts/table-editable.js"></script>
<script type="text/javascript"
        src="../../../public/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="../../../public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript"
        src="../../../public/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="../../../public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="../../../public/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript"
        src="../../../public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../../../public/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="../../../public/assets/admin/pages/scripts/table-managed.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Index.init();
        Index.initChat();
        Index.initMiniCharts();
        Tasks.initDashboardWidget();
        TableManaged.init();
        //TableEditable.init();
    });
</script>
</body>
</html>


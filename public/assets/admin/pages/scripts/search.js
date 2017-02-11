var Search = function () {

    return {
        //main function to initiate the modules
        init: function () {
            if (jQuery().datepicker) {
                $('.date-picker').datepicker();
            }

            Metronic.initFancybox();
        }

    };

}();
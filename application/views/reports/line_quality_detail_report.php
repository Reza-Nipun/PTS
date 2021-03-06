<style>
    .loader {
        border: 20px solid #f3f3f3;
        border-radius: 50%;
        border-top: 20px solid #3498db;
        width: 35px;
        height: 35px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Line Quality Report</h1>
        <h2 class="">Line Quality Report...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Line Quality Report</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div class="header">
                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                    <h3 class="content-header"></h3>
                </div>

                <div class="porlets-content">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <select class="form-control" name="report_type" id="report_type">
                                    <option value="">Select Report Type</option>
                                    <option value="0">Right at First Time</option>
                                    <option value="1">Duplicate Defects</option>
                                    <option value="2">Single Defects</option>
                                </select>
                                <input type="hidden" name="date" id="date" value="<?php echo $date?>" />
                                <input type="hidden" name="line_id" id="line_id" value="<?php echo $line_id?>" />
                                <span><b>* Select Report Type </b></span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="submit_btn" onclick="getDefectDetailReport();">SEARCH</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                    </div>

                    <br />
                    <button type="button" onclick="printDiv('print_div')" class="print_cl_btn" style="border-style: none; width: 80px; height: 30px; background-color: green; color: white; border-radius: 5px;">Print</button>
                    <button class="btn btn-primary" style="color: #FFF;" id="btnExport"><b>Export Excel</b></button>
                    <br />

                    <div id="print_div">
                    <div class="row">
                        <sec class="table-responsive">
                            <section class="panel default blue_title h2">

                                <div class="panel-body" id="table_content" style="overflow-x:auto;">

                                </div>
                            </section>
                        </sec>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel1"></h4>
            </div>

            <div class="modal-body">
                <div class="col-md-3 scroll4">
                    <div class="porlets-content">
                        <div class="table-responsive" id="wh_cl_list">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $('select').select2();

    $(function(){
        $('#btnExport').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#table_content').html())
            location.href=url
            return false
        })
    })

    window.addEventListener('keydown', function(event) {
        if (event.keyCode === 80 && (event.ctrlKey || event.metaKey) && !event.altKey && (!event.shiftKey || window.chrome || window.opera)) {
            event.preventDefault();
            if (event.stopImmediatePropagation) {
                event.stopImmediatePropagation();
            } else {
                event.stopPropagation();
            }
            return;
        }
    }, true);

    function getDefectDetailReport() {
        var report_type = $("#report_type").val();
        var date = $("#date").val();
        var line_id = $("#line_id").val();

        if(report_type != ''){

            if(report_type == 0){
                $("#loader").css("display", "block");

                $("#table_content").empty();

                $.ajax({
                    url: "<?php echo base_url();?>dashboard/piecesPassedWithoutAnyDefectReport/",
                    type: "POST",
                    data: {date: date, line_id: line_id},
                    dataType: "html",
                    success: function (data) {
                        $("#table_content").empty();
                        $("#table_content").append(data);
                        $("#loader").css("display", "none");
                    }
                });
            }

            if(report_type == 1){
                $("#loader").css("display", "block");

                $("#table_content").empty();

                $.ajax({
                    url: "<?php echo base_url();?>dashboard/sameDefectFoundForMultipleTimesPiecesReport/",
                    type: "POST",
                    data: {date: date, line_id: line_id},
                    dataType: "html",
                    success: function (data) {
                        $("#table_content").empty();
                        $("#table_content").append(data);
                        $("#loader").css("display", "none");
                    }
                });
            }

            if(report_type == 2){
                $("#loader").css("display", "block");

                $("#table_content").empty();

                $.ajax({
                    url: "<?php echo base_url();?>dashboard/sameDefectFoundForSingleTimesPiecesReport/",
                    type: "POST",
                    data: {date: date, line_id: line_id},
                    dataType: "html",
                    success: function (data) {
                        $("#table_content").empty();
                        $("#table_content").append(data);
                        $("#loader").css("display", "none");
                    }
                });
            }
        }else{
            alert("Please Select Required Fields!");
        }
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        location.reload();
    }
</script>
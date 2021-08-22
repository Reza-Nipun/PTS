<style>
    .loader {
        border: 20px solid #f3f3f3;
        border-radius: 50%;
        border-top: 20px solid #3498db;
        width: 20px;
        height: 20px;
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
        <h1>Mid Line QC</h1>
        <a class="btn btn-danger" href="<?php echo base_url()?>access/machineMaintenance">Machine Maintenance</a>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Mid Line QC</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <!--        <form action="--><?php //echo base_url();?><!--access/care_label_pass" method="post">-->
    <div class="row">
        <div class="col-md-12">
                <div class="panel-body">
                    <div class="porlets-content">
                        <h4><span id="p_er_msg" style="color: red; font-size: 30px; font-weight: 900;"></span></h4>
                        <h4><span id="p_s_msg" style="color: green; font-size: 30px; font-weight: 900;"></span></h4>
                        <h4><span id="er_msg" style="color: red; font-size: 30px; font-weight: 900;"></span></h4>
                        <h4><span id="s_msg" style="color: green; font-size: 30px; font-weight: 900;"></span></h4>
                        <div class="col-md-1">
<!--                            <div class="panel-heading" style="color: green;"> Pass<span class="semi-bold"></span> </div>-->

                            <input type="text" placeholder="Pass" class="form-control" name="carelabel_tracking_no" autofocus required id="carelabel_tracking_no" autocomplete="off" onkeyup="submitClQcInfo();" />
                            <span style="">Pass</span>
                            <button style="display: none;" id="submit_btn_save_pass" class="btn btn-success">Save</button>
                            <span style="margin-top: 30px;" id="refresh_report" class="btn btn-primary" onclick="getLineMidOutputReport();">Report</span>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="sub_line_id" id="sub_line_id"
                                <?php if(sizeof($sub_lines) == 0){ ?> style="display: none" <?php } ?>>

                                <option value="">Select Sub-Line</option>
                                <?php foreach ($sub_lines as $sub_line){ ?>
                                    <option value="<?php echo $sub_line['id']?>"><?php echo $sub_line['sub_line_name']?></option>
                                <?php } ?>

                            </select>
                            <input type="hidden" value="<?php echo sizeof($sub_lines);?>" id="shub_lines" readonly="readonly" />
                        </div>
                    </div>

                </div><!--/block-web-->
        </div><!--/col-md-12-->
    </div>
    <!--                    </form>-->
    <div class="row">
        <div class="col-md-12">
            <section class="panel default blue_title h2">
                <!--                <div class="panel-heading" style="color: green;"> Pass<span class="semi-bold"></span> </div>-->
                <div class="panel-body">

                    <div class="porlets-content">

                        <div class="col-md-12">
                            <div class="col-md-11 scroll" id="reload_div">
                                <?php
//                                $prod_summary = $this->method_call->getProductionSummaryReport();
                                ?>
                                <div class="block-web">

                                    <div class="porlets-content">

                                        <div class="table-responsive">
                                            <table class="display table table-bordered table-striped" id="">
                                                <thead>
                                                <tr>
                                                    <th class="hidden-phone" colspan="6"></th>
                                                    <th class="hidden-phone center" colspan="3">Sewing</th>
                                                </tr>
                                                <tr>
                                                    <th class="hidden-phone center">PO-ITEM</th>
                                                    <th class="hidden-phone center">Brand</th>
                                                    <th class="hidden-phone center">STL</th>
                                                    <th class="hidden-phone center">QL-CLR</th>
                                                    <th class="hidden-phone center">Order</th>
                                                    <th class="hidden-phone center">ExFac</th>
                                                    <th class="hidden-phone center"><span data-toggle="tooltip" title="Line Input">Input</span></th>
                                                    <th class="hidden-phone center"><span data-toggle="tooltip" title="Mid-Line Pass QTY">Mid QC</span></th>
                                                    <th class="hidden-phone center"><span data-toggle="tooltip" title="Balance QTY">Balance</span></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($prod_summary as $k => $v){
                                                    if (($v['count_input_qty_line'] - $v['count_end_line_qc_pass']) != 0) {
                                                        ?>
                                                        <tr>
                                                            <td class="hidden-phone center">
                                                                <?php echo $v['purchase_order'] . '-' . $v['item']; ?>
                                                            </td>
                                                            <td class="hidden-phone center"><?php echo $v['brand']; ?></td>
                                                            <td class="hidden-phone center"><?php echo $v['style_no'] . '-' . $v['style_name']; ?></td>
                                                            <td class="hidden-phone center"><?php echo $v['quality'] . '-' . $v['color']; ?></td>
                                                            <td class="hidden-phone center"><?php echo $v['total_order_qty']; ?></td>
                                                            <td class="hidden-phone center"><?php echo $v['ex_factory_date']; ?></td>
                                                            <td class="hidden-phone center" style="color: #ffffff; font-size: 20px; background-color: darkblue;"><?php echo $v['count_input_qty_line']; ?></td>
                                                            <td class="hidden-phone center" <?php if($v['count_mid_line_qc_pass'] > $v['count_end_line_qc_pass']){ ?>style="background-color: red;" <?php } ?> <?php if($v['count_mid_line_qc_pass'] == $v['count_end_line_qc_pass']){ ?>style="background-color: darkgreen;" <?php } ?>>
                                                                <span style="color: white; font-size: 20px;"><?php echo $v['count_mid_line_qc_pass']; ?></span>
                                                            </td>
                                                            <td class="hidden-phone center">
                                                                <?php echo $v['count_input_qty_line'] - $v['count_mid_line_qc_pass']; ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div><!--/table-responsive-->
                                    </div>

                                </div><!--/porlets-content-->
                            </div><!--/block-web-->
                        </div>
                    </div>

                </div><!--/block-web-->
            </section><!--/porlets-content-->
        </div><!--/col-md-12-->
    </div>
    </div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <div class="modal-body">
                <div class="col-md-3 scroll4">
                    <div class="porlets-content">
                        <div class="table-responsive" id="remain_cl_list">

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

        $(document).ready(function(){
//            setInterval(function(){
//                $("#reload_div").load('<?php //echo base_url();?>//access/getProductionSummaryReport');
//            }, 60000);
//            $("#reload_div").load('<?php //echo base_url();?>//access/getProductionSummaryReport');

            setInterval(function(){

                $.ajax({
                    url: "<?php echo base_url();?>access/checkSession/", //Change this URL as per your settings
                    type: "POST",
                    data: {},
                    dataType: "html",
                    success: function(newVal) {

                        var session_out_time = '<?php echo $session_out?>';

                        var inactive_time = newVal * 1;

                        console.log(inactive_time);

                        if (inactive_time > session_out_time){
                            window.location.assign('<?php echo base_url();?>access/logout');
                        }

                    }
                });


            }, 10000);

        });

        function getLineMidOutputReport() {
            $("#loader").css("display", "block");
//            $("#reload_div").load('<?php //echo base_url();?>//access/getProductionSummaryReport');

            $("#reload_div").empty();

//            setInterval(function(){
//                $("#loader").css("display", "none");
//            }, 15000);

            $.ajax({
                url: "<?php echo base_url();?>access/getProductionSummaryReport/",
                type: "POST",
                data: {},
                dataType: "html",
                success: function (data) {
                    $("#reload_div").append(data);
                    $("#loader").css("display", "none");
                }
            });

        }

        function submitClQcInfo(){
            var carelabel_tracking_no = $("#carelabel_tracking_no").val();

            var shub_lines = $("#shub_lines").val();
            var sub_line_id = $("#sub_line_id").val();
            sub_line_id = (sub_line_id != '' ? sub_line_id : 0);

            var code_length = carelabel_tracking_no.length;

            var last_variable = carelabel_tracking_no.slice(-1);

            if(shub_lines > 0){
                if((code_length == 10) && (carelabel_tracking_no != '') && (last_variable == '.')){
                    if(sub_line_id != ''){
                        $("#carelabel_tracking_no").attr('readonly', true);
                        $("#loader").css("display", "block");

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>access/careLabelMidPassSave/",
                            data: {cl_track_no_defect: carelabel_tracking_no, access_points_status: 1, sub_line_id: sub_line_id},
                            dataType: "html",
                            success: function (data) {

                                if(data != ''){
                                    $("#p_er_msg").empty();
                                    $("#er_msg").empty();
                                    $("#s_msg").empty();
                                    $("#p_s_msg").empty();

                                    if((data == 'Line mismatch found!') || (data == 'Previous process in WIP!') || (data == 'Already Defect Found!')){
                                        $("#p_er_msg").text(carelabel_tracking_no+' '+data);
//                                location.reload();
                                    }

                                    if((data == 'Already Passed!') || (data == 'Successfully Passed!')){
                                        $("#p_s_msg").text(carelabel_tracking_no+' '+data);
//                                location.reload();
                                    }

                                    if((data == 'Not Found')){
                                        $("#er_msg").text(carelabel_tracking_no+' '+data);
                                    }

                                    if((data == 'closed')){
                                        $("#er_msg").text(carelabel_tracking_no+' is Closed!');
                                    }

                                    if((data == 'Collar/Cuff is not Ready!')){
                                        $("#er_msg").text('Collar/Cuff is not Ready!');
                                    }

                                    $("#carelabel_tracking_no").val('');
                                    $("#carelabel_tracking_no").focus();
                                }

                                $("#loader").css("display", "none");
                                $("#carelabel_tracking_no").attr('readonly', false);
                            }
                        });
                    }else{
                        alert("Please Select Sub-Line!");

                        $("#carelabel_tracking_no").val('');
                        $("#carelabel_tracking_no").focus();
                    }
                }
            }else{
                if((code_length == 10) && (carelabel_tracking_no != '') && (last_variable == '.')){

                    $("#carelabel_tracking_no").attr('readonly', true);
                    $("#loader").css("display", "block");

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>access/careLabelMidPassSave/",
                        data: {cl_track_no_defect: carelabel_tracking_no, access_points_status: 1, sub_line_id: sub_line_id},
                        dataType: "html",
                        success: function (data) {

                            if(data != ''){
                                $("#p_er_msg").empty();
                                $("#er_msg").empty();
                                $("#s_msg").empty();
                                $("#p_s_msg").empty();

                                if((data == 'Line mismatch found!') || (data == 'Previous process in WIP!') || (data == 'Already Defect Found!')){
                                    $("#p_er_msg").text(carelabel_tracking_no+' '+data);
//                                location.reload();
                                }

                                if((data == 'Already Passed!') || (data == 'Successfully Passed!')){
                                    $("#p_s_msg").text(carelabel_tracking_no+' '+data);
//                                location.reload();
                                }

                                if((data == 'Not Found')){
                                    $("#er_msg").text(carelabel_tracking_no+' '+data);
                                }

                                if((data == 'closed')){
                                    $("#er_msg").text(carelabel_tracking_no+' is Closed!');
                                }

                                if((data == 'Collar/Cuff is not Ready!')){
                                    $("#er_msg").text('Collar/Cuff is not Ready!');
                                }

                                $("#carelabel_tracking_no").val('');
                                $("#carelabel_tracking_no").focus();
                            }

                            $("#loader").css("display", "none");
                            $("#carelabel_tracking_no").attr('readonly', false);
                        }
                    });

                }
            }

        }

        function getRemainingLinePcs(po_no, so_no, purchase_order, item, quality, color) {
            $("#remain_cl_list").empty();

            $.ajax({
                url: "<?php echo base_url();?>access/getRemainingLineMidQcPcs/",
                type: "POST",
                data: {po_no: po_no, so_no: so_no, purchase_order: purchase_order, item: item, quality: quality, color: color},
                dataType: "html",
                success: function (data) {
                    $("#remain_cl_list").append(data);
                }
            });
        }
    </script>
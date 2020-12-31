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
<!--\\\\\\\ contentpanel start\\\\\\-->
<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>PO LIST FOR PACKAGE READY</h1>
        <h2 class="">PO LIST FOR PACKAGE READY...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">DASHBOARD</a></li>
            <li class="active">PO LIST FOR PACKAGE READY</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <select required class="form-control" id="so_no" name="so_no" onchange="getReadyPackageByPo(id);">
                            <option value="">SO_PO_Item_Quality_Color_ExFacDate</option>
                            <?php

                            foreach ($purchase_order_nos as $pos){ ?>
                                <option value="<?php echo $pos['so_no'];?>"><?php echo $pos['so_no'].'_'.$pos['po_no'].'_'.$pos['purchase_order'].'_'.$pos['item'].'_'.$pos['quality'].'_'.$pos['color'].'_'.$pos['approved_ex_factory_date'];?></option>
                                <?php
                            }
                            //                            ?>
                        </select>
                        <span style="font-size: 11px;">* Select SO_PO_Item_Quality_Color_ExFacDate</span>
                    </div>
                </div>
                <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>

            </div>
        </div>
    </div>
    <br />

    <div class="row" id="report_content"></div>

</div>
<!--\\\\\\\ container  end \\\\\\-->



<script type="text/javascript">
    $('select').select2();

    //    setTimeout(function(){
    //        window.location.reload(1);
    //    }, 5000);

    function getReadyPackageByPo(id) {
        var so_no = $("#"+id).val();
        $("#loader").css("display", "block");
        $("#report_content").empty();

        $.ajax({
            url: "<?php echo base_url();?>dashboard/getReadyPackageByPo/",
            type: "POST",
            data: {so_no: so_no},
            dataType: "html",
            success: function (data) {
                $("#report_content").append(data);
                $("#loader").css("display", "none");
            }
        });

    }

    function getWarehousePcs(po_no, purchase_order,item, quality, color, size) {
        $("#wh_cl_list").empty();

        $.ajax({
            url: "<?php echo base_url();?>dashboard/getWarehouseSizePcs/",
            type: "POST",
            data: {po_no: po_no, purchase_order: purchase_order, item: item, quality: quality, color: color, size: size},
            dataType: "html",
            success: function (data) {
                $("#wh_cl_list").append(data);
            }
        });

    }
</script>
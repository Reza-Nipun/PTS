<style>
    .loader {
        border: 20px solid #f3f3f3;
        border-radius: 50%;
        border-top: 20px solid #3498db;
        width: 25px;
        height: 25px;
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
            <h1>Cut to Sew Input Report</h1>
            <h2 class="">Cut to Sew Input Report...</h2>
        </div>
        <div class="pull-right">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li class="active">Cut to Sew Input Report</li>
            </ol>
        </div>
    </div>
    <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                <div class="col-md-5">
                    <div class="form-group">
                        <select required class="form-control" id="so_no" name="so_no" onchange="getCutToSewInputReportBySo(id);">
                            <option value="">SO_PO_Item_Quality_Color_StyleNo_ExFacDate_Type</option>
                            <?php
                            foreach ($purchase_order_nos as $pos){

                                $po_type='';

                                if($pos['po_type']==0){
                                    $po_type='BULK';
                                }
                                if($pos['po_type']==1){
                                    $po_type='SizeSet';
                                }
                                if($pos['po_type']==2){
                                    $po_type='SAMPLE';
                                }
                                ?>
                                <option value="<?php echo $pos['so_no'];?>"><?php echo $pos['so_no'].'_'.$pos['purchase_order'].'_'.$pos['item'].'_'.$pos['quality'].'_'.$pos['color'].'_'.$pos['style_no'].'_'.$pos['approved_ex_factory_date'].'_'.$po_type;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p style="font-size: 11px; padding: 5px;">* SO_PO_Item_Quality_Color_StyleNo_ExFacDate_Type</p>
                    </div>
                </div>
                <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>

                </div>
            </div>
        </div>
        <br />
        <button type="button" onclick="printDiv('print_div')" class="print_cl_btn" style="border-style: none; width: 80px; height: 30px; background-color: green; color: white; border-radius: 5px;">Print</button>
        <button class="btn btn-primary" style="color: #FFF;" id="btnExport"><b>Export Excel</b></button>
        <br />
        <br />
        <div id="print_div">
            <div class="row" id="table_content">
                <sec class="table-responsive">
                    <section class="panel default blue_title h2">

                        <div class="panel-body" style="overflow-x:auto;">
                            <table class="display table table-bordered table-striped" id="" border="1">
                                <thead>
                                    <tr style="font-size: 16px; font-weight: 700;">
                                        <th class="hidden-phone center">SO</th>
                                        <th class="hidden-phone center">Purchase Order</th>
                                        <th class="hidden-phone center">Item</th>
                                        <th class="hidden-phone center">Style</th>
                                        <th class="hidden-phone center">Style Name</th>
                                        <th class="hidden-phone center">Quality</th>
                                        <th class="hidden-phone center">Color</th>
                                        <th class="hidden-phone center">Brand</th>
                                        <th class="hidden-phone center">ExFac</th>
                                        <th class="hidden-phone center">Input Man Ticket Scanning</th>
                                        <th class="hidden-phone center">Input Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="report_content">

                                </tbody>
                            </table>

                        </div>
                    </section>
                </sec>
            </div>
        </div>

    <!--\\\\\\\ container  end \\\\\\-->

<script type="text/javascript">
    $('select').select2();

//    setTimeout(function(){
//        window.location.reload(1);
//    }, 5000);

    $(function(){
        $('#btnExport').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#table_content').html())
            location.href=url
            return false
        })
    })

    function getCutToSewInputReportBySo(id) {
        var so_no = $("#"+id).val();

        $("#loader").css("display", "block");

        $("#report_content").empty();

        if(so_no != ''){
            $.ajax({
                url: "<?php echo base_url();?>dashboard/getCutToSewInputReportBySo/",
                type: "POST",
                data: {so_no: so_no},
                dataType: "html",
                success: function (data) {
                    console.log(data);
                    $("#report_content").append(data);
                    $("#loader").css("display", "none");
                }
            });
        }else{
            alert('Please Select SO!');
        }

    }

    function getPoItemWiseLineRemainCL(so_no, line_id) {
        $("#remain_cl_list").empty();

        $.ajax({
            url: "<?php echo base_url();?>dashboard/getPoItemWiseLineRemainCL/",
            type: "POST",
            data: {so_no: so_no, line_id: line_id},
            dataType: "html",
            success: function (data) {
                $("#remain_cl_list").append(data);
            }
        });
    }

    function getSizeWiseReport(sap_no, po, item, color) {
        var line_no = $("#line_no").val();

        $("#size_tbl").empty();

//        alert(sap_no+'-'+po+'-'+item+'-'+color+'-'+line_no);

        $.ajax({
            url: "<?php echo base_url();?>dashboard/getLinePoItemWiseSizeReport/",
            type: "POST",
            data: {po_no: sap_no, purchase_order: po, item: item, color: color, line_no: line_no},
            dataType: "html",
            success: function (data) {
                $("#size_tbl").append(data);
            }
        });
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
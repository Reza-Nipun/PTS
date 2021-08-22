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
        <h1>Sub-Line Mid QC</h1>
        <h2 class="">Sub-Line Mid QC PO Report...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">DASHBOARD</a></li>
            <li class="active">Sub-Line Mid QC PO Report</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <div class="col-md-12">
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="line" name="line" value="<?php echo $line_info[0]['line_name']?>" readonly="readonly">
                    <input type="hidden" class="form-control" id="line_id" name="line_id" value="<?php echo $line_info[0]['id']?>" readonly="readonly">
                    <span style="font-size: 11px;">* Line</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select required class="form-control" id="sub_line_id" name="sub_line_id">
                        <option value="">Select Sub-Line...</option>
                        <?php
                        foreach ($sub_lines as $sub_line){ ?>
                            <option value="<?php echo $sub_line['id'];?>"><?php echo $sub_line['sub_line_name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span style="font-size: 11px;">* Select Sub-Line</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control form-control-inline input-medium default-date-picker" id="search_date" placeholder="Select Date" name="search_date" />
                    <span style="font-size: 11px;">* Select Date</span>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary" onclick="runningPoSublineReportFilter()">Search</button>
            </div>
            <div class="col-md-1" id="loader" style="display: none;">
                <div class="loader"></div>
            </div>
        </div>
    </div>

</div>
<div class="col-md-12" id="tableWrap">
    <section class="panel default blue_title h2">

        <div class="panel-body">

            <?php

            foreach ($sub_lines as $vl){

                $sub_line_po_report = $this->method_call->getSubLinePoReport($vl['id'], $vl['line_id']);

            ?>

            <table class="table" border="1">
                <thead>
                    <tr>
                        <th class="center" colspan="8">
                            <span style="font-size: 20px;">
                                <?php echo $vl['sub_line_name']?>
                            </span>
                        </th>
                    </tr>
                    <tr>
                        <th class="center">PO-Item</th>
                        <th class="center">SO</th>
                        <th class="center">BRAND</th>
                        <th class="center">QLTY-CLR</th>
                        <th class="center">STL</th>
                        <th class="center">PO TYPE</th>
                        <th class="center">ExFac</th>
                        <th class="center">
                            Mid Pass QTY
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $total_mid_pass = 0;

                foreach ($sub_line_po_report as $v){

                ?>

                <tr>
                    <td class="center">
                        <?php echo $v['purchase_order'] . '-' . $v['item']; ?>
                    </td>
                    <td class="center"><?php echo $v['so_no']; ?></td>
                    <td class="center"><?php echo $v['brand']; ?></td>
                    <td class="center"><?php echo $v['quality'] . '-' . $v['color']; ?></td>
                    <td class="center"><?php echo $v['style_no'] . '-' . $v['style_name']; ?></td>
                    <td class="center">
                        <?php
                        if($v['po_type'] == 0){
                            echo 'BULK';
                        }
                        if($v['po_type'] == 1){
                            echo 'SIZE SET';
                        }
                        if($v['po_type'] == 2){
                            echo 'SAMPLE';
                        }

                        ?>
                    </td>
                    <td class="center"><?php echo $v['ex_factory_date']; ?></td>
                    <td class="center"><?php echo $v['mid_qc_sub_line_qty']; ?></td>
                </tr>
                <?php
                    $total_mid_pass += $v['mid_qc_sub_line_qty'];
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td align="right" colspan="7">Total</td>
                    <td class="center"><?php echo $total_mid_pass;?></td>
                </tr>
                </tfoot>
            </table>

            <?php
            }
            ?>


        </div>
    </section>
</div>

<script type="text/javascript">
    $('select').select2();

    function runningPoSublineReportFilter() {
        var line_id = $("#line_id").val();
        var sub_line_id = $("#sub_line_id").val();
        var search_dt = $("#search_date").val();

        var res1 = search_dt.split("-");
        var search_date = res1[2]+'-'+res1[0]+'-'+res1[1];

        $("#tableWrap").empty();
        $("#loader").css("display", "block");

        $.ajax({
            url: "<?php echo base_url();?>dashboard/runningPoSublineReportFilter/",
            type: "POST",
            data: {line_id: line_id, sub_line_id: sub_line_id, search_date: search_date},
            dataType: "html",
            success: function (data) {
                $("#tableWrap").append(data);
                $("#loader").css("display", "none");
            }
        });
    }
</script>
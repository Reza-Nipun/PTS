<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1800">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--Canvas Chart Asset Start-->
    <script src="<?php echo base_url(); ?>assets/js/canvas_chart/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/canvas_chart/canvasjs.min.js"></script>
    <!--Canvas Chart Asset End-->


</head>
<!--<body class="light_theme  fixed_header left_nav_fixed">-->
<body>

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
<div class="row" style="background-color: #34b077; color: white;">
    <div class="col-md-10">

        <div style="font-weight: 900; font-size: 50px; text-align: center; margin-left: 230px">
            <?php
                echo $line_info[0]['line_name'].' MID QC';
            ?>
        </div>

    </div>
    <div class="col-md-2">
        <center style="font-weight: 900; font-size: 35px;" id="ct"></center>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="">

            <div class="panel-body">

                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th class="center">PO-Item</th>
                            <th class="center">QLTY-CLR</th>
                            <th class="center">STYLE</th>
                            <th class="center">PO TYPE</th>
                            <th class="center">ExFac</th>

                            <?php foreach ($po_sizes as $s) { ?>
                                <th class="center">
                                    <?php echo $s['size']?>
                                </th>
                            <?php } ?>

                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($running_pos as $v){

                    ?>

                    <tr>
                        <td class="center">
                            <?php echo $v['purchase_order'] . '-' . $v['item']; ?>
                        </td>
                        <td class="center"><?php echo $v['quality'] . '-' . $v['color']; ?></td>
                        <td class="center"><?php echo $v['style_name']; ?></td>
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

                        <?php
                            foreach ($po_sizes as $s) {

                            $mid_qc_po_size_qty = $this->method_call->getMidQcPoSizeQty($line_id, $v['so_no'], $s['size']);

                        ?>
                            <td class="center"
                                <?php if($mid_qc_po_size_qty[0]['line_size_qty'] > 0 && $mid_qc_po_size_qty[0]['line_size_qty'] > $mid_qc_po_size_qty[0]['mid_qc_pass_size_qty']){ ?>
                                    style="background-color: #ff9599"
                                <?php } ?>
                            >
                                <?php echo $mid_qc_po_size_qty[0]['mid_qc_pass_size_qty'];?>
                            </td>
                        <?php
                            }
                        ?>

                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>

</html>
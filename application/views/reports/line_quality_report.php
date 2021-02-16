<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title ?></title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <script src="<?php echo base_url(); ?>assets/js/jquery-latest.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/css/jquery-1.9.0.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
    <link href="<?php echo base_url(); ?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet" />

    <!--Select2 Start-->
    <script src="<?php echo base_url(); ?>assets/select2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/select2/select2.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/select2/select2.min.css" rel="stylesheet"/>

    <style type="text/css">

        .has-error .select2-selection {
            /*border: 1px solid #a94442;
            border-radius: 4px;*/
            border-color:rgb(185, 74, 72) !important;
        }

        div.scroll {
            /*background-color: #00FFFF;*/
            width: 1900px;
            height: 500px;
            overflow: scroll;
        }

        div.scroll2 {
            /*background-color: #00FFFF;*/
            width: 1200px;
            height: 500px;
            overflow: scroll;
        }

        div.scroll3 {
            /*background-color: #00FFFF;*/
            width: 700px;
            height: 500px;
            overflow: scroll;
        }

        /*table thead fixed*/
        .table-fixed thead {
            width: 100%;
        }
        .table-fixed tbody {
            height: 230px;
            overflow-y: auto;
            width: 100%;
        }
        .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
            display: block;
        }
        .table-fixed tbody td, .table-fixed thead > tr> th {
            float: left;
            border-bottom-width: 0;
        }
        /*table thead fixed*/

        .well1 {
            background: none;
            height: 400px;
        }

        .well {
            background: none;
            height: 600px;
        }

        .table-scroll tbody {
            position: absolute;
            overflow-y: scroll;
            height: 450px;
        }

        .table-scroll tr {
            width: 100%;
            table-layout: fixed;
            display: inline-table;
        }

        .table-scroll thead > tr > th {
            /*border: none;*/
        }

        /* Loader Style Start */

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

        /* Loader Style End */
    </style>
    <!--Select2 End-->

</head>
<body class="light_theme green_thm left_nav_hide">
<div class="wrapper">
    <div class="inner">
        <div class="contentpanel">
            <div class="pull-left breadcrumb_admin clear_both">
                <div class="pull-left page_title theme_color">
                    <!--          <h1>Dashboard</h1>-->
                    <!--          <h2 class="">Dashboard...</h2>-->
                    Line Quality Report
                </div>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="active">Line Quality Report</li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="text-right">
                            Select Date:
                        </h4>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date_from" id="date_from"/>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="date_to" id="date_to"/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" onclick="getDateRangeQualityReport();">SEARCH</button>
                    </div>
                    <div class="col-md-1" id="loader" style="display: none;">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>

<br />
<table id="" border="1" width="100%" style="border: 1px solid black;">
        <thead>
            <tr style="background-color: #f7ffb0;">
                <th align="center" style="font-size: 16px; font-weight: 900;">DATE</th>
                <th align="center" style="font-size: 16px; font-weight: 900;">LINE</th>
                <th align="center" style="font-size: 16px; font-weight: 900;">DHU</th>

            <?php foreach ($defect_types AS $d){ ?>
                <th align="center" style="font-size: 16px; font-weight: 900;"><?php echo $d['defect_name']?></th>
            <?php } ?>
                <th align="center" style="font-size: 16px; font-weight: 900;">Total</th>
            </tr>
        </thead>
        <tbody id="table_content">

        <?php

        foreach ($lines AS $k => $line){

            $total_defects = 0;
        ?>
        <tr>
            <td align="center"><?php echo $date; ?></td>
            <td align="center"><?php echo $line['line_code']; ?></td>
            <td align="center">
                <?php
//                echo round($line['sum_of_dhu']/$hour, 2);
                ?>
                <a href="<?php echo base_url();?>dashboard/lineQualityDetailReport/<?php echo $line['id'];?>/<?php echo $date;?>" target="_blank"><?php echo $line['dhu']; ?></a>
            </td>

            <?php
                foreach ($defect_types AS $d){

                    $defect_count_res = $this->method_call->getDefectCount($line['id'], $d['defect_code'], $date);

                    $count_defect = ($defect_count_res[0]['count_defect'] != '' ? $defect_count_res[0]['count_defect'] : 0);

                    $total_defects += $count_defect;

            ?>
                <td align="center"><?php echo $count_defect;?></td>
            <?php } ?>
            <td align="center">
                <?php echo $total_defects; ?>
            </td>

        </tr>

        <?php

        }

        ?>

        </tbody>

</table>
</div>
</div>
</div>

<!-- The Modal -->

</body>
</html>

<script type="text/javascript">

    function getDateRangeQualityReport() {
        var from_date = $("#date_from").val();
        var to_date = $("#date_to").val();


        if(from_date != '' & to_date != '' && to_date >= from_date){
            $("#loader").css("display", "block");
            $("#table_content").empty();

            $.ajax({
                url: "<?php echo base_url();?>dashboard/getDateRangeQualityReport/",
                type: "POST",
                data: {from_date: from_date, to_date: to_date},
                dataType: "html",
                success: function (data) {
                    $("#table_content").append(data);
                    $("#loader").css("display", "none");
                }
            });
        }else{
            alert('Invalid Date Range!');
        }


    }

</script>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common-script.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jPushMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/side-chats.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/form-components.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/data-tables/dynamic_table_init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/edit-table/edit-table.js"></script>
<?php

$psl_array = array();
$operation_array = array();
$mc_array = array();

foreach($operation_list AS $p){

    array_push($psl_array, $p['psl']);
    array_push($operation_array, $p['operation_title']);
    array_push($mc_array, $p['machine']);

}

$psl_list = array_unique($psl_array);
$operations = array_unique($operation_array);
$machines = array_unique($mc_array);

?>

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
        <h1>Employee Skills</h1>
        <h2 class="">Employee Skills...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Employee Skills</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div style="padding-top:10px">
                    <h6 style="color:red">
                        <?php
                        $exc = $this->session->userdata('exception');
                        if (isset($exc)) {
                            echo $exc;
                            $this->session->unset_userdata('exception');
                        }
                        ?>
                    </h6>

                    <h6 style="color:green">
                        <?php
                        $msg = $this->session->userdata('message');
                        if (isset($msg)) {
                            echo $msg;
                            $this->session->unset_userdata('message');
                        }
                        ?>
                    </h6>
                </div>
                <div class="porlets-content">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <select class="form-control" name="employee_code" id="employee_code">
                                    <option value="">Select Employee</option>
                                    <?php foreach($employee_list AS $emp){ ?>
                                        <option value="<?php echo $emp['employee_code'];?>"><?php echo $emp['employee_code'].'-'.$emp['employee_name'];?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Employee Code - Employee Name </b></span>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="psl" id="psl">
                                    <option value="">PSL_Operation_Description</option>
                                    <?php foreach($operation_list AS $psl){ ?>
                                        <option value="<?php echo $psl['psl'];?>"><?php echo $psl['psl'].'_'.$psl['operation_title'].'_'.$psl['operation_description'];?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> PSL - Operation - Description </b></span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" value="" size="16" class="form-control form-control-inline input-medium default-date-picker" id="update_date" readonly="readonly">
                                <span><b> Updated Older Than Date </b></span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <button class="btn btn-primary" id="submit_btn" onclick="getEmployeeSkills();">SEARCH</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>

                        </div>
                    </div>

                    <br />
                    <button class="btn btn-info" style="color: #FFF;" id="btnExport" onclick="ExportToExcel('table_id')"><i class="fa fa-cloud-download"></i> <b>Export Excel</b></button>
                    <a class="btn btn-success" href="<?php echo base_url();?>access/uploadEmployeeSkills" id="upload"><i class="fa fa-cloud-upload"></i> Upload Employee Skills</a>
                    <br />
                    <br />

                    <div id="print_div">
                    <div class="row">

                        <div id="table_content">
                            <div class="table-responsive col-md-12" id="tableWrap">
                                <table class="table table-bordered table-striped" id="table_id" border="1">
                                    <thead>
                                        <tr>
                                            <th class="hidden-phone center">SL</th>
                                            <th class="hidden-phone center">EMPLOYEE CODE</th>
                                            <th class="hidden-phone center">NAME</th>
                                            <th class="hidden-phone center">DESIGNATION</th>
                                            <th class="hidden-phone center">GRADE</th>
                                            <th class="hidden-phone center">DOJ</th>
                                            <th class="hidden-phone center">FLOOR</th>
                                            <th class="hidden-phone center">PSL</th>
                                            <th class="hidden-phone center">MAIN Process?</th>
                                            <th class="hidden-phone center">Process Name</th>
                                            <th class="hidden-phone center">Process Description</th>
                                            <th class="hidden-phone center">Difficulty</th>
                                            <th class="hidden-phone center">MC</th>
                                            <th class="hidden-phone center">SAM</th>
                                            <th class="hidden-phone center">Standard Capacity</th>
                                            <th class="hidden-phone center">Process Grade</th>
                                            <th class="hidden-phone center">Ob Capacity wt 10% Allow</th>
                                            <th class="hidden-phone center">Performance (%)</th>
                                            <th class="hidden-phone center">Update Date</th>
                                            <th class="hidden-phone center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_id">
                                    <?php
                                    $sl=1;

                                    foreach($employee_skill_list as $v){ ?>
                                        <tr>
                                            <td class="hidden-phone center"><?php echo $sl; $sl++;?></td>
                                            <td class="hidden-phone center"><?php echo $v['employee_code'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['employee_name'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['designation'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['grade'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['doj'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['floor'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['psl'];?></td>
                                            <td class="hidden-phone center"><?php echo ($v['is_mail_psl'] == 1 ? 'Yes' : 'No');?></td>
                                            <td class="hidden-phone center"><?php echo $v['operation_title'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['operation_description'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['process_difficulty'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['machine'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['sam'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['standard_capacity'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['category'];?></td>
                                            <td class="hidden-phone center"><?php echo $v['capacity'];?></td>
                                            <td class="hidden-phone center"><?php echo round($v['capacity']/$v['standard_capacity'], 2) * 100;?></td>
                                            <td class="hidden-phone center"><?php echo $v['update_date'];?></td>
                                            <td class="hidden-phone center">
                                                <table>
                                                    <tr>
                                                        <td><a href="<?php echo base_url();?>access/editEmployeeSkill/<?php echo $v['emp_skill_id'];?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
                                                        <td><a href="<?php echo base_url();?>access/deleteEmployeeSkill/<?php echo $v['emp_skill_id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-times"></i></a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $('select').select2();

    function ExportToExcel(tableid) {
        var tab_text = "<table border='2px'><tr>";
        var textRange; var j = 0;
        tab = document.getElementById(tableid);//.getElementsByTagName('table'); // id of table
        if (tab==null) {
            return false;
        }
        if (tab.rows.length == 0) {
            return false;
        }

        for (j = 0 ; j < tab.rows.length ; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "download.xls");
        }
        else                 //other browser not tested on IE 11
        //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            try {
                var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);
                a = document.createElement("a");
                if (document.getElementById("caption")!=null) {
                    a.download=document.getElementById("caption").innerText;
                }
                else
                {
                    a.download = 'download';
                }

                a.href = link;

                document.body.appendChild(a);

                a.click();

                document.body.removeChild(a);
            } catch (e) {
            }


        return false;
        //return (sa);
    }

    function getEmployeeSkills() {
        var employee_code = $("#employee_code").val();
        var psl = $("#psl").val();

        var update_dt = $("#update_date").val();
        var update_split_dt = update_dt.split('-');

        var update_date = update_split_dt[2]+'-'+update_split_dt[0]+'-'+update_split_dt[1];

        $("#tbody_id").empty();
        $("#loader").css('display', 'block');

        $.ajax({
            url: "<?php echo base_url();?>access/getEmployeeSkills/",
            type: "POST",
            data: {employee_code: employee_code, psl: psl, update_date: update_date},
            dataType: "html",
            success: function (data) {

                $("#tbody_id").append(data);
                $("#loader").css('display', 'none');

            }
        });
    }

</script>
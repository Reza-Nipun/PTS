<?php

$emp_array = array();
$dept_array = array();
$section_array = array();
$line_array = array();
$floor_array = array();

foreach($employee_list AS $e){

    array_push($emp_array, $e['employee_code']);
    array_push($dept_array, $e['department']);
    array_push($section_array, $e['section']);
    array_push($line_array, $e['line']);
    array_push($floor_array, $e['floor']);

}

$emp_list = array_unique($emp_array);
$dept_list = array_unique($dept_array);
$section_list = array_unique($section_array);
$line_list = array_unique($line_array);
$floor_list = array_unique($floor_array);

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
        <h1>Employee List</h1>
        <h2 class="">Employee List...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Employee List</li>
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
                                    <option value="">Employee Code</option>
                                    <?php foreach($emp_list AS $emp_code){ ?>
                                        <option value="<?php echo $emp_code;?>"><?php echo $emp_code;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Employee Code </b></span>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="department" id="department">
                                    <option value="">Select Department</option>
                                    <?php foreach($dept_list AS $dept){ ?>
                                        <option value="<?php echo $dept;?>"><?php echo $dept;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Department </b></span>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" name="section" id="section">
                                    <option value="">Section</option>
                                    <?php foreach($section_list AS $sec){ ?>
                                        <option value="<?php echo $sec;?>"><?php echo $sec;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Section </b></span>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" name="line" id="line">
                                    <option value="">Line</option>
                                    <?php foreach($line_list AS $line){ ?>
                                        <option value="<?php echo $line;?>"><?php echo $line;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Line </b></span>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" name="floor" id="floor">
                                    <option value="">Floor</option>
                                    <?php foreach($floor_list AS $floor){ ?>
                                        <option value="<?php echo $floor;?>"><?php echo $floor;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Floor </b></span>
                            </div>
                            <div class="col-md-2">
                                <div class="input-append date dpMonths" data-date="102/2012" data-date-format="yyyy-mm" data-date-viewmode="years" data-date-minviewmode="months">
                                    <input type="text" class="form-control" size="" id="doj_month" name="doj_month" value="" readonly="">
                                    <span class="input-group-btn add-on">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <span><b> DOJ Month </b></span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <button class="btn btn-primary" id="submit_btn" onclick="getEmployeeList();">SEARCH</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>

                        </div>
                    </div>

                    <br />
                    <button class="btn btn-info" style="color: #FFF;" id="btnExport" onclick="ExportToExcel('table_id')"><i class="fa fa-cloud-download"></i> <b>Export Excel</b></button>
                    <a class="btn btn-success" href="<?php echo base_url();?>access/uploadEmployeeList" id="upload"><i class="fa fa-cloud-upload"></i> Upload Employee</a>
                    <br />
                    <br />

                    <div id="print_div">
                    <div class="row">

                        <div id="table_content">
                            <div class="col-md-12" id="tableWrap">
                                <table class="table table-bordered table-striped" id="table_id" border="1">
                                    <thead>
                                        <tr>
                                            <th class="hidden-phone center">SL</th>
                                            <th class="hidden-phone center">EMPLOYEE CODE</th>
                                            <th class="hidden-phone center">EMPLOYEE NAME</th>
                                            <th class="hidden-phone center">DEPARTMENT</th>
                                            <th class="hidden-phone center">DESIGNATION</th>
                                            <th class="hidden-phone center">GRADE</th>
                                            <th class="hidden-phone center">UNIT</th>
                                            <th class="hidden-phone center">SECTION</th>
                                            <th class="hidden-phone center">LINE</th>
                                            <th class="hidden-phone center">FLOOR</th>
                                            <th class="hidden-phone center">DOJ</th>
                                            <th class="hidden-phone center">GENDER</th>
                                            <th class="hidden-phone center">STAFF CATEGORY</th>
                                            <th class="hidden-phone center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_id">
                                    <?php
                                    $sl=1;
                                    foreach($employee_list AS $emp){ ?>
                                        <tr>
                                            <td class="hidden-phone center"><?php echo $sl; $sl++;?></td>
                                            <td class="hidden-phone center"><?php echo $emp['employee_code'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['employee_name'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['department'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['designation'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['grade'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['unit'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['section'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['line'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['floor'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['doj'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['gender'];?></td>
                                            <td class="hidden-phone center"><?php echo $emp['staff_category'];?></td>
                                            <td class="hidden-phone center">
                                                <table>
                                                    <tr>
<!--                                                        <td><a href="--><?php //echo base_url();?><!--access/editEmployee/--><?php //echo $emp['id'];?><!--" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>-->
                                                        <td><a href="<?php echo base_url();?>access/deleteEmployee/<?php echo $emp['employee_code'];?>" class="btn btn-danger" onclick="return confirm('Skill Matrix will be removed as well. Are you sure to delete?')"><i class="fa fa-times"></i></a></td>
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

    function getEmployeeList() {
        var employee_code = $("#employee_code").val();
        var department = $("#department").val();
        var section = $("#section").val();
        var line = $("#line").val();
        var floor = $("#floor").val();
        var doj_month = $("#doj_month").val();

        $("#tbody_id").empty();
        $("#loader").css('display', 'block');

        $.ajax({
            url: "<?php echo base_url();?>access/getEmployeeList/",
            type: "POST",
            data: {employee_code: employee_code, department: department, section: section, line: line, floor: floor, doj_month: doj_month},
            dataType: "html",
            success: function (data) {

                $("#tbody_id").append(data);
                $("#loader").css('display', 'none');

            }
        });
    }

</script>
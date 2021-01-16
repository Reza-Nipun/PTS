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
        <h1>Process List</h1>
        <h2 class="">Process List...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Process List</li>
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
                                <select class="form-control" name="psl" id="psl">
                                    <option value="">Select PSL</option>
                                    <?php foreach($psl_list AS $psl){ ?>
                                        <option value="<?php echo $psl;?>"><?php echo $psl;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Select PSL </b></span>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="operation" id="operation">
                                    <option value="">Select Operation</option>
                                    <?php foreach($operations AS $opr){ ?>
                                        <option value="<?php echo $opr;?>"><?php echo $opr;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Select Operation </b></span>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="machine" id="machine">
                                    <option value="">Select Machine</option>
                                    <?php foreach($machines AS $m){ ?>
                                        <option value="<?php echo $m;?>"><?php echo $m;?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> Select Machine </b></span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="submit_btn" onclick="getOperation();">SEARCH</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                    </div>

                    <br />
                    <button class="btn btn-info" style="color: #FFF;" id="btnExport" onclick="ExportToExcel('table_id')"><i class="fa fa-cloud-download"></i> <b>Export Excel</b></button>
                    <a class="btn btn-success" href="<?php echo base_url();?>access/uploadOperation" id="upload"><i class="fa fa-cloud-upload"></i> Upload Operation</a>
                    <br />
                    <br />

                    <div id="print_div">
                    <div class="row">

                        <div id="table_content">
                            <div class="col-md-12" id="tableWrap">
                                <table class="table table-bordered table-striped" id="table_id" border="1">
                                    <thead>
                                        <tr>
                                            <th class="hidden-phone center">PSL</th>
                                            <th class="hidden-phone center">OPERATION TITLE</th>
                                            <th class="hidden-phone center">DESCRIPTION</th>
                                            <th class="hidden-phone center">CATEGORY</th>
                                            <th class="hidden-phone center">DIFFICULTY</th>
                                            <th class="hidden-phone center">MACHINE</th>
                                            <th class="hidden-phone center">ST/CM</th>
                                            <th class="hidden-phone center">SAM</th>
                                            <th class="hidden-phone center">STANDARD CAPACITY</th>
                                            <th class="hidden-phone center">PROCESS POINT</th>
                                            <th class="hidden-phone center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_id">
                                    <?php foreach($operation_list AS $opr){ ?>
                                        <tr>
                                            <td class="hidden-phone center"><?php echo $opr['psl'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['operation_title'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['operation_description'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['category'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['process_difficulty'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['machine'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['st_cm'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['sam'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['standard_capacity'];?></td>
                                            <td class="hidden-phone center"><?php echo $opr['process_point'];?></td>
                                            <td class="hidden-phone center">
                                                <table>
                                                    <tr>
                                                        <td><a href="<?php echo base_url();?>access/editOperation/<?php echo $opr['id'];?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
                                                        <td><a href="<?php echo base_url();?>access/deleteOperation/<?php echo $opr['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-times"></i></a></td>
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

    function getOperation() {
        var psl = $("#psl").val();
        var operation = $("#operation").val();
        var machine = $("#machine").val();

        $("#tbody_id").empty();
        $("#loader").css('display', 'block');

        $.ajax({
            url: "<?php echo base_url();?>access/getOperation/",
            type: "POST",
            data: {psl: psl, operation: operation, machine: machine},
            dataType: "html",
            success: function (data) {

                $("#tbody_id").append(data);
                $("#loader").css('display', 'none');

            }
        });
    }

</script>
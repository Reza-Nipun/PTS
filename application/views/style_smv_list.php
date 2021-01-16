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
        <h1>Style SMV List</h1>
        <h2 class="">Style SMV List...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Style SMV List</li>
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
                                <select class="form-control" name="style" id="style">
                                    <option value="">Select Style</option>
                                    <?php foreach($style_smv_list AS $stl){ ?>
                                    <option value="<?php echo $stl['id'];?>"><?php echo $stl['style_no'].'_'.$stl['style_name']?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <span><b> StyleNo_StyleName </b></span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="submit_btn" onclick="getStyleSmv();">SEARCH</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                    </div>

                    <br />
                    <button class="btn btn-info" style="color: #FFF;" id="btnExport" onclick="ExportToExcel('table_id')"><i class="fa fa-cloud-download"></i> <b>Export Excel</b></button>
                    <a class="btn btn-success" href="<?php echo base_url();?>access/uploadStyleSmv" id="upload"><i class="fa fa-cloud-upload"></i> Upload Style SMV</a>
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
                                            <th class="hidden-phone center">STYLE NO</th>
                                            <th class="hidden-phone center">STYLE NAME</th>
                                            <th class="hidden-phone center">BRAND</th>
                                            <th class="hidden-phone center">SMV</th>
                                            <th class="hidden-phone center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_id">
                                    <?php
                                    $sl=1;
                                    foreach($style_smv_list AS $st){ ?>
                                        <tr>
                                            <td class="hidden-phone center"><?php echo $sl; $sl++;?></td>
                                            <td class="hidden-phone center"><?php echo $st['style_no'];?></td>
                                            <td class="hidden-phone center"><?php echo $st['style_name'];?></td>
                                            <td class="hidden-phone center"><?php echo $st['brand'];?></td>
                                            <td class="hidden-phone center"><?php echo $st['smv'];?></td>
                                            <td class="hidden-phone center">
                                                <table>
                                                    <tr>
                                                        <td><a href="<?php echo base_url();?>access/editStyleSmv/<?php echo $st['id'];?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
                                                        <td><a href="<?php echo base_url();?>access/deleteStyleSmv/<?php echo $st['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-times"></i></a></td>
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

    function getStyleSmv() {
        var style = $("#style").val();

        $("#tbody_id").empty();
        $("#loader").css('display', 'block');

        $.ajax({
            url: "<?php echo base_url();?>access/getStyleSmv/",
            type: "POST",
            data: {style: style},
            dataType: "html",
            success: function (data) {

                $("#tbody_id").append(data);
                $("#loader").css('display', 'none');

            }
        });
    }

</script>
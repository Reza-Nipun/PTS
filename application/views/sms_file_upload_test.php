<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>PO File Upload</h1>
        <h2 class="">PO File Upload...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">PO File Upload</li>
        </ol>
    </div>
</div>

<form action="<?php echo base_url();?>access/smsFileUploadTest" method="post" enctype="multipart/form-data">
    <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <h4 style="color:red">
                        <?php
                        $exc = $this->session->userdata('exception');
                        if (isset($exc)) {
                            echo $exc;
                            $this->session->unset_userdata('exception');
                        }
                        ?>
                    </h4>

                    <h4 style="color:green">
                        <?php
                        $msg = $this->session->userdata('message');
                        if (isset($msg)) {
                            echo $msg;
                            $this->session->unset_userdata('message');
                        }
                        ?>
                    </h4>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h4 align="right">Select File:</h4>
                        </div>
                    </div>




                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="form-control" type="file" name="file" id="file" />
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <select required type="text" class="form-control" id="po_type" name="po_type">
                                <option value="">Select PO Type...</option>

                                <option value="0">Bulk</option>
                                <option value="1">Size Set</option>
                                <option value="2">Sample</option>


                            </select>
                            <span style="font-size: 11px;">* PO Type.</span>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <a href="<?php echo base_url();?>uploads/manual_upload/file_format_pts.csv" class="btn btn-warning">File Format</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="btn btn-primary" style="color: #FFF;" id="btnExport" onclick="ExportToExcel('table_id')"><b>Export Excel</b></span>
        <span class="btn btn-danger" style="color: #FFF;" onclick="deleteSO();"><b>DELETE SO</b></span>
        <span class="btn btn-info"><b>Last SO: <?php echo $last_so_no;?></b></span>
        <span class="btn btn-default"><b>Last Upload Date: <?php echo $upload_date;?></b></span>

        <div class="row">
            <div class="col-md-12" id="tableWrap">
                <section class="panel default blue_title h2">

                    <div class="panel-body">

                        <table class="table" border="1" id="table_id">
                            <thead>
                            <tr>
                                <th class="center">
                                    <input type="checkbox" class="select_all" id="checkAll" name="select_all" />
                                </th>
                                <th class="center">SO</th>
                                <th class="center">PO</th>
                                <th class="center">Brand</th>
                                <th class="center">Purchase Order</th>
                                <th class="center">Item</th>
                                <th class="center">Quality</th>
                                <th class="center">Color</th>
                                <th class="center">Style</th>
                                <th class="center">Style Name</th>
                                <th class="center">Ex-Fac-Date</th>
                                <th class="center">Order Qty</th>
                                <th class="center">Po Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($today_upload AS $v){ ?>
                            <tr>
                                <td class="center">
                                    <input class="checkItem" type="checkbox" name="checkItem[]" id="checkItem" value="<?php echo $v['so_no']; ?>" />
                                </td>
                                <td class="center"><?php echo $v['so_no'];?></td>
                                <td class="center"><?php echo $v['po_no'];?></td>
                                <td class="center"><?php echo $v['brand'];?></td>
                                <td class="center"><?php echo $v['purchase_order'];?></td>
                                <td class="center"><?php echo $v['item'];?></td>
                                <td class="center"><?php echo $v['quality'];?></td>
                                <td class="center"><?php echo $v['color'];?></td>
                                <td class="center"><?php echo $v['style_no'];?></td>
                                <td class="center"><?php echo $v['style_name'];?></td>
                                <td class="center"><?php echo $v['ex_factory_date'];?></td>
                                <td class="center"><?php echo $v['total_order_qty'];?></td>
                                <td class="center"><?php if($v['po_type'] ==0){echo 'BULK';}
                                             if($v['po_type'] ==1){echo 'Size Set';}
                                             if($v['po_type'] ==2){echo 'Sample';}
                                    ;?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </section>
            </div>
        </div>

    </div>
</form>


<script type="text/javascript">
    $('select').select2();

    $(document).ready(function(){
        $("#message").empty();
    });

//    $(function(){
//        $('#btnExport').click(function(){
//            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#tableWrap').html())
//            location.href=url
//            return false
//        })
//    })

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

    $(document).on('click','#checkAll',function () {
        $('.checkItem').not(this).prop('checked', this.checked);
    });

    function deleteSO() {
        if (confirm("Are you sure to delete?")) {
            var so_nos = [];

            $('input.checkItem:checkbox:checked').each(function () {
                var sThisVal = $(this).val();

                so_nos.push(sThisVal);
            });

            if(so_nos.length > 0){

                $.ajax({
                    url:"<?php echo base_url('access/deleteSOs')?>",
                    type:"post",
                    dataType:'html',
                    data:{so_nos: so_nos},
                    success:function (data) {

                        if(data == 'done'){
                            window.location.reload();
                        }

                    }
                });

            }else{
                alert('Please Select SO!');
            }
        }
    }

    //    function getPoItemDetail() {
    //        $("#report_content").empty();
    //
    //        var po_no_all = $("#po_no").val();
    //
    //        var res = po_no_all.split("_");
    //
    //        var sap_po = res[0];
    //        var purchase_order = res[1];
    //        var item = res[2];
    //        var quality = res[3];
    //        var color = res[4];
    //
    //        $.ajax({
    //            url: "<?php //echo base_url();?>//access/getPoItemDetail/",
    //            type: "POST",
    //            data: {sap_no: sap_po, purchase_order: purchase_order, item: item, quality: quality, color: color},
    //            dataType: "html",
    //            success: function (data) {
    //                $("#report_content").append(data);
    //            }
    //        });
    //    }
</script>
<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Fabric In-house Report</h1>
        <h2 class="">Fabric In-house Report...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Fabric In-house Report</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">

    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div class="row">

                    <div class="col-md-2">
                        <select class="form-control" name="fabric_code" id="fabric_code">
                            <option value="">Select Fabric Code</option>
                            <?php foreach($fabric_codes as $f){ ?>
                                    <option value="<?php echo $f['id'];?>"><?php echo $f['fabric_code']?></option>
                            <?php
                                }
                            ?>
                        </select>

                        <span><b> Fabric Code </b></span>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" id="from_date" autocomplete="off" placeholder="From Date" name="from_date" />

                            <span><b> From In-house Date </b></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" id="to_date" autocomplete="off" placeholder="To Date" name="to_date" />

                            <span><b> To In-house Date </b></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <span class="btn btn-success" onclick="getFabricInhouseFilterReport()">SEARCH</span>
                    </div>
                    <div class="col-md-1">
                        <div id="loader" style="display: none;"><div class="loader"></div></div>
                    </div>
                </div>
                <br />
                <div class="porlets-content">
                    <div style="padding-top:10px">
                        <h4 style="color:red">
                            <?php
                            $exc = $this->session->userdata('exception');
                            if (isset($exc)) {
                                echo $exc;
                                $this->session->unset_userdata('exception');
                            } ?>
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
                    </div>
                    <div class="table-responsive">
                        <table class="display table table-bordered table-striped" id="">
                            <thead>
                                <tr>
                                    <th class="center hidden-phone">Fabric Code</th>
                                    <th class="center hidden-phone">In-house Date</th>
                                    <th class="center hidden-phone">Update Date</th>
                                    <th class="center hidden-phone">Length (m)</th>
                                    <th class="center hidden-phone">Remarks</th>
                                    <th class="center hidden-phone">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_id">
                            <?php

                            foreach($fabric_inhouse AS $fb){ ?>
                                <tr>
                                    <td class="center hidden-phone"><?php echo $fb['fabric_code'];?></td>
                                    <td class="center hidden-phone"><?php echo $fb['inhouse_date'];?></td>
                                    <td class="center hidden-phone"><?php echo $fb['update_date'];?></td>
                                    <td class="center hidden-phone"><?php echo $fb['inhouse_length'];?></td>
                                    <td class="center hidden-phone"><?php echo $fb['remarks'];?></td>
                                    <td class="center hidden-phone">
                                        <a href="<?php echo base_url()?>access/editFabricInhouse/<?php echo $fb['id'];?>" class="btn btn-warning" title="Edit"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div><!--/table-responsive-->
                </div>

            </div><!--/porlets-content-->
        </div><!--/block-web-->
    </div><!--/col-md-12-->
</div>

<script type="text/javascript">
    $('select').select2();

    $(document).on('click','#checkAll',function () {
        $('.checkItem').not(this).prop('checked', this.checked);
    });

    function printQRCodes() {
        var defect_codes = [];

        $('input.checkItem:checkbox:checked').each(function () {
            var sThisVal = $(this).val();

            defect_codes.push(sThisVal);
        });

        if(defect_codes.length > 0){

            window.open("<?php echo base_url();?>access/printDefectQRCodes/"+defect_codes, "_blank");
//            window.open("<?php //echo site_url('access/printQRCodes');?>///"+user_codes, "_blank");

        }else{
            alert('Nothing selected to print!');
        }
    }
    
    function getFabricInhouseFilterReport() {
        var fabric_code = $("#fabric_code").val();
        var from_dt = $("#from_date").val();
        var to_dt = $("#to_date").val();

        var res1 = from_dt.split("-");
        var from_date = res1[2]+'-'+res1[0]+'-'+res1[1];

        var res2 = to_dt.split("-");
        var to_date = res2[2]+'-'+res2[0]+'-'+res2[1];

        $("#tbody_id").empty();


        if(from_date <= to_date) {
            $.ajax({
                url: "<?php echo base_url('access/getFabricInhouseFilterReport')?>",
                type: "post",
                dataType: 'html',
                data: {fabric_id: fabric_code, from_date: from_date, to_date: to_date},
                success: function (data) {

                    $("#tbody_id").append(data);

                }
            });
        }else{
            alert("Invalid Date Range!");
        }
    }
</script>
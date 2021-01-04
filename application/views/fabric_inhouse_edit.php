<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Fabric Inhouse Edit</h1>
        <h2 class="">Fabric Inhouse Edit...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Fabric Inhouse Edit</li>
        </ol>
    </div>
</div>

<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <form action="<?php echo base_url();?>access/updateFabricInhouse" method="POST">
        <div class="row">
            <div class="col-md-12">
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
            </div><!--/block-web-->
        </div><!--/col-md-12-->
<!--        <div class="row">-->

        <div class="row">
            <div class="form-group">

                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="fabric_code" name="fabric_code" min="0" required="required" readonly="readonly" autocomplete="off" value="<?php echo $fabric_inhouse[0]['fabric_code'];?>" />
                        <input type="hidden" id="fabric_inhouse_id" name="fabric_inhouse_id" min="0" required="required" readonly="readonly" autocomplete="off" value="<?php echo $fabric_inhouse[0]['id'];?>" />
                        <input type="hidden" id="fabric_inhouse_date" name="fabric_inhouse_date" min="0" required="required" readonly="readonly" autocomplete="off" value="<?php echo $fabric_inhouse[0]['inhouse_date'];?>" />
                        <p style="font-size: 11px;">* Fabric Code</p>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="inhouse_length" name="inhouse_length" min="0" required="required" autocomplete="off" value="<?php echo $fabric_inhouse[0]['inhouse_length'];?>" onblur="checkLengthValidity();" />
                        <p style="font-size: 11px;">* Fabric Length (m)</p>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="remarks" name="remarks" autocomplete="off" value="<?php echo $fabric_inhouse[0]['remarks'];?>" />
                        <p style="font-size: 11px;"> Remarks</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <button class="btn btn-success">SAVE</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

<script type="text/javascript">
    $('select').select2();

    function checkFabricCodeAvailability() {

        var fabric_code=$("#fabric_code").val();

        if(fabric_code != ''){

            $.ajax({
                url:"<?php echo base_url('access/checkFabricCodeAvailability')?>",
                type:"post",
                dataType:'html',
                data:{fabric_code: fabric_code},
                success:function (data) {

                    if(data == 'available'){
                        alert('FABRIC CODE is already available!');
                        location.reload();
                    }

                }
            });

        }else{
            alert('DEFECT CODE cannot be blank!');
            location.reload();
        }

    }
    
    function checkLengthValidity() {
        var inhouse_length = parseFloat($("#inhouse_length").val());

        if(isNaN(inhouse_length) == false){
            inhouse_length = (inhouse_length < 0 ? location.reload() : inhouse_length);
        }else{
            location.reload();
        }

        $("#inhouse_length").val(inhouse_length);

    }

</script>
<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Hours</h1>
        <h2 class="">Hours...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Hours</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <div class="form-group">
                    <select class="form-control" id="floor_id" name="floor_id">
                        <option value="">Select Floor</option>

                        <?php foreach ($floors AS $f){ ?>
                            <option value="<?php echo $f['id'];?>"><?php echo $f['floor_name'];?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <span class="btn btn-primary" onclick="getFilteredFloorWiseHoursToEdit();">SEARCH</span>
                </div>
            </div>
        </div>
    </div>
    <form action="<?php echo base_url();?>access/updateHourInfo" method="POST">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">

                <div class="porlets-content">

                    <div class="table-responsive">
                        <table class="display table table-bordered table-striped" id="edit_floor_hours">
                            <thead>
                                <tr>
                                    <th class="center hidden-phone"><h5>FLOOR</h5></th>
                                    <th class="center hidden-phone"><h5>HOUR</h5></th>
                                    <th class="center hidden-phone"><h5>START TIME</h5></th>
                                    <th class="center hidden-phone"><h5>END TIME</h5></th>
                                    <th class="center hidden-phone"><h5>BREAK TIME ENDS</h5></th>
                                    <th class="center hidden-phone"><h5>BREAK TIME MINUTE</h5></th>
<!--                                    <th class="center hidden-phone">ACTION</th>-->
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($hours AS $h){ ?>
                                <tr>
                                    <td class="center hidden-phone"><?php echo $h['floor_name'];?></td>
                                    <td class="center hidden-phone"><?php echo $h['hour'];?></td>
                                    <td class="center hidden-phone"><?php echo $h['start_time'];?></td>
                                    <td class="center hidden-phone"><?php echo $h['end_time'];?></td>
                                    <td class="center hidden-phone"><?php echo $h['break_time_ends'];?></td>
                                    <td class="center hidden-phone"><?php echo $h['break_time_in_minute'];?></td>
<!--                                    <td class="center hidden-phone">-->
<!--                                        <a href="--><?php //echo base_url()?><!--access/editHourInfo/--><?php //echo $h['id'];?><!--" class="btn btn-warning" title="EDIT"><i class="fa fa-pencil"></i></a>-->
<!--                                    </td>-->
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div><!--/table-responsive-->
                    <button class="btn btn-success" disabled="disabled" style="display: none;" id="submit_btn">SAVE</button>

                </div>
            </div><!--/porlets-content-->
        </div><!--/block-web-->
    </div><!--/col-md-12-->
    </form>
</div>

<script type="text/javascript">
    $('select').select2();

    $(document).on('click','#checkAll',function () {
        $('.checkItem').not(this).prop('checked', this.checked);
    });

    function printQRCodes() {
        var user_codes = [];

        $('input.checkItem:checkbox:checked').each(function () {
            var sThisVal = $(this).val();

            user_codes.push(sThisVal);
        });

        if(user_codes.length > 0){

            window.open("<?php echo base_url();?>access/printQRCodes/"+user_codes, "_blank");
//            window.open("<?php //echo site_url('access/printQRCodes');?>///"+user_codes, "_blank");

        }else{
            alert('Nothing selected to print!');
        }
    }
    
    function getFilteredFloorWiseHoursToEdit() {
        var floor_id = $("#floor_id").val();

        if(floor_id != ''){
            $("#edit_floor_hours").empty();

            $.ajax({
                url:"<?php echo base_url('access/getFilteredFloorWiseHoursToEdit')?>",
                type:"post",
                dataType:'html',
                data:{floor_id: floor_id},
                success:function (data) {

                    $("#edit_floor_hours").append(data);

                    $("#submit_btn").attr('disabled', false);
                    $("#submit_btn").css('display', 'block');

                }
            });
        }else{
            alert("No Floor is Selected!");
        }
    }
</script>
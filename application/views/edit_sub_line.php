<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Edit Sub-Line</h1>
        <h2 class="">Edit Sub-Line...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li><a href="<?php echo base_url();?>access/subLines/<?php echo $line_info[0]['id']?>">Sub-Lines</a></li>
            <li class="active">Edit Sub-Line</li>
        </ol>
    </div>
</div>

<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <form action="<?php echo base_url();?>access/updateSubLineInfo" method="POST">
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

                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="form-control" type="text" name="line_name" id="line_name" value="<?php echo $line_info[0]['line_name']?>" readonly="readonly" required="required" />
                            <input class="form-control" type="hidden" name="line_id" id="line_id" value="<?php echo $line_info[0]['id']?>" readonly="readonly" required="required" />
                            <input class="form-control" type="hidden" name="sub_line_id" id="sub_line_id" value="<?php echo $sub_line_info[0]['id']?>" readonly="readonly" required="required" />
                            <span style="font-size: 11px;">* Line Name</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input required="required" class="form-control" type="text" name="sub_line_name" id="sub_line_name" autocomplete="off" value="<?php echo $sub_line_info[0]['sub_line_name']?>" />
                            <span style="font-size: 11px;">* Sub-Line Name</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <select  required="required" class="form-control" id="status" name="status">
                                <option value="">Select Status...</option>
                                <option value="1" <?php echo ($sub_line_info[0]['status'] == 1 ? 'selected="selected"' : ''); ?>>Active</option>
                                <option value="0" <?php echo ($sub_line_info[0]['status'] == 0 ? 'selected="selected"' : ''); ?>>Inactive</option>
                            </select>
                            <span style="font-size: 11px;">* Status</span>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-success">SAVE</button>
                    </div>
                </div>
            </div>

    </form>

</div>

<script type="text/javascript">
    $('select').select2();
</script>
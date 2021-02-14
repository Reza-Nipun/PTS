<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Size List</h1>
        <h2 class="">Size List...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Size List</li>
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
                    <select class="form-control" id="size" name="size" onchange="getFilteredSizeList();">
                        <option value="">Select Size</option>

                        <?php foreach ($sizes AS $s){ ?>
                            <option value="<?php echo $s['sl'];?>"><?php echo $s['size'];?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>

        </div>
    </div>

    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">

                <div class="col-md-1">
                    <span class="btn btn-success" title="ADD SIZE" onclick="addNewSize();"> <i class="fa fa-plus"></i> SIZE</span>
                </div>
                <div class="col-md-1">
                    <span class="btn btn-danger" title="DELETE SIZE" onclick="deleteSize();"> <i class="fa fa-archive"></i> DELETE</span>
                </div>
                <br />
                <br />
                <br />
                <div class="porlets-content">

                    <div class="table-responsive">
                        <table class="display table table-bordered table-striped" id="">
                            <thead>
                                <tr>
                                    <th class="center hidden-phone">
                                        <input type="checkbox" class="select_all" id="checkAll" name="select_all" />
                                    </th>
                                    <th class="center hidden-phone">SIZE</th>
                                    <th class="center hidden-phone">SERIAL</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_id">
                            <?php
                            $sl=1;
                            foreach($sizes AS $v){ ?>
                                <tr>
                                    <td class="center hidden-phone">
                                        <input class="checkItem" type="checkbox" name="checkItem[]" id="checkItem" value="<?php echo $v['sl']; ?>" />
                                    </td>
                                    <td class="center hidden-phone"><?php echo $v['size'];?></td>
                                    <td class="center hidden-phone"><?php echo $v['serial'];?></td>
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

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel1">New Size</h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <div class="porlets-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">Size <span style="color: red;"></span></div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="new_size" id="new_size" onblur="isSizeExists()">
                                </div>
                                <div class="col-md-2">
                                    <span class="btn btn-success" onclick="saveNewSize()">SAVE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $('select').select2();

    $(document).on('click','#checkAll',function () {
        $('.checkItem').not(this).prop('checked', this.checked);
    });

    function getFilteredSizeList() {
        var size = $("#size").val();

        $("#tbody_id").empty();

        $.ajax({
            url:"<?php echo base_url('access/getFilteredSizeList')?>",
            type:"post",
            dataType:'html',
            data:{size: size},
            success:function (data) {

                $("#tbody_id").append(data);

            }
        });
    }

    function addNewSize() {

        $('#myModal3').modal('show');

    }

    function isSizeExists() {
        var new_size = $("#new_size").val();

        if(new_size != ''){
            $.ajax({
                url: "<?php echo base_url();?>access/isSizeExists/",
                type: "POST",
                data: {size: new_size},
                dataType: "html",
                success: function (data) {

                    if(data == 'yes'){
                        $("#new_size").css('border-color', 'red');
                        $("#new_size").val('');
                    }else{
                        $("#new_size").css('border-color', '');
                    }

                }
            });
        }
    }

    function saveNewSize() {
        var new_size = $("#new_size").val();

        if(new_size != ''){

            $.ajax({
                url: "<?php echo base_url();?>access/saveNewSize/",
                type: "POST",
                data: {size: new_size},
                dataType: "html",
                success: function (data) {

                    if(data == 'done'){
                        location.reload();
                    }

                    if(data == 'failed'){
                        alert('New Size is failed to save');
                        $("#new_size").css('border-color', 'red');
                        $("#new_size").val('');
                    }

                }
            });

        }else{
            if(new_size == ''){
                $("#new_size").css('border-color', 'red');
            }
        }
    }
    
    function deleteSize() {
        var sizes = [];

        $('input.checkItem:checkbox:checked').each(function () {
            var sThisVal = $(this).val();

            sizes.push(sThisVal);
        });

        if(sizes.length > 0){

            var c = confirm('Are you sure to delete the selected sizes?');

            if(c == true){
                $.ajax({
                    url: "<?php echo base_url();?>access/deleteSize/",
                    type: "POST",
                    data: {sizes: sizes},
                    dataType: "html",
                    success: function (data) {

                        if(data == 'done'){
                            location.reload();
                        }

                    }
                });
            }

        }else{
            alert('No size is selected to delete!');
        }
    }
    
</script>
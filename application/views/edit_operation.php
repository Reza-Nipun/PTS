<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Edit Operation</h1>
          <h2 class="">Edit Operation...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>access/operationList">Operation List</a></li>
              <li class="active">Edit Operation</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/updateOperation" method="POST">
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
                      <label class="col-md-2"><b>PSL</b> <span style="color: red;">*</span></label>
                      <div class="col-md-2">
                          <input type="text" class="form-control" name="psl" id="psl" required="required" value="<?php echo $operation_info[0]['psl'];?>" autocomplete="off" />
                          <input type="hidden" class="form-control" name="operation_id" id="operation_id" required="required" value="<?php echo $operation_info[0]['id'];?>" autocomplete="off" />
                      </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                      <label class="col-md-2"><b>OPERATION TITLE</b> <span style="color: red;">*</span></label>
                      <div class="col-md-2">
                          <input type="text" class="form-control" name="operation_title" id="operation_title" required="required" value="<?php echo $operation_info[0]['operation_title'];?>" autocomplete="off" />
                      </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>DESCRIPTION</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="operation_description" id="operation_description" required="required" value="<?php echo $operation_info[0]['operation_description'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                      <label class="col-md-2"><b>CATEGORY</b> <span style="color: red;">*</span></label>
                      <div class="col-md-2">
                          <input type="text" class="form-control" name="category" id="category" required="required" value="<?php echo $operation_info[0]['category'];?>" autocomplete="off" />
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>DIFFICULTY</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="process_difficulty" id="process_difficulty" required="required" value="<?php echo $operation_info[0]['process_difficulty'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>MACHINE</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="machine" id="machine" required="required" value="<?php echo $operation_info[0]['machine'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>ST/CM</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="st_cm" id="st_cm" required="required" value="<?php echo $operation_info[0]['st_cm'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>SAM</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="sam" id="sam" required="required" value="<?php echo $operation_info[0]['sam'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>STANDARD CAPACITY</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="standard_capacity" id="standard_capacity" required="required" value="<?php echo $operation_info[0]['standard_capacity'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>PROCESS POINT</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="process_point" id="process_point" required="required" value="<?php echo $operation_info[0]['process_point'];?>" autocomplete="off" />
                        </div>
                    </div>
                </div>

            <br />

         
        <div class="row">
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <button class="btn btn-primary" id="submit_btn">UPDATE</button>
                </div>
            </div>
        </div><br />
        </form>
        </section>
        </div>
            
        </div>
        
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    
    <script type="text/javascript">
        $('select').select2();

        function getSoInfo() {
            var sales_order = $("#sales_order").val();

            $("#po").empty();
            $("#item").empty();
            $("#quality").empty();
            $("#color").empty();
            $("#style_no").empty();
            $("#style_name").empty();
            $("#smv").empty();

            if(sales_order != ''){
                $.ajax({
                    url: "<?php echo base_url();?>access/getSoInfo/",
                    type: "POST",
                    data: {sales_order: sales_order},
                    dataType: "json",
                    success: function (data) {
                        $("#po").val(data[0].purchase_order);
                        $("#item").val(data[0].item);
                        $("#quality").val(data[0].quality);
                        $("#color").val(data[0].color);
                        $("#style_no").val(data[0].style_no);
                        $("#style_name").val(data[0].style_name);
                        $("#smv").val(data[0].smv);
                    }
                });
            }
        }
    </script>
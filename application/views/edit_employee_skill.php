<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Edit Employee Skill</h1>
          <h2 class="">Edit Employee Skill...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>access/employeeSkills">Employee Skills</a></li>
              <li class="active">Edit Employee Skill</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/updateEmployeeSkill" method="POST">
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
                          <input type="text" class="form-control" name="psl" id="psl" required="required" value="<?php echo $emp_skill_info[0]['psl'];?>" autocomplete="off" />
                          <input type="hidden" class="form-control" name="pre_psl" id="pre_psl" required="required" value="<?php echo $emp_skill_info[0]['psl'];?>" autocomplete="off" />
                          <input type="hidden" class="form-control" name="emp_skill_id" id="emp_skill_id" required="required" value="<?php echo $emp_skill_info[0]['id'];?>" autocomplete="off" />
                      </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                      <label class="col-md-2"><b>EMPLOYEE CODE</b> <span style="color: red;">*</span></label>
                      <div class="col-md-2">
                          <input type="text" class="form-control" name="employee_code" id="employee_code" required="required" readonly="readonly" value="<?php echo $emp_skill_info[0]['employee_code'];?>" autocomplete="off" />
                      </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>MAIN SKILL?</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <select class="form-control" name="is_mail_psl" id="is_mail_psl" required="required">
                                <option value="">Is Main Skill?</option>
                                <option value="1" <?php echo ($emp_skill_info[0]['is_mail_psl'] == 1 ? "selected='selected'" : '');?>>Yes</option>
                                <option value="0" <?php echo ($emp_skill_info[0]['is_mail_psl'] == 0 ? "selected='selected'" : '');?>>No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                      <label class="col-md-2"><b>CAPACITY</b> <span style="color: red;">*</span></label>
                      <div class="col-md-2">
                          <input type="text" class="form-control" name="capacity" id="capacity" required="required" value="<?php echo $emp_skill_info[0]['capacity'];?>" autocomplete="off" />
                      </div>
                    </div>
                </div>


         
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
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
          <h1>Upload Employee</h1>
          <h2 class="">Upload Employee...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>access/employeeList">Employee List</a></li>
              <li>Upload Employee</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <form action="<?php echo base_url();?>access/uploadingEmployeeList" method="post" enctype="multipart/form-data">
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
            <div class="row">
                <div class="col-md-4">
                    <div class="panel-body">
                        <input type="file" name="employee_file" class="form-control" required="required" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel-body">
                        <button class="btn btn-primary btn-icon glyphicons envelope" onclick="loaderClick()"><i></i> Upload </button>
                    </div>
                </div>
                <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <div class="panel-body">
                        <a class="btn btn-warning" href="<?php echo base_url();?>uploads/skill_matrix/employee_list.csv" id="upload"><i class="fa fa-file"></i> File Format</a>
                    </div>
                </div>
            </div>
        </form>
        </section>
        </div>
        </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>

<script type="text/javascript">
    function loaderClick() {
        $("#loader").css('display', 'block');
    }
</script>
<table class="display table table-bordered table-striped" id="" border="1">
    <thead>
    <tr>
        <th class="hidden-phone center">SL</th>
        <th class="hidden-phone center">Line</th>
        <th class="hidden-phone center">Piece No</th>
        <th class="hidden-phone center">Defect Code</th>
        <th class="hidden-phone center">Defect Name</th>
        <th class="hidden-phone center">Count</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($defect_report as $k => $d){ ?>

        <tr>
            <td class="hidden-phone center"><?php echo $k+1;?></td>
            <td class="hidden-phone center"><?php echo $d['line_code'];?></td>
            <td class="hidden-phone center"><?php echo $d['pc_tracking_no'];?></td>
            <td class="hidden-phone center"><?php echo $d['defect_code'];?></td>
            <td class="hidden-phone center"><?php echo $d['defect_name'];?></td>
            <td class="hidden-phone center" data-toggle="modal" data-target="#exampleModal2" onclick="showPieceDefectScanningTimes('<?php echo $d['pc_tracking_no'];?>', '<?php echo $d['defect_code'];?>', '<?php echo $d['defect_name'];?>', '<?php echo $d['line_id'];?>', '<?php echo $d['defect_date'];?>')">
                <?php echo $d['count'];?>
            </td>
        </tr>

    <?php } ?>

    </tbody>
</table>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="defect_name"></span> - Scanning Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Piece No</th>
                            <th class="text-center">Scanning Time</th>
                        </tr>
                    </thead>
                    <tbody id="defect_time_tbody">
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function showPieceDefectScanningTimes(pc_tracking_no, defect_code, defect_name, line_id, date) {

        $("#defect_name").empty();
        $("#defect_time_tbody").empty();

        $.ajax({
            url: "<?php echo base_url();?>dashboard/getPieceDefectScanningDateTime/",
            type: "POST",
            data: {date: date, line_id: line_id, pc_tracking_no: pc_tracking_no, defect_code: defect_code},
            dataType: "html",
            success: function (data) {
                $("#defect_name").append(defect_name);

                $("#defect_time_tbody").append(data);

                $('#exampleModal2').modal('show');
                $("#loader").css("display", "none");
            }
        });

    }

</script>
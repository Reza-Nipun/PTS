<table class="display table table-bordered table-striped" id="" border="1">
    <thead>
    <tr>
        <th class="hidden-phone center"><input type="checkbox" id="checkAll"/></th>
        <th class="hidden-phone center">Piece No</th>
        <th class="hidden-phone center">Size</th>
        <th class="hidden-phone center">Last Scan</th>
        <th class="hidden-phone center">SO</th>
        <th class="hidden-phone center">Type</th>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">Purchase Order</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">Style</th>
        <th class="hidden-phone center">Style Name</th>
        <th class="hidden-phone center">Quality</th>
        <th class="hidden-phone center">Color</th>
        <th class="hidden-phone center">ExFac</th>
        <th class="hidden-phone center">Cutting Package Ready?</th>
        <th class="hidden-phone center">Sent to Sew</th>
        <th class="hidden-phone center">Line</th>
        <th class="hidden-phone center">Line Input</th>
        <th class="hidden-phone center">Mid Pass</th>
        <th class="hidden-phone center">Line Output</th>
        <th class="hidden-phone center">Wash Sent</th>
        <th class="hidden-phone center">Wash Received</th>
        <th class="hidden-phone center">Poly</th>
        <th class="hidden-phone center">Carton</th>
        <th class="hidden-phone center">Close By Admin</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($pieces as $p){ ?>
        <tr>
            <td class="center">
                <input class="checkItem" type="checkbox" name="checkItem[]" id="checkItem" value="<?php echo $p['pc_tracking_no']?>">
                <!--                                                    <a href="--><?php //echo base_url();?><!--access/deletePieceNo/--><?php //echo $p['pc_tracking_no'];?><!--" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">X</a>-->
            </td>
            <td class="center"><?php echo $p['pc_tracking_no'];?></td>
            <td class="center"><?php echo $p['size'];?></td>
            <td class="center">
                <?php

                $last_scanning_point = "";

                if($p['warehouse_qa_type'] == 1){
                    $last_scanning_point = "Buyer Warehouse";
                } elseif($p['warehouse_qa_type'] == 2){
                    $last_scanning_point = "Factory Warehouse";
                } elseif($p['warehouse_qa_type'] == 3){
                    $last_scanning_point = "Trash";
                } elseif($p['warehouse_qa_type'] == 4){
                    $last_scanning_point = "Production Sample Warehouse";
                } elseif($p['warehouse_qa_type'] == 5){
                    $last_scanning_point = "Other Purpose";
                } elseif($p['warehouse_qa_type'] == 6){
                    $last_scanning_point = "Lost";
                } elseif($p['warehouse_qa_type'] == 7){
                    $last_scanning_point = "Size Set";
                } elseif($p['carton_status'] == 1){
                    $last_scanning_point = "Carton";
                } elseif($p['packing_status'] == 1){
                    $last_scanning_point = "Packing";
                } elseif($p['washing_status'] == 1){
                    $last_scanning_point = "Wash Return";
                } elseif($p['is_going_wash'] == 1){
                    $last_scanning_point = "Wash Send";
                } elseif(($p['access_points'] == 4) && ($p['access_points_status'] == 4)){
                    $last_scanning_point = "End Line";
                } elseif(($p['access_points'] == 4) && ($p['access_points_status'] == 2)){
                    $last_scanning_point = "Mid Line & End-Line Defect";
                } elseif($p['access_points'] == 3){
                    $last_scanning_point = "Mid Line";
                } elseif($p['access_points'] == 2){
                    $last_scanning_point = "Input Line";
                } elseif($p['sent_to_production'] == 1){
                    $last_scanning_point = "Cutting";
                } elseif($p['sent_to_production'] == 0){
                    $last_scanning_point = "Cutting not Sent";
                }

                echo $last_scanning_point;
                ?>
            </td>
            <td class="center"><?php echo $p['so_no'];?></td>
            <td class="center">
                <?php
                if($p['po_type'] == 0){
                    echo 'BULK';
                }
                if($p['po_type'] == 1){
                    echo 'SIZE SET';
                }
                if($p['po_type'] == 2){
                    echo 'SAMPLE';
                }
                ?>
            </td>
            <td class="center"><?php echo $p['brand'];?></td>
            <td class="center"><?php echo $p['purchase_order'];?></td>
            <td class="center"><?php echo $p['item'];?></td>
            <td class="center"><?php echo $p['style_no'];?></td>
            <td class="center"><?php echo $p['style_name'];?></td>
            <td class="center"><?php echo $p['quality'];?></td>
            <td class="center"><?php echo $p['color'];?></td>
            <td class="center"><?php echo $p['ex_factory_date'];?></td>
            <td class="center"><?php echo ($p['is_package_ready'] == 1 ? 'YES' : 'NO');?></td>
            <td class="center"><?php echo $p['package_sent_to_production_date_time'];?></td>
            <td class="center"><?php echo $p['line_code'];?></td>
            <td class="center"><?php echo $p['line_input_date_time'];?></td>
            <td class="center"><?php echo $p['mid_line_qc_date_time'];?></td>
            <td class="center"><?php echo $p['end_line_qc_date_time'];?></td>
            <td class="center"><?php echo $p['going_wash_scan_date_time'];?></td>
            <td class="center"><?php echo $p['washing_date_time'];?></td>
            <td class="center"><?php echo $p['packing_date_time'];?></td>
            <td class="center"><?php echo $p['carton_date_time'];?></td>
            <td class="center">
                <?php
                if($p['manually_closed'] == 1){
                    echo 'Yes';
                }
                ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
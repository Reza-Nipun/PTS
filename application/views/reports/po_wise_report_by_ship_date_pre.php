<div class="col-md-12" id="tableWrap" style="overflow-x:auto;">
<table class="table table-bordered table-striped" id="" border="1">
    <thead>
    <tr>
        <th class="hidden-phone center" colspan="20"><h3>Ship Date: <?php echo $ex_factory_date;?></h3></th>
    </tr>
    <tr>
        <th class="hidden-phone center">SO</th>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">PO</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">Line</th>
        <th class="hidden-phone center">Style</th>
        <th class="hidden-phone center">Quality</th>
        <th class="hidden-phone center">Color</th>
        <th class="hidden-phone center">Order</th>
        <th class="hidden-phone center">Cut</th>
        <th class="hidden-phone center">Cut Pass</th>
        <th class="hidden-phone center">Sew</th>

        <th class="hidden-phone center" title="Sew Balance">Sew BLNC</th>
        <th class="hidden-phone center" title="Wash Return">Washed</th>
        <th class="hidden-phone center">Packed</th>
        <th class="hidden-phone center">Pack BLNC</th>
        <th class="hidden-phone center">Carton</th>
        <th class="hidden-phone center" title="Warehouse">WH</th>
<!--        <th class="hidden-phone center">Other</th>-->
        <th class="hidden-phone center" title="Balance">BLNC</th>
        <!--        <th class="hidden-phone center">Ex-Fac Date</th>-->
        <th class="hidden-phone center">Closing Date</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sew_balance_qty = 0;
    $balance_qty = 0;
    $packing_balance_qty = 0;

    $total_order_qty = 0;
    $total_cut_qty = 0;
    $total_cut_pass_qty = 0;
    $total_line_output_qty = 0;
    $total_line_output_balance_qty = 0;
    $total_washed_qty = 0;
    $total_packing_qty = 0;
    $total_packing_balance_qty = 0;
    $total_carton_qty = 0;
    $total_wh_qty = 0;
    $total_other_qty = 0;
    $total_balance_qty = 0;

    foreach ($po_close_report as $v){
        $sew_balance_qty = $v['total_cut_pass_qty'] - $v['total_end_pass_qty'];
        $balance_qty = $v['total_cut_qty'] - ($v['total_carton_qty'] + $v['count_wh_qty'] + $v['count_other_qty']);
        $packing_balance_qty = $v['total_cut_qty'] - $v['total_packing_qty'];

        $total_order_qty += $v['order_quantity'];
        $total_cut_qty += $v['total_cut_qty'];
        $total_cut_pass_qty += $v['total_cut_pass_qty'];
        $total_line_output_qty += $v['total_end_pass_qty'];
        $total_line_output_balance_qty += ($v['total_cut_pass_qty'] - $v['total_end_pass_qty']);
        $total_washed_qty += $v['total_wash_qty'];
        $total_packing_qty += $v['total_packing_qty'];
        $total_packing_balance_qty += $packing_balance_qty;
        $total_carton_qty += $v['total_carton_qty'];
        $total_wh_qty += $v['count_wh_qty'];
        $total_other_qty += $v['count_other_qty'];
        $total_balance_qty += $balance_qty;

        ?>
        <tr>
            <td class="center"><?php echo $v['so_no'];?></td>
            <td class="center"><?php echo $v['brand'];?></td>
            <td class="center"><?php echo $v['purchase_order'];?></td>
            <td class="center"><?php echo $v['item'];?></td>
            <td class="center"><?php echo $v['responsible_line'];?></td>
            <td class="center"><?php echo $v['style_no'].'-'.$v['style_name'];?></td>
            <td class="center"><?php echo $v['quality'];?></td>
            <td class="center"><?php echo $v['color'];?></td>
            <td class="center"><?php echo $v['order_quantity'];?></td>
            <td class="center"><?php echo $v['total_cut_qty'];?></td>
            <td class="center"><?php echo $v['total_cut_pass_qty'];?></td>
            <td class="center"><?php echo $v['total_end_pass_qty'];?></td>
            <td class="center" <?php if($sew_balance_qty > 0){ ?>style="background-color: #ffbcbf" <?php } ?>><?php echo $sew_balance_qty;?></td>
            <td class="center"><?php echo $v['total_wash_qty'];?></td>
            <td class="center"><?php echo $v['total_packing_qty'];?></td>
            <td class="center" <?php if($packing_balance_qty > 0){ ?>style="background-color: #ffbcbf" <?php } ?>><?php echo $packing_balance_qty;?></td>
            <td class="center"><?php echo $v['total_carton_qty'];?></td>
            <td class="center" onclick="getWarehousePcs('<?php echo $v['po_no']; ?>', '<?php echo $v['so_no']; ?>', '<?php echo $v['purchase_order'];?>','<?php echo $v['item'];?>', '<?php echo $v['quality']; ?>', '<?php echo $v['color']; ?>');" data-target="#myModal3" data-toggle="modal" ><span class="btn btn-primary"><?php echo ($v['count_wh_qty'] + $v['count_other_qty']);?></span></td>
            <td class="center" <?php if($balance_qty > 0){ ?>style="background-color: #ffbcbf" <?php } ?>><?php echo (($balance_qty >= 0) ? $balance_qty : 0 );?></td>
            <!--        <td class="center">--><?php //echo $v['ex_factory_date']; ?><!--</td>-->
            <td class="center">
                <?php
                if($v['order_quantity'] <= $v['total_carton_qty']) {
                    echo $v['po_closing_date'];
                }else{
                    echo '';
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="8" align="right"><h4><b>Total</b></h4></td>
        <td class="center"><h4><b><?php echo $total_order_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_cut_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_cut_pass_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_line_output_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_line_output_balance_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_washed_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_packing_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_packing_balance_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_carton_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_wh_qty + $total_other_qty;?></b></h4></td>
<!--        <td class="center"><h4><b>--><?php //echo $total_other_qty;?><!--</b></h4></td>-->
        <td class="center"><h4><b><?php echo $total_balance_qty;?></b></h4></td>
        <td class="center"></td>
    </tr>
    </tfoot>
</table>
</div>
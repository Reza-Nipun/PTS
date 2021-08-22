<section class="panel default blue_title h2">

    <div class="panel-body">

        <?php

        foreach ($sub_lines as $vl){

            $sub_line_po_report = $this->method_call->getSubLinePoReport($vl['id'], $vl['line_id'], $date);

        ?>

        <table class="table" border="1">
            <thead>
                <tr>
                    <th class="center" colspan="8">
                        <span style="font-size: 20px;">
                            <?php echo $vl['sub_line_name']?>
                        </span>
                    </th>
                </tr>
                <tr>
                    <th class="center">PO-Item</th>
                    <th class="center">SO</th>
                    <th class="center">BRAND</th>
                    <th class="center">QLTY-CLR</th>
                    <th class="center">STL</th>
                    <th class="center">PO TYPE</th>
                    <th class="center">ExFac</th>
                    <th class="center">
                        Mid Pass QTY
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php

            $total_mid_pass = 0;

            foreach ($sub_line_po_report as $v){

            ?>

            <tr>
                <td class="center">
                    <?php echo $v['purchase_order'] . '-' . $v['item']; ?>
                </td>
                <td class="center"><?php echo $v['so_no']; ?></td>
                <td class="center"><?php echo $v['brand']; ?></td>
                <td class="center"><?php echo $v['quality'] . '-' . $v['color']; ?></td>
                <td class="center"><?php echo $v['style_no'] . '-' . $v['style_name']; ?></td>
                <td class="center">
                    <?php
                    if($v['po_type'] == 0){
                        echo 'BULK';
                    }
                    if($v['po_type'] == 1){
                        echo 'SIZE SET';
                    }
                    if($v['po_type'] == 2){
                        echo 'SAMPLE';
                    }

                    ?>
                </td>
                <td class="center"><?php echo $v['ex_factory_date']; ?></td>
                <td class="center"><?php echo $v['mid_qc_sub_line_qty']; ?></td>
            </tr>
            <?php
                $total_mid_pass += $v['mid_qc_sub_line_qty'];
                }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td align="right" colspan="7">Total</td>
                    <td class="center"><?php echo $total_mid_pass;?></td>
                </tr>
            </tfoot>
        </table>

        <?php
        }
        ?>


    </div>
</section>
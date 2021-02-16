<table class="display table table-bordered table-striped" id="" border="1">
    <thead>
    <tr>
        <th class="hidden-phone center">SL</th>
        <th class="hidden-phone center">Line</th>
        <th class="hidden-phone center">Piece No</th>
        <th class="hidden-phone center">SO</th>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">PO</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">Quality</th>
        <th class="hidden-phone center">Color</th>
        <th class="hidden-phone center">Style</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($defect_report as $k => $d){ ?>

        <tr>
            <td class="hidden-phone center"><?php echo $k+1;?></td>
            <td class="hidden-phone center"><?php echo $d['line_code'];?></td>
            <td class="hidden-phone center"><?php echo $d['pc_tracking_no'];?></td>
            <td class="hidden-phone center"><?php echo $d['so_no'];?></td>
            <td class="hidden-phone center"><?php echo $d['brand'];?></td>
            <td class="hidden-phone center"><?php echo $d['purchase_order'];?></td>
            <td class="hidden-phone center"><?php echo $d['item'];?></td>
            <td class="hidden-phone center"><?php echo $d['quality'];?></td>
            <td class="hidden-phone center"><?php echo $d['color'];?></td>
            <td class="hidden-phone center"><?php echo $d['style_no'].'-'.$d['style_name'];?></td>
        </tr>

    <?php } ?>

    </tbody>
</table>
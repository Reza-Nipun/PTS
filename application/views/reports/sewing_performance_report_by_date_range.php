<table class="display table table-bordered table-striped" id="">
    <thead>
    <tr style="background-color: #0A6EA0; color: #FFFFFF;">
        <th colspan="15" class="center"><h2>Line Report</h2></th>
    </tr>
    <tr style="background-color: #f7ffb0;">
        <th class="center">DATE</th>
        <th class="center">LINE</th>
        <th class="center">TARGET</th>
        <th class="center">OUTPUT</th>
        <th class="center">EXTRA QTY</th>
        <th class="center">TOTAL</th>
        <th class="center">RFT</th>
        <th class="center">SMV</th>
        <th class="center">WORK MIN</th>
        <th class="center">PROD MIN</th>
        <th class="center">EFFI.</th>
        <th class="center">DHU</th>
        <th class="center">WH</th>
        <th class="center">MP</th>
        <th class="center">REMARKS</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $produce_min=0;
    $work_min=0;
    $smv=0;

    $total_line_output=0;
    $total_line_rft_qty=0;
    $total_produce_minute = 0;
    $total_work_minute = 0;
    $total_dhu = 0;
    $total_mp = 0;
    $average_efficiency = 0;
    $average_dhu = 0;
    $average_work_hour = 0;
    $average_smv = 0;

    $count_lines = 0;

    foreach ($line_prod as $v){

        $over_time_qty = $v['eot_output'];
        $total_line_target += $v['target'];
        $total_line_normal_output += $v['normal_output'];
        $total_over_time_qty += $v['eot_output'];
        $total_line_output += $v['output'];
        $total_line_rft_qty += $v['rft_qty'];
        $total_sum_efficiency += $v['efficiency'];
        $total_work_hour += $v['work_hour'];

        $produce_min = $v['produce_minute_1']+$v['produce_minute_2']+$v['produce_minute_3']+$v['produce_minute_4'];
        $work_min = $v['work_minute_1']+$v['work_minute_2']+$v['work_minute_3']+$v['work_minute_4'];

        $smv = round($produce_min / $v['output'], 2);

        $total_produce_minute += $produce_min;
        $total_work_minute += $work_min;
        $total_dhu += $v['dhu'];
        $total_mp += $v['man_power_1'];

        ?>
        <tr>
            <td class="center"><?php echo $v['date'];?></td>
            <td class="center"><?php echo $v['line_code'];?></td>
            <td class="center"><?php echo $v['target'];?></td>
            <td class="center"><?php echo $v['normal_output'];?></td>
            <td class="center"><?php echo $over_time_qty;?></td>
            <td class="center"><?php echo $v['output'];?></td>
            <td class="center"><?php echo $v['rft_qty'];?></td>
            <td class="center"><?php echo $smv;?></td>
            <td class="center"><?php echo $work_min;?></td>
            <td class="center"><?php echo $produce_min;?></td>
            <td class="center"><?php echo $v['efficiency']; ?></td>
            <td class="center"><?php echo $v['dhu']; ?></td>
            <td class="center"><?php echo $v['work_hour']; ?></td>
            <td class="center"><?php echo $v['man_power_1']; ?></td>
            <td class="center"><?php echo $v['remarks']; ?></td>
        </tr>
        <?php
        $count_lines++;
    }

    $average_dhu = round($total_dhu / $count_lines, 2);
    $average_work_hour = round(($total_work_minute / 60 / $total_mp), 2);
    $average_efficiency = round((($total_produce_minute/$total_work_minute) * 100) , 2);
    $average_smv = round($total_produce_minute/$total_line_output, 2);

    ?>
    </tbody>
    <tfoot>
        <tr style="font-size: 18px;">
            <th class="text-right" colspan="5">TOTAL</th>
            <th class="center">
                <?php echo $total_line_output;?>
            </th>
            <th class="center"><?php echo $total_line_rft_qty;?></th>
            <th class="center"><?php echo $average_smv;?></th>
            <th class="center"><?php echo $total_work_minute;?></th>
            <th class="center"><?php echo $total_produce_minute;?></th>
            <th class="center"><?php echo $average_efficiency;?></th>
            <th class="center"><?php echo $average_dhu;?></th>
            <th class="center"><?php echo $average_work_hour;?></th>
            <th class="center"><?php echo $total_mp;?></th>
            <th class="center"></th>
        </tr>
    </tfoot>
</table>
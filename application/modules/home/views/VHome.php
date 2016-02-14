<!-- Main result table -->
<div class="row">
    <table class='row main-table'>
        <caption>
            <form id='resultInDay' action="" method="POST">
                <span>Xổ Số MB Ngày: </span>
                <span class=''>&nbsp;&nbsp;&nbsp;</span>
                <span>
                    <input name="date" id='dateChoice' class="form-control datepicker" onchange="$('#resultInDay').submit();" type="hidden">
                </span>
                <span class=''>&nbsp;</span>
                <span ><?php echo $date?></span>
            </form>
        </caption>
        
        <tbody>
        <?php if($result['ok'] && !empty(($list = $result['result']))) {?>
            <tr class="alert-text">
                <td width="90px">Đặc Biệt</td>
                <td width="420px" class="award">
                    <?php echo (!empty($list[0]))?$list[0]['number']:null;?>
                </td>
            </tr>
            <tr>
                <td>Giải Nhất</td>
                <td class="award">
                    <?php echo (!empty($list[1]))?$list[1]['number']:null;?>
                </td>
            </tr>
            <tr>
                <td>Giải Nhì</td>
                <td class="award" col='2'>
                    <span><?php echo (!empty($list[2]))?$list[2]['number']:null;?></span>
                    <span><?php echo (!empty($list[3]))?$list[3]['number']:null;?></span>
                </td>
            </tr>
            <tr>
                <td>Giải Ba</td>
                <td class="award" col='3'>
                    <span><?php echo (!empty($list[4]))?$list[4]['number']:null;?></span>
                    <span><?php echo (!empty($list[5]))?$list[5]['number']:null;?></span>
                    <span><?php echo (!empty($list[6]))?$list[6]['number']:null;?></span>
                    <span><?php echo (!empty($list[7]))?$list[7]['number']:null;?></span>
                    <span><?php echo (!empty($list[8]))?$list[8]['number']:null;?></span>
                    <span><?php echo (!empty($list[9]))?$list[9]['number']:null;?></span>
                </td>
            </tr>
            <tr>
                <td>Giải Tư</td>
                <td class="award" col='4'>
                    <span><?php echo (!empty($list[10]))?$list[10]['number']:null;?></span>
                    <span><?php echo (!empty($list[11]))?$list[11]['number']:null;?></span>
                    <span><?php echo (!empty($list[12]))?$list[12]['number']:null;?></span>
                    <span><?php echo (!empty($list[13]))?$list[13]['number']:null;?></span>
                </td>
            </tr>
            <tr>
                <td>Giải Năm</td>
                <td class="award" col='3'>
                    <span><?php echo (!empty($list[14]))?$list[14]['number']:null;?></span>
                    <span><?php echo (!empty($list[15]))?$list[15]['number']:null;?></span>
                    <span><?php echo (!empty($list[16]))?$list[16]['number']:null;?></span>
                    <span><?php echo (!empty($list[17]))?$list[17]['number']:null;?></span>
                    <span><?php echo (!empty($list[18]))?$list[18]['number']:null;?></span>
                    <span><?php echo (!empty($list[19]))?$list[19]['number']:null;?></span>
                </td>
            </tr>
            <tr>
                <td>Giải Sáu</td>
                <td class="award" col='3'>
                    <span><?php echo (!empty($list[20]))?$list[20]['number']:null;?></span>
                    <span><?php echo (!empty($list[21]))?$list[21]['number']:null;?></span>
                    <span><?php echo (!empty($list[22]))?$list[22]['number']:null;?></span>
                </td>
            </tr>
            <tr>
                <td>Giải Bảy</td>
                <td class="award" col='4'>
                    <span><?php echo (!empty($list[23]))?$list[23]['number']:null;?></span>
                    <span><?php echo (!empty($list[24]))?$list[24]['number']:null;?></span>
                    <span><?php echo (!empty($list[25]))?$list[25]['number']:null;?></span>
                    <span><?php echo (!empty($list[26]))?$list[26]['number']:null;?></span>
                </td>
            </tr>
        <?php }else {?>
            <tr><td class="red"><b>Ngày <?php echo $date?> chưa tiến hành quay số</b>></td></tr>
            <?php }?>
        </tbody>
    </table>
</div>
<!-- End main result table -->

<!-- Loto result table -->
<?php if($result['ok'] && !empty($result['result'])) {
    $loto = $result['result'];
?>
<div class="row">
    <table class="main-table">
        <caption>Bảng Thống Kê lô tô</caption>
        <tbody>
            <?php
            $count = 0;
            $list = array();
            foreach ($loto as $key => $value) {
                if($value['award']) {
                    $list[] = $value['loto'] . 0;
                }else {
                    $list[] = $value['loto'] . 1;
                }
            }

            asort($list);

            foreach ($list as $key => $value) {
                switch ($count % 9) {
                    case '0':
                        if($value%10) {
                            echo '<tr><td class="award alert-text">'. substr($value, 0, -1) .'</td>';
                        }else {
                            echo '<tr><td class="award">'. substr($value, 0, -1) .'</td>';
                        }
                        break;

                    case '8':
                        if($value%10) {
                            echo '<td class="award alert-text">'. substr($value, 0, -1) .'</td></tr>';
                        }else {
                            echo '<td class="award">'. substr($value, 0, -1) .'</td></tr>';
                        }
                        break;
                    
                    default:
                        if($value%10) {
                            echo '<td class="award alert-text">'. substr($value, 0, -1) .'</td>';
                        }else {
                            echo '<td class="award">'. substr($value, 0, -1) .'</td>';
                        }
                        break;
                }

                $count += 1;
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="left">
        <table class="half-table row main-table">
            <thead>
                <tr>
                    <th width="30px">Đầu</th>
                    <th>Lô Tô</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $list = array();
                foreach ($loto as $key => $value) {
                    if(!isset($list[$value['head']])) {
                        $list[$value['head']] = array();
                    }

                    if($value['award']) {
                        $list[$value['head']][] = $value['loto'] . 0;
                    }else {
                        $list[$value['head']][] = $value['loto'] . 1;
                    }
                }

                for($label = 0; $label <= 9; $label += 1) {
                    if(!empty($list[$label])) {
                        asort($list[$label]);

                        foreach ($list[$label] as $key => $value) {
                            if($value % 10) {
                                $list[$label][$key] = '<b class="alert-text">' . substr($value, 0, -1) . '</b>';
                            }else {
                                $list[$label][$key] = substr($value, 0, -1);
                            }
                        }
                        echo '<tr><td class="text-center">'.$label.'</td><td class="award">'. implode('; ', $list[$label]) .'</td></tr>';
                    }else {
                        echo '<tr><td class="text-center">'.$label.'</td><td class="award"></td></tr>';
                    }
                    
                }
                
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="right">
        <table class="half-table row main-table">
            <thead>
                <tr>
                    <th width="30px">Đít</th>
                    <th>Lô Tô</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $list = array();
                foreach ($loto as $key => $value) {
                    if(!isset($list[$value['foot']])) {
                        $list[$value['foot']] = array();
                    }

                    if($value['award']) {
                        $list[$value['foot']][] = $value['loto'] . 0;
                    }else {
                        $list[$value['foot']][] = $value['loto'] . 1;
                    }
                }

                for($label = 0; $label <= 9; $label += 1) {
                    if(!empty($list[$label])) {
                        asort($list[$label]);

                        foreach ($list[$label] as $key => $value) {
                            if($value % 10) {
                                $list[$label][$key] = '<b class="alert-text">' . substr($value, 0, -1) . '</b>';
                            }else {
                                $list[$label][$key] = substr($value, 0, -1);
                            }
                        }
                        echo '<tr><td class="text-center">'.$label.'</td><td class="award">'. implode('; ', $list[$label]) .'</td></tr>';
                    }else {
                        echo '<tr><td class="text-center">'.$label.'</td><td class="award"></td></tr>';
                    }
                    
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php }?>
<!-- End loto result table -->

<!-- Quick statistic -->
<?php if(!empty($statistic)) {?>
<div class="row">
    <table class='row second-table'>
        <caption>Thống kê lô khan</caption>
        <tbody>
            <tr>
                <td class="award" col='3'>
                    <?php foreach ($statistic['lo_khan'] as $key => $value) {
                        echo $key." ($value ngày)<br>";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <table class='row second-table'>
        <caption>Thống kê lô rơi</caption>
        <tbody>
            <tr>
                <td class="award" col='3'>
                    <?php foreach ($statistic['lo_roi'] as $key => $value) {
                        echo $key." ($value ngày)<br>";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <table class='row second-table'>
        <caption>Lô tô về nhiều nhất trong 100 ngày</caption>
        <tbody>
            <tr>
                <td class="award" col='3'>
                    <?php foreach ($statistic['lo_nhieu'] as $key => $value) {
                        echo $key." ($value ngày)<br>";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <table class='row second-table'>
        <caption>Lô tô về ít nhất trong 100 ngày</caption>
        <tbody>
            <tr>
                <td class="award" col='3'>
                    <?php foreach ($statistic['lo_it'] as $key => $value) {
                        echo $key." ($value ngày)<br>";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php }?>
<!-- End quick statistic -->
<?php foreach ($result as $value) {?>
	<!-- Main result table -->
<div class="row">
    <table class='row main-table'>
        <caption>
            <form id='resultInDay' action="" method="POST">
                <span>Xổ Số MB Ngày: </span>
                <span class=''>&nbsp;&nbsp;&nbsp;</span>
                <!-- <span>
                    <input name="date" id='dateChoice' class="form-control datepicker" onchange="$('#resultInDay').submit();" type="hidden">
                </span> -->
                <span class=''>&nbsp;</span>
                <span ><?php echo $value['_id']['date']?></span>
            </form>
        </caption>
        
        <tbody>
        <tr  style="vertical-align:top;">
        	<td width="330px">
        		<table class="second-table">
        			<tbody>
        				<?php if(!empty(($list = $value['detail']))) {?>
				            <tr class="alert-text">
				                <!-- <td width="90px">Đặc Biệt</td> -->
				                <td class="award">
				                    <?php echo (!empty($list[0]))?$list[0]['number']:null;?>
				                </td>
				            </tr>
				            <tr>
				                <!-- <td>Giải Nhất</td> -->
				                <td class="award">
				                    <?php echo (!empty($list[1]))?$list[1]['number']:null;?>
				                </td>
				            </tr>
				            <tr>
				                <!-- <td>Giải Nhì</td> -->
				                <td class="award" col='2'>
				                    <span><?php echo (!empty($list[2]))?$list[2]['number']:null;?></span>
				                    <span><?php echo (!empty($list[3]))?$list[3]['number']:null;?></span>
				                </td>
				            </tr>
				            <tr>
				                <!-- <td>Giải Ba</td> -->
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
				                <!-- <td>Giải Tư</td> -->
				                <td class="award" col='4'>
				                    <span><?php echo (!empty($list[10]))?$list[10]['number']:null;?></span>
				                    <span><?php echo (!empty($list[11]))?$list[11]['number']:null;?></span>
				                    <span><?php echo (!empty($list[12]))?$list[12]['number']:null;?></span>
				                    <span><?php echo (!empty($list[13]))?$list[13]['number']:null;?></span>
				                </td>
				            </tr>
				            <tr>
				                <!-- <td>Giải Năm</td> -->
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
				                <!-- <td>Giải Sáu</td> -->
				                <td class="award" col='3'>
				                    <span><?php echo (!empty($list[20]))?$list[20]['number']:null;?></span>
				                    <span><?php echo (!empty($list[21]))?$list[21]['number']:null;?></span>
				                    <span><?php echo (!empty($list[22]))?$list[22]['number']:null;?></span>
				                </td>
				            </tr>
				            <tr>
				                <!-- <td>Giải Bảy</td> -->
				                <td class="award" col='4'>
				                    <span><?php echo (!empty($list[23]))?$list[23]['number']:null;?></span>
				                    <span><?php echo (!empty($list[24]))?$list[24]['number']:null;?></span>
				                    <span><?php echo (!empty($list[25]))?$list[25]['number']:null;?></span>
				                    <span><?php echo (!empty($list[26]))?$list[26]['number']:null;?></span>
				                </td>
				            </tr>
				        <?php }?>
        			</tbody>
        		</table>
        	</td>
        	<td width="180px">
        		<table class="row second-table">
		            <tbody>
		                <?php 
		                $loto = $value['detail'];
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
        	</td>
        </tr>
        
        </tbody>
    </table>
</div>
<!-- End main result table -->
<?php }?>

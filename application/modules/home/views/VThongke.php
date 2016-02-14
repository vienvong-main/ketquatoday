<form method="POST">
	<select name='city'>
		<!-- <option value="00">Truyền thống</option> -->
		<?php 
		if(isset($cities)) {
			foreach ($cities as $value) {
				echo '<option value="'. $value['_id'] .'" '. (($value['_id'] == '00')?'selected':null) .'>'. $value['city'] .'</option>';
			}
		} 
		?>
	</select>
	<input type="text" name="listnumber">
	<input type="date" name="startdate" value="<?php echo $startdate?>">
	<input type="date" name='enddate' value="<?php echo $enddate?>">
	<button type="submit">Thong Ke</button>
</form>

<?php if(!empty($result)) { ?>

<div class='row'>
	<table class='second-table'>
		<caption>Kết quả thống kê</caption>
		<thead>
			<tr>
				<td>Loto</td>
				<td>Số lần về</td>
				<td>Số ngày về / <?php echo $total_date;?></td>
				<td>Số ngày chưa về</td>
				<td>Ngày về gần nhất</td>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($result)) {
				foreach ($result as $key => $value) {
			?>
				<tr>
					<td>
						<?php echo $value['_id']['loto'];?>
					</td>
					<td>
						<?php echo $value['count']. '<br>(' . round($value['count'] / $total_loto * 100, 2) . '%)';?>
					</td>
					<td>
						<?php echo count($value['date']) . '<br>(' . round(count($value['date']) / $total_date * 100, 2) . '%)';?>
					</td>
					<td>
						<?php echo $value['long'];?>
					</td>
					<td>
						<?php echo $value['date_MAX'];?>
					</td>
				</tr>
			<?php }}?>
		</tbody>
	</table>
</div>
<?php }?>

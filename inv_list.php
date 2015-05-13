
<?php

include_once("model_interface_css.php");
$inv_item_list = css_get_inv_item_list();
$vendors = css_get_inv_vendor_list();
$ven = array();
foreach ($vendors as $key => $value) {
	$ven[$value['id']] = $value['vendor_name'];
}

/*<th>ID</th>*/
echo '<div id="inv_item_table">';
echo '<table id="inv_item_table">';
echo '<tr><th>P/N</th><th>Desc</th><th>Current Stock</th><th>Per Tray</th><th>Trays</th><th>Days (Weeks)</th><th>Stock Level</th><th>Lead Time (Days)</th><th>Vendor</th></tr>';
foreach($inv_item_list as $k => $v){

	$trays = $v['current_stock'] / $v['per_tray'];
	$days_till_empty = ($trays / 6);
	$weeks_till_empty = $days_till_empty / 5;

	echo '<tr>';
		//echo '<td>'.$v['id'].'</td>';
		echo '<td>'.$v['part_number'].'</td>';
		echo '<td>'.$v['description'].'</td>';
		echo '<td>'.$v['current_stock'].'</td>';
		echo '<td>'.$v['per_tray'].'</td>';
		echo '<td>'.round($trays,0).'</td>';
		echo '<td>'.round($days_till_empty,0).' ('.round($weeks_till_empty,0).')</td>';
		echo '<td>'.$v['stock_level'].'</td>';
		echo '<td>'.$v['lead_time_days'].'</td>';
		echo '<td>'.$ven[$v['preferred_vendor_id']].'</td>';
	echo '</tr>';
}
echo "</table>";
echo "</div>";
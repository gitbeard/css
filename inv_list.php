<?php
echo '<style type="text/css" title="currentStyle"> @import "csslib/css/css.css"; </style>';

include_once("model_interface_css.php");
$inv_item_list = css_get_inv_item_list();
$vendors = css_get_inv_vendor_list();
$ven = array();
foreach ($vendors as $key => $value) {
	$ven[$value['id']] = $value['vendor_name'];
}

/*<th>ID</th>*/
echo '<div id="inv_item_table">';
echo '<table id="status_trays">';
echo '<tr><th>Name</th><th>Trays</th><th>Days (Weeks)</th><th>Vendor</th><th>Current Stock</th><th>Per Tray</th><th>P/N</th><th>Desc</th></tr>';
foreach($inv_item_list as $k => $v){
	$trays = 0;
	$days_till_empty = 0;
	$weeks_till_empty = 0;

	if($v['current_stock'] > 0)
	{
		$trays = $v['current_stock'] / $v['per_tray'];
		$days_till_empty = ($trays / 6);
		$weeks_till_empty = $days_till_empty / 5;
	}

	if($days_till_empty < 3 and $days_till_empty > 2){
		echo '<tr class="yellow">';	
	}elseif($days_till_empty <= 2){
		echo '<tr class="red">';
	}
	else{
		echo '<tr>';
	}
		//echo '<td>'.$v['id'].'</td>';
		echo '<td>'.$v['part_name'].'</td>';
		echo '<td>'.round($trays,0).'</td>';
		echo '<td>'.round($days_till_empty,0).' ('.round($weeks_till_empty,0).')</td>';
		echo '<td>'.$ven[$v['preferred_vendor_id']].'</td>';
		echo '<td>'.$v['current_stock'].'</td>';
		echo '<td>'.$v['per_tray'].'</td>';
		echo '<td>'.$v['part_number'].'</td>';
		echo '<td>'.$v['description'].'</td>';
		
		/*echo '<td>';
		echo '<form action="telescent/?q=item_page" method="POST">';
		echo '<input type="hidden" name="item_id" value="'.$v["id"].'" />';
		echo '<input type="submit" value="'.$v['part_name'].'" class="button" />';
		echo '</form>';
		echo '</td>';*/
		//echo '<td>'.$v['stock_level'].'</td>';
		//echo '<td>'.$v['lead_time_days'].'</td>';
		//<th>Stock Level</th><th>Lead Time (Days)</th>

	echo '</tr>';
}
echo "</table>";
echo "</div>";
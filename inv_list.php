
<?php

include_once("model_interface_css.php");
$inv_item_list = css_get_inv_item_list();


echo '<div id="inv_item_table">';
echo '<table id="inv_item_table">';
echo '<tr><th>ID</th><th>P/N</th><th>Desc</th><th>Stock Level</th><th>Lead Time (Days)</th><th>Vendor</th></tr>';
foreach($inv_item_list as $k => $v){
	echo '<tr>';
		echo '<td>'.$v['id'].'</td>';
		echo '<td>'.$v['part_number'].'</td>';
		echo '<td>'.$v['description'].'</td>';
		echo '<td>'.$v['stock_level'].'</td>';
		echo '<td>'.$v['lead_time_days'].'</td>';
		echo '<td>'.$v['preferred_vendor_id'].'</td>';
	echo '</tr>';
}
echo "</table>";
echo "</div>";
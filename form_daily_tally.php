
<?php

include_once("model_interface_css.php");
$inv_item_list = css_get_daily_tally();


/*<th>ID</th>*/
echo '<div id="daily_tally_table">';
echo '<table id="daily_tally_table">';
echo '<tr><th>Date</th><th>Reels</th><th>Wound</th><th>Route</th><th>Prep</th><th>Splice</th><th>Finish</th><th>Test</th><th>Delivered</th></tr>';
foreach($inv_item_list as $k => $v){
	
	echo '<tr>';
		//echo '<td>'.$v['id'].'</td>';
		echo '<td>'.$v['date'].'</td>';

		//echo '<td>'.$v['part_name'].'</td>';
		echo '<td>'.$v['reels'].'</td>';
		echo '<td>'.$v['wound'].'</td>';
		echo '<td>'.$v['routed'].'</td>';
		echo '<td>'.$v['prepped'].'</td>';
		echo '<td>'.$v['spliced'].'</td>';
		echo '<td>'.$v['tested'].'</td>';
		echo '<td>'.$v['delivered'].'</td>';
	echo '</tr>';
}
echo "</table>";
echo "</div>";
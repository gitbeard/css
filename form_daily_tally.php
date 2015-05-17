
<?php

include_once("model_interface_css.php");
$inv_item_list = css_get_daily_tally();


/*<th>ID</th>*/
echo '<div id="daily_tally_table">';
echo '<table id="daily_tally_table">';
echo '<tr><th>Date</th><th>Reels</th><th>Wound</th><th>Route</th><th>Prep-In</th><th>Splice-In</th><th>Finish-In</th><th>Prep-Out</th><th>Splice-Out</th><th>Finish-Out</th><th>Test</th><th>Delivered</th><th>Broken Reels</th></tr>';
foreach($inv_item_list as $k => $v){
	
	echo '<tr>';
		//echo '<td>'.$v['id'].'</td>';
		echo '<td>'.$v['datetime'].'</td>';

		//echo '<td>'.$v['part_name'].'</td>';
		echo '<td>'.$v['reels'].'</td>';
		echo '<td>'.$v['wound'].'</td>';
		echo '<td>'.$v['routed'].'</td>';
		echo '<td>'.$v['prepared_inputs'].'</td>';
		echo '<td>'.$v['spliced_inputs'].'</td>';
		echo '<td>'.$v['finished_inputs'].'</td>';
		echo '<td>'.$v['prepared_outputs'].'</td>';
		echo '<td>'.$v['spliced_outputs'].'</td>';
		echo '<td>'.$v['finished_outputs'].'</td>';
		echo '<td>'.$v['tested'].'</td>';
		echo '<td>'.$v['delivered'].'</td>';
		echo '<td>'.$v['broken_reels'].'</td>';
	echo '</tr>';
}
echo "</table>";
echo "</div>";



/*
id
datetime
reels
wound
routed
prepared
spliced
finished
tested
delivered
broken_reels
*/
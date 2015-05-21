
<?php

echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';

include_once("model_interface_css.php");
$stages = css_get_stages();
$status_trays = css_get_view_status_trays();

$st = array();
foreach ($status_trays as $k => $v) {
	$st[$v['tray_number']][$v['current_stage_id']] = $v['end_time'];
}
/*
echo "<pre>";
print_r($st);
print_r($status_trays);
print_r($stages);
*/

echo '<div id="status_trays">';
echo '<table id="status_trays">';

echo '<tr>';
echo '<th>Tray #</th>';
foreach ($stages as $key => $value) {
	echo '<th>'.$value['stage_name'].'</th>';
}
echo '</tr>';

//echo '<tr><th>Date</th><th>Reels</th><th>Wound</th><th>Route</th><th>Prep-In</th><th>Splice-In</th><th>Finish-In</th><th>Prep-Out</th><th>Splice-Out</th><th>Finish-Out</th><th>Test</th><th>Delivered</th><th>Broken Reels</th></tr>';
foreach($st as $k => $v){
	echo '<tr>';
	echo '<td>'.$k.'</td>';
		foreach ($stages as $key => $value) {
			$stage_id = $value['id'];
			reset($v);
			$lowest_stage_complete = key($v);

			if($stage_id < $lowest_stage_complete){
				echo '<td>'.''.'</td>';
			}else{
				if(isset($v[$value['id']])){
					$d = date('m/d', strtotime($v[$value['id']]));
					echo '<td>'.$d.'</td>';
				}
				else{
					$b = 'x';
					//echo '<td>'.'<input type="button" value="'.$b.'" id="'.$b.'" name="'.$b.'" onclick="msg('.$k.')">'.'</td>'; // alert testing
					echo '<td>'.'<input type="button" value="'.$k.'" id="'.$stage_id.'" name="'.$b.'">'.'</td>'; // ajax submit
				}
			}
			
		}
	echo '</tr>';
}
echo "</table>";
echo "</div>";

echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/submit_form_status_tray_ajax.js"></script>';
//','.$value['stage_name'].
?>


<script>
function msg(a) {
    alert("Tray "+ a);
}
</script>

<?php
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
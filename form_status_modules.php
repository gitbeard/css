
<?php

echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';
echo '<style type="text/css" title="currentStyle"> @import "csslib/css/css.css"; </style>';

include_once("model_interface_css.php");
// $stages = css_get_modules();
$modules = css_get_modules();
$status_trays = css_get_status_tray_stages();

$st = array();
$trays = array();
foreach ($status_trays as $k => $v) {
	$st[$v['tray_number']][$v['stage_id']] = $v['end_time'];
	$trays[$v['tray_number']] = $v['tray_id'];
}
/* echo "<pre>"; print_r($st); print_r($status_trays); print_r($stages); */

echo '<div id="result"></div>';

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
	if(key($v) == 14){
		continue;
	}
	echo '<tr>';
	echo '<td>'.$k.'</td>';
		foreach ($stages as $key => $value) {
			$stage_id = $value['id'];
			reset($v);
			$lowest_stage_complete = key($v);

			if($stage_id < $lowest_stage_complete){
				echo '<td class="gray">'.'-'.'</td>';
			}else{
				if(isset($v[$value['id']])){
					$d = date('m/d', strtotime($v[$value['id']]));
					echo '<td class="gray">'.$d.'</td>';
				}
				else{
					$b = 'x';
					//echo '<td>'.'<input type="button" value="'.$b.'" id="'.$b.'" name="'.$b.'" onclick="msg('.$k.')">'.'</td>'; // alert testing
					echo '<td>'.'<input type="button" class="button" value="'.$value['stage_name'].'-'.$k.'" id="'.$stage_id.'" name="'.$trays[$k].'">'.'</td>'; // ajax submit
				}
			}
		}
	echo '</tr>';
}
echo "</table>";
echo "</div>";

echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/submit_form_tray_in_module_ajax_new.js"></script>';
//','.$value['stage_name'].

/*
<script>
function msg(a) {
    alert("Tray "+ a);
}
</script>



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
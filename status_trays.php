
<?php

include_once("model_interface_css.php");
$status_trays_array = css_get_view_status_trays();


echo '<div id="status_tray_table">';
echo '<table id="status_tray_table">';
echo '<tr><th>Tray#</th><th>Stage#</th><th>Stage</th><th>Fiber</th></tr>';
foreach($status_trays_array as $k => $v){
	echo '<tr>';
		echo '<td>'.$v['tray_number'].'</td>';
		echo '<td>'.$v['current_stage_id'].'</td>';
		echo '<td>'.$v['stage_name'].'</td>';
		echo '<td>'.$v['fiber_type_description'].'</td>';
	echo '</tr>';
}
echo "</table>";
echo "</div>";
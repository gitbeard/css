<?php

echo '<style type="text/css" title="currentStyle"> @import "csslib/css/css.css"; </style>';

include_once("model_interface_css.php");
$trays_in_module = css_get_status_tray_in_module();

echo "<pre>";
print_r($trays_in_module);

$st = array();
foreach ($trays_in_module as $k => $v) {
	$st[$v['id']] = $v['tray_number'];
	//$st[$v['tray_number']] = $v['end_time'];
}

echo '<div id="status_trays">';
echo '<table id="status_trays">';
echo '<tr><th>Tray #</th><th>In Module</th></tr>';

$modules = get_list_of_modules();

foreach($st as $k => $v){
	$d = date('m/d', strtotime($v));
	echo '<tr><td>'.$k.'</td>';
	foreach ($modules as $key => $value) {
		echo '<td>'.'<input type="button" class="button" value="'.$value['module_number'].'" id="'.$value['id'].'" name="'.$k.'">'.'</td>'; // ajax submit
	}
	//echo '<td class="gray">'.$d.'</td></tr>';
}
echo "</table>";
echo "</div>";

print_r(get_fiber_type_for_tray_id(1));
echo "<br>";
print_r(get_fiber_type_for_tray_id(91));

echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/submit_form_tray_in_module_ajax_new.js"></script>';






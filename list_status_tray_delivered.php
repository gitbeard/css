<?php

echo '<style type="text/css" title="currentStyle"> @import "csslib/css/css.css"; </style>';

include_once("model_interface_css.php");
$delivered_trays = css_get_status_tray_delivered();

$st = array();
foreach ($delivered_trays as $k => $v) {
	$st[$v['tray_number']] = $v['end_time'];
}

echo '<div id="status_trays">';
echo '<table id="status_trays">';
echo '<tr><th>Tray #</th><th>Delivered</th></tr>';

foreach($st as $k => $v){
	$d = date('m/d', strtotime($v));
	echo '<tr><td>'.$k.'</td>';
	echo '<td class="gray">'.$d.'</td></tr>';
}
echo "</table>";
echo "</div>";
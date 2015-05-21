<?php
include_once("model_interface_css.php");

//$a = $_POST['id']; //$c = $_POST['start_time']; //$d = $_POST['end_time'];
$b = $_POST['tray_number'];
$e = $_POST['current_stage_id'];
$f = $_POST['fiber_type'];

// start_time
if(isset($_POST['start_time'])){$c = date('Y-m-d', strtotime($_POST['start_time'])).' 00:00:00';}
if($c == '1969-12-31 00:00:00'){$c = date('Y-m-d').' 00:00:00';}

$d = '9999-12-31 23:59:59';  // end_time

css_insert_status_tray_new($b,$c,$d,$e,$f);

header("Location: http://continentalsecondshift.com/telescent/?q=tray_status");
//print_r($params);
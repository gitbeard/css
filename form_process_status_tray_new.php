<?php
include_once("model_interface_css.php");

//$a = $_POST['id']; //$c = $_POST['start_time']; //$d = $_POST['end_time'];
$b = $_POST['tray_number'];
//$e = $_POST['current_stage_id'];
$f = $_POST['fiber_type'];

// start_time
//if(isset($_POST['start_time'])){$c = date('Y-m-d', strtotime($_POST['start_time'])).' 00:00:00';}
//if($c == '1969-12-31 00:00:00'){$c = date('Y-m-d').' 00:00:00';}

date_default_timezone_set('America/Los_Angeles');
$c = date('Y-m-d').' 00:00:00'; // start_time
$d = '9999-12-31 23:59:59';  // end_time
$e = 1; //current_stage_id "tray_assemblyed", don't care about it in this table anymore...
css_insert_status_tray_new($b,$c,$d,$e,$f);


// Then insert into status_tray_stages
//Find the newly created tray's id
$new_tray = css_find_tray_by_number($b);

$b2 = $new_tray[0]['id']; //$_POST['tray_id'];
$c2 = $new_tray[0]['current_stage_id']; //$_POST['stage_id'];
$d2 = '9999-12-31 23:59:59';  // start_time
date_default_timezone_set('America/Los_Angeles');
$e2 = date('Y-m-d H:i:s'); // end_time
$f2 = 1; // coley

css_insert_status_tray_stages_new($b2,$c2,$d2,$e2,$f2);

header("Location: http://continentalsecondshift.com/telescent/?q=form_status_tray_stages");
//print_r($params);
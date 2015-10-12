<?php
include_once("model_interface_css.php");

$b = $_POST['tray_id'];
$c = $_POST['module_id'];
$d = '9999-12-31 23:59:59';  // start_time
date_default_timezone_set('America/Los_Angeles');
$e = date('Y-m-d H:i:s'); // end_time
$f = 1; // coley

css_assign_module_id_to_tray_id($b,$c);


echo date('m/d');  //Prints the date back in the table

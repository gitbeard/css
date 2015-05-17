<?php
include_once("model_interface_css.php");



//$a = $_POST['id'];
$b = $_POST['datetime'];
$c = $_POST['reels'];
$d = $_POST['wound'];
$e = $_POST['routed'];
$f = $_POST['prepared_inputs'];
$g = $_POST['spliced_inputs'];
$h = $_POST['finished_inputs'];
$i = $_POST['prepared_outputs'];
$j = $_POST['spliced_outputs'];
$k = $_POST['finished_outputs'];
$l = $_POST['tested'];
$m = $_POST['delivered'];
$n = $_POST['broken_reels'];


// $b = $b." 00:00:00";
// echo "<br>";
// echo "$b";

$b = date('Y-m-d', strtotime($b)).' 00:00:00';

//print_r($params);

css_insert_daily_tally_new($b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n);



//Auto update inventory

//Reels remove reel parts
//Bottom, Top, Bearing assembly, Foam Tape, Fiber, DLT Heatshrink Piano

//Wound
//Tray nuts - 12

//Route - nothing

//splice inputs
//pigtails 12, SM or MM?
//Splice sleeves

//splice outputs
//pigtails 12, SM or MM?
//Output housings and tips
//Rib cage







//header("Location: http://continentalsecondshift.com/telescent/?q=daily_tally");
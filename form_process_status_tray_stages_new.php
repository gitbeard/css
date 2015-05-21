<?php
include_once("model_interface_css.php");
//css_insert_inv_item('23','cardsss','2','4','1');
//echo "<p>COooool</p>";

//print_r($_POST);

//echo("Tray#: ".$_POST['tray_number']);
//echo("Stage ID: ".$_POST['stage_id']);

//print_r(serializedData);
//Form submitted
//$params = array();
//parse_str($_POST, $params);
//print_r($params);


//$b = $_POST['tray_number'];
//$e = $_POST['stage_id'];


//$a = $_POST['id'];
//$d = $_POST['start_time'];
//$e = $_POST['end_time'];
//$f = $_POST['person_id'];
$b = $_POST['tray_id'];
$c = $_POST['stage_id'];
$d = '9999-12-31 23:59:59';  // start_time
date_default_timezone_set('America/Los_Angeles');
$e = date('Y-m-d H:i:s'); // end_time
$f = 1; // coley

css_insert_status_tray_stages_new($b,$c,$d,$e,$f);

echo date('m/d');  //Prints the date back in the table

//header("Location: http://continentalsecondshift.com/telescent/?q=tray_status");

// start_time
//if(isset($_POST['start_time'])){$c = date('Y-m-d', strtotime($_POST['start_time'])).' 00:00:00';}
//if($c == '1969-12-31 00:00:00'){$c = date('Y-m-d').' 00:00:00';}




/*$a = $_POST['part_number'];
$b = $_POST['description'];
$c = $_POST['current_stock'];
$d = $_POST['per_tray'];
$e = $_POST['stock_level'];
$f = $_POST['lead_time_days'];
$g = $_POST['preferred_vendor_id'];

print_r($params);
css_insert_inv_item($a,$b,$c,$d,$e,$f,$g);*/

/*
if(isset($_POST['submit_item'])) {
  //Error checking
  if(!$_POST['part_number']) {
    $error['part_number'] = "<p>Please supply part_number.</p>\n";
  }

  //No errors, process
  if(!isset($error)) {
    //Process your form
    //Display confirmation page
    //echo "<p>Thank you for your submission.</p>\n";

    //echo '<pre>';
    //print_r($_POST);

    // $a = $_POST['part_number'];
    // $b = $_POST['description'];
    // $c = $_POST['stock_level'];
    // $d = $_POST['lead_time_days'];
    // $e = $_POST['preferred_vendor_id'];
    $x = 5;

    //css_insert_inv_item($a,$b,$c,$d,$e);
    //header("/?q=inv_list");
    //header("Location: http://continentalsecondshift.com/telescent/?q=inv_list");
    //Require or include any page footer you might have
    //here as well so the style of your page isn't broken.
    //exit; //Then exit the script.
  }
}*/

?>
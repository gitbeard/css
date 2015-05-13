<?php
include_once("model_interface_css.php");
//css_insert_inv_item('23','cardsss','2','4','1');
//echo "COooool";
//print_r($_POST);
//print_r($_POST['serializedData']);
//print_r(serializedData);
//Form submitted
//$params = array();
//parse_str($_POST, $params);

$a = $_POST['part_number'];
$b = $_POST['description'];
$c = $_POST['current_stock'];
$d = $_POST['per_tray'];
$e = $_POST['stock_level'];
$f = $_POST['lead_time_days'];
$g = $_POST['preferred_vendor_id'];

print_r($params);
css_insert_inv_item($a,$b,$c,$d,$e,$f,$g);
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
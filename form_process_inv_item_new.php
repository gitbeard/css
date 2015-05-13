<?php
//Form submitted

if(isset($_POST['submit_item'])) {
  //Error checking
  if(!$_POST['id']) {
    $error['id'] = "<p>Please supply ID.</p>\n";
  }
  if(!$_POST['part_number']) {
    $error['part_number'] = "<p>Please supply part_number.</p>\n";
  }

  //No errors, process
  if(!isset($error)) {
    //Process your form
    //Display confirmation page
    echo "<p>Thank you for your submission.</p>\n";

    echo '<pre>';
    print_r($_POST);

    $a = $_POST['part_number'];
    $b = $_POST['description'];
    $c = $_POST['stock_level'];
    $d = $_POST['lead_time_days'];
    $e = $_POST['preferred_vendor_id'];


    css_insert_inv_item($a,$b,$c,$d,$e);
    //Require or include any page footer you might have
    //here as well so the style of your page isn't broken.
    //exit; //Then exit the script.
  }else{
    echo '<pre>';
    print_r($error);
    print_r($_POST);
  }
}

?>
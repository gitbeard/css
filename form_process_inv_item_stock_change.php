<?php
include_once("model_interface_css.php");


$item_id = $_POST['item_id'];
$current_stock = $_POST['current_stock'];

//echo $item_id;
//echo $current_stock;
css_update_item_current_stock($item_id,$current_stock);

header("Location: http://continentalsecondshift.com/telescent/?q=inv_list_quick");
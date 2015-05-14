<?php

$item_id = $_POST['item_id'];

include_once("model_interface_css.php");
$inv_item = css_find_inv_item_by_id($item_id);
print_r($inv_item);

echo $inv_item[0]['part_name'];


$form_process_location = "http://continentalsecondshift.com/telescent/csslib/form_process_inv_item_stock_change.php";//if not doing AJAX and want to view processing page use this: "?q=node/7"; 
$form_method = "POST";
echo '<form action="'.$form_process_location.'" id="itemForm" method="'.$form_method.'">';
echo '<input type="hidden" name="item_id" value="'.$inv_item[0]['id'].'" />';
echo '<input type="text" id="current_stock" name="current_stock" placeholder="current_stock">';
echo '<input class="button" type="submit" name="submit_item" value="Submit">';
echo '</form>';
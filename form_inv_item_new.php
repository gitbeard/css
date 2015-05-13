<?php

 echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';


include_once("model_interface_css.php");
$vendors = css_get_inv_vendor_list();


$form_process_location = "http://continentalsecondshift.com/telescent/csslib/form_process_inv_item_new.php";//if not doing AJAX and want to view processing page use this: "?q=node/7"; 
$form_method = "POST";
 
echo '<form action="'.$form_process_location.'" id="itemForm" method="'.$form_method.'">';

	//Inputs
	//echo '<input type="text" id="id" name="id" placeholder="id">';
	echo '<input type="text" id="part_number" name="part_number" placeholder="part_number">';
	echo '<input type="text" id="description" name="description" placeholder="description">';
	echo '<input type="text" id="current_stock" name="current_stock" placeholder="current_stock">';
	echo '<input type="text" id="per_tray" name="per_tray" placeholder="per_tray">';
	echo '<input type="text" id="stock_level" name="stock_level" placeholder="stock_level">';
	echo '<input type="text" id="lead_time_days" name="lead_time_days" placeholder="lead_time_days">';
	//echo '<input type="text" id="preferred_vendor_id" name="preferred_vendor_id" placeholder="preferred_vendor_id">';
	echo '<select name="lead_time_days" id="lead_time_days">';
		foreach ($vendors as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['vendor_name'].'</option>';
		}
	echo '</select>';

//, description : description, stock_level : stock_level, lead_time_days : lead_time_days, preferred_vendor_id : preferred_vendor_id

	echo '<br>';
	echo '<input class="button" type="submit" name="submit_item" value="Submit">';
echo '</form>';
?>

<!-- the result of the search will be rendered inside this div -->
<div id="result"></div>

<?php

echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/new_ajax.js"></script>';
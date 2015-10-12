<?php
/*id tray_number start_time end_time current_stage_id fiber_type*/ 

echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';

$stages = css_get_stages();
$fiber_types = css_get_fiber_types();

$form_process_location = "http://continentalsecondshift.com/telescent/csslib/form_process_status_tray_new.php";//if not doing AJAX and want to view processing page use this: "?q=node/7"; 
$form_method = "POST";

//$a = 'id'; //$c = 'start_time'; //$d = 'end_time'; //$e = 'current_stage_id'; 
$b = 'tray_number';
$f = 'fiber_type';

echo '<form action="'.$form_process_location.'" id="itemForm" method="'.$form_method.'">';
	echo '<input type="number" id="'.$b.'" name="'.$b.'" placeholder="'.$b.'">';

	echo '<select name="'.$f.'" id="'.$f.'">';
		foreach ($fiber_types as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['fiber_type_description'].'</option>';
		}
	echo '</select>';
	
	echo '<input class="button" type="submit" name="submit_item" value="Submit">';
echo '</form>';

echo '<div id="result"></div>';

//echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/new_ajax.js"></script>';

	/*echo '<select name="'.$e.'" id="'.$e.'">';
		foreach ($stages as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['stage_name'].'</option>';
		}
	echo '</select>';*/
?>
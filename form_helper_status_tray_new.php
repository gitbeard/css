<?php
/*id
tray_number
start_time
end_time
current_stage_id
fiber_type*/

echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';

$stages = css_get_stages();
$fiber_types = css_get_fiber_types();
//include_once("model_interface_css.php");

$form_process_location = "http://continentalsecondshift.com/telescent/csslib/form_process_status_tray_new.php";//if not doing AJAX and want to view processing page use this: "?q=node/7"; 
$form_method = "POST";

//$a = 'id';
$b = 'tray_number';
$c = 'start_time';
//$d = 'end_time';
$e = 'current_stage_id';
$f = 'fiber_type';

echo '<form action="'.$form_process_location.'" id="itemForm" method="'.$form_method.'">';
	echo '<input type="text" id="'.$b.'" name="'.$b.'" placeholder="'.$b.'">';
	echo '<input type="text" id="'.$c.'" name="'.$c.'" placeholder="'.$c.'">';

	echo '<select name="'.$e.'" id="'.$e.'">';
		foreach ($stages as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['stage_name'].'</option>';
		}
	echo '</select>';

	echo '<select name="'.$f.'" id="'.$f.'">';
		foreach ($fiber_types as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['fiber_type_description'].'</option>';
		}
	echo '</select>';
	
	echo '<input class="button" type="submit" name="submit_item" value="Submit">';
echo '</form>';

//echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/new_ajax.js"></script>';
echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />';
echo '<script src="http://code.jquery.com/jquery-1.9.1.js"></script>';
echo '<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>';

?>

<div id="result"></div>

<meta charset="utf-8">

<script type="text/javascript">
jQuery(document).ready(function ($) {
//$(document).ready(function() {
	var dates = $( "#start_time" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			var option = this.id == "start_time" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" );
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});
});
</script>
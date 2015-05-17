<?php

 echo '<script src="https://code.jquery.com/jquery-1.10.2.js"></script>';


//include_once("model_interface_css.php");

$form_process_location = "http://continentalsecondshift.com/telescent/csslib/form_process_daily_tally_new.php";//if not doing AJAX and want to view processing page use this: "?q=node/7"; 
$form_method = "POST";

$a = 'id';
$b = 'datetime';
$c = 'reels';
$d = 'wound';
$e = 'routed';
$f = 'prepared_inputs';
$g = 'spliced_inputs';
$h = 'finished_inputs';
$i = 'prepared_outputs';
$j = 'spliced_outputs';
$k = 'finished_outputs';
$l = 'tested';
$m = 'delivered';
$n = 'broken_reels';

echo '<form action="'.$form_process_location.'" id="itemForm" method="'.$form_method.'">';
	//echo '<input type="text" id="'.$a.'" name="'.$a.'" placeholder="'.$a.'">';
	//echo '<input type="text" id="'.$b.'" name="'.$b.'" placeholder="'.$b.'">';
	echo '<input type="text" id="'.$b.'" name="'.$b.'" placeholder="'.$b.'">';
	echo '<input type="text" id="'.$c.'" name="'.$c.'" placeholder="'.$c.'">';
	echo '<input type="text" id="'.$d.'" name="'.$d.'" placeholder="'.$d.'">';
	echo '<input type="text" id="'.$e.'" name="'.$e.'" placeholder="'.$e.'">';
	echo '<input type="text" id="'.$f.'" name="'.$f.'" placeholder="'.$f.'">';
	echo '<input type="text" id="'.$g.'" name="'.$g.'" placeholder="'.$g.'">';
	echo '<input type="text" id="'.$h.'" name="'.$h.'" placeholder="'.$h.'">';
	echo '<input type="text" id="'.$i.'" name="'.$i.'" placeholder="'.$i.'">';
	echo '<input type="text" id="'.$j.'" name="'.$j.'" placeholder="'.$j.'">';
	echo '<input type="text" id="'.$k.'" name="'.$k.'" placeholder="'.$k.'">';
	echo '<input type="text" id="'.$l.'" name="'.$l.'" placeholder="'.$l.'">';
	echo '<input type="text" id="'.$m.'" name="'.$m.'" placeholder="'.$m.'">';
	echo '<input type="text" id="'.$n.'" name="'.$n.'" placeholder="'.$n.'">';
	echo '<br>';
	echo '<input class="button" type="submit" name="submit_item" value="Submit">';
echo '</form>';


	/*echo '<select name="lead_time_days" id="lead_time_days">';
		foreach ($vendors as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['vendor_name'].'</option>';
		}
	echo '</select>';*/

//, description : description, stock_level : stock_level, lead_time_days : lead_time_days, preferred_vendor_id : preferred_vendor_id

?>

<!-- the result of the search will be rendered inside this div -->
<div id="result"></div>

<?php

//echo '<script src="http://continentalsecondshift.com/telescent/csslib/js/new_ajax.js"></script>';



echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />';
echo '<script src="http://code.jquery.com/jquery-1.9.1.js"></script>';
echo '<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>';



?>
<meta charset="utf-8">

<script type="text/javascript">
jQuery(document).ready(function ($) {
//$(document).ready(function() {
	var dates = $( "#datetime" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			var option = this.id == "datetime" ? "minDate" : "maxDate",
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
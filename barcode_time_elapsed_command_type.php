<?php
include_once("model_interface_css.php");
echo("<pre>");
$scanner_ids = array(11,15,88);


function calc_time_elapsed_and_barcode_command_type($scanner){
	// Get last calculated elapsed time for this scanner.
	$last_barcode_history_processed = css_get_last_barcode_time_elapsed_for_scanner($scanner);
	
	// Get some uncalculated data for this scanner.
	$barcode_data = css_get_new_barcode_history_for_scanner($scanner);
	
	// No calculated elapsed times yet, first call to function 
	if(empty($last_barcode_history_processed)){
		//echo("First barcode skipped");
		$elapsed_time = '-2'; //very first barcode data..
		$command_type_id = '-1'; //will get updated on the next function call
		css_update_barcode_history_elapsed_time_command_type($barcode_data[0]['id'], $elapsed_time, $command_type_id);
		calc_time_elapsed_and_barcode_command_type($scanner); // Call self, start the function over.
	}
	//print_r($last_barcode_history_processed);
	
	$barcode_commands = css_get_barcode_commands();
	//print_r($barcode_commands);
	
	$last_time = "";
	$command_type_id = "";
	foreach($barcode_data as $k => $v)
	{
		// Time Elapsed
		if($last_time == ""){
			$elapsed_time = strtotime($v['time_scanned']) - strtotime($last_barcode_history_processed[0]['time_scanned']);
		}else{
			$elapsed_time = strtotime($v['time_scanned']) - strtotime($last_time);
		}
		//echo("v");
		//print_r($v);
		
		//$command_id = array_search($v['barcode'], array_column($barcode_commands,'barcode'));
		$command_id = searchForId(str_replace("\n",'',$v['barcode']), $barcode_commands, 'barcode');
		//echo("barcode:");
		//echo($v['barcode']);
		//echo("Command_id:");
		//echo($command_id);
		//echo("OK");
			
		// Barcode Command Type
		//echo("<br>");
		//echo($v['barcode']." ".$v['barcode'][0]."<br>");
		
		if($v['barcode'][0] == "T")
		{
			$command_type_id = "2";
		}else{
			//$command_id = array_search($v['barcode'], array_column($barcode_commands,'barcode'));
			//echo($command_id);
			//echo("<br>");
			if($command_id == FALSE){
				$command_type_id = "9"; //unknown type of barcode
			}else{
				$command_type_id = $barcode_commands[$command_id]['command_type_id'];
				//echo($command_type_id);
				//echo("<br>");
			}
		}
		
		css_update_barcode_history_elapsed_time_command_type($v['id'], $elapsed_time, $command_type_id);
		$last_time = $v['time_scanned'];	
	}


}

function searchForId($id, $array, $column) {
	foreach ($array as $key => $val) {
		if ($val[$column] === $id) {
			return $key;
		}
	}
	return null;
}

foreach($scanner_ids as $scanner)
{
	calc_time_elapsed_and_barcode_command_type($scanner);
}

<?php
    
    include_once("db.inc.php");
	//include_once("graph_functions.php");
    
    // Query the db and return result as an array.
    function css_query($q, $dbnum=0){
    	$db = dbConnect($dbnum);
		$result = $db->query($q);
		$result_array = array();
		if($result){
			foreach ($result as $row){
				$result_array[] = $row;
			}
		}
		return $result_array;
		
	}

	// Similar to t1_query for inserts, but returns the ID of the newly inserted row
	function css_insert_return_id($q, $dbnum=0){
    	$db = dbConnect($dbnum);
		$stmt = $db->prepare($q);
		$stmt->execute();
		$new_id = $db->lastInsertId();
		return $new_id;
	}

	/* Attempt to get last inserted auto-increment id - wasn't working 
	function t1_last_insert_id()	{
		$q = "SELECT LAST_INSERT_ID()";
		return t1_query($q);
	} */
    
	
	function css_get_stages()
	{
		$q = "SELECT * FROM `status_stage`";
		return css_query($q);
	}

	function css_get_fiber_types()
	{
		$q = "SELECT * FROM `status_fiber_type`";
		return css_query($q);
	}
	
	/************ SPLICING *************/
	function css_get_splice_data()
	{
		//$q = "SELECT * FROM `status_splicer_data`";
		$q = "SELECT `id`, `datetime`, `min_since_last_splice`, `arc_count` FROM `status_splicer_data` WHERE `datetime` != '9999-12-31 23:59:59' ORDER BY `datetime` ASC";
		return css_query($q);
	}
	
	function css_get_last_splice_data_with_min_calc()
	{
		$q = "SELECT * FROM `status_splicer_data` WHERE `min_since_last_splice` > 0 ORDER BY `datetime` DESC LIMIT 1";
		return css_query($q);
	}
	
	function css_get_splice_data_without_min_calc()
	{
		$q = "SELECT * FROM `status_splicer_data` WHERE `min_since_last_splice` = 0 ORDER BY `datetime` ASC LIMIT 1000";
		return css_query($q);
	}
	
	function update_min_since_last_splice($id, $min_since_last_splice)
	{
		$q = "UPDATE `status_splicer_data` SET `min_since_last_splice` = '$min_since_last_splice' WHERE `id` = $id";
		return css_query($q);
	}	
	
	function css_get_new_splice_data()
	{
		$q = "SELECT * FROM `status_splicer_data` WHERE `datetime` = '9999-12-31 23:59:59' LIMIT 1000";
		return css_query($q);
	}
	
	function css_update_new_splice_data($id,$datetime)
	{
		$q = "UPDATE `status_splicer_data` SET `datetime` = '$datetime' WHERE `id` = $id";
		return css_query($q);
	}

	/************ STATUS - DAILY TALLY *************/

	function css_get_daily_tally()
	{
		$q = "SELECT * FROM `status_daily_tally`";
		return css_query($q);
	}

	function css_insert_daily_tally_new($b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n)
	{
		$q = "INSERT INTO `status_daily_tally` (`id`,`datetime`,`reels`,`wound`,`routed`,`prepared_inputs`,`spliced_inputs`,`finished_inputs`,`prepared_outputs`,`spliced_outputs`,`finished_outputs`,`tested`,`delivered`,`broken_reels`) 
				VALUES (NULL,'$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n')";
		echo $q;
		return css_query($q);

	}


	/************ STATUS - TRAYS *************/

	function css_insert_status_tray_new($b,$c,$d,$e,$f)
	{
		$q = "INSERT INTO `status_tray` (`id`,`tray_number`,`start_time`,`end_time`,`current_stage_id`,`fiber_type`) 
				VALUES (NULL,'$b','$c','$d','$e','$f')";
		//echo $q;
		return css_query($q);
	}


	function css_get_status_tray_stages()
	{
		$q = "SELECT * FROM `view_status_tray_stages` ORDER BY `stage_id` DESC";
		return css_query($q);
	}

	function css_get_status_tray_delivered()
	{
		$q = "SELECT * FROM `view_status_tray_stages` WHERE `stage_id` = '14'";
		return css_query($q);
	}

	function css_find_tray_by_number($b){
		$q = "SELECT * FROM `status_tray` WHERE `tray_number` = '$b'";
		return css_query($q);
	}

	function css_insert_status_tray_stages_new($b,$c,$d,$e,$f)
	{
		$q = "INSERT INTO `status_tray_stages` (`id`,`tray_id`,`stage_id`,`start_time`,`end_time`,`person_id`) 
				VALUES (NULL,'$b','$c','$d','$e','$f')";
		return css_query($q);
	}

	function get_fiber_type_for_tray_id($tray_id){
		$q = "SELECT `fiber_type` FROM `status_tray` WHERE `id` = '$tray_id'";
		$array = css_query($q);
		return $array[0]['fiber_type'];
	}


	/************ STATUS - MODULES *************/

	function css_get_status_tray_in_module()
	{
		$q = "SELECT * FROM `view_status_tray_stages` WHERE `stage_id` = '15'";
		return css_query($q);
	}

	function get_list_of_modules()
	{
		$q = "SELECT * FROM `status_module` WHERE `delivered` = 0";
		return css_query($q);
	}

	function css_assign_module_id_to_tray_id($tray_id, $module_id)
	{
		$q = "UPDATE `status_tray` SET `module_id` = $module_id WHERE `tray_id` = $tray_id";
		return css_query($q);
	}

	/************ INVENTORY ****************/
	function css_get_inv_item_list()
	{
		$q = "SELECT * FROM `inv_item` ORDER BY `preferred_vendor_id` ASC";
		return css_query($q);
	}

	function css_get_inv_item_list_by_fiber_type($sm_or_om4)
	{
		$q = "SELECT * FROM `inv_item` WHERE `sm_or_om4_only` = 0 OR `sm_or_om4_only` = $sm_or_om4 ORDER BY `preferred_vendor_id` ASC";
		return css_query($q);
	}

	function css_find_inv_item_by_id($id)
	{
		$q = "SELECT * FROM `inv_item` WHERE `id` = $id";
		return css_query($q);
	}

	function css_insert_inv_item($a,$b,$c,$d,$e,$f,$g)
	{
		$q = "INSERT INTO `inv_item` (`id`, `part_number`, `description`, `current_stock`, `per_tray`, `stock_level`, `lead_time_days`, `preferred_vendor_id`) 
				VALUES (NULL, '$a','$b','$c','$d','$e','$f','$g')";
		echo $q;
		return css_query($q);
	}

	function css_update_item_current_stock($item_id, $current_stock)
	{
		$q = "UPDATE `inv_item` SET `current_stock` = '$current_stock' WHERE `id` = '$item_id'";
		return css_query($q);
	}

	function css_item_current_stock_transaction($item_id, $transaction_amount)
	{
		$item_inv = css_find_inv_item_by_id($item_id);
		$new_stock = $item_inv[0]['current_stock'] + $transaction_amount;
		css_update_item_current_stock($item_id, $new_stock);
		return;
	}

	function add_or_remove_one_tray_worth_of_inventory($a_or_r, $sm_or_om4){
		$items = css_get_inv_item_list_by_fiber_type($sm_or_om4);
		foreach ($items as $key => $value) {
			$item_id = $value['id'];
			$transaction_amount = $a_or_r * $value['per_tray']; // $a_or_r is either -1 or +1 to add or remove.
			css_item_current_stock_transaction($item_id, $transaction_amount);
		}
		return;
	}

	function remove_one_tray_worth_of_inventory($sm_or_om4){
		add_or_remove_one_tray_worth_of_inventory(-1, $sm_or_om4);
		return;
	}

	function add_one_tray_worth_of_inventory($sm_or_om4){
		add_or_remove_one_tray_worth_of_inventory(1, $sm_or_om4);
		return;
	}

	function has_tray_been_wound($tray_id){
		//Check if tray has already been wound
		$q = "SELECT * FROM `view_status_tray_stages` WHERE `tray_id` = '$tray_id' AND `stage_id` = 4";
		$result = css_query($q);
		if(isset($result[0])){
			return 1; //tray already wound, inventory already removed.
		}else{
			return 0;
		}
		return 0;
	}

	function tray_wound($tray_id){
		$wound = has_tray_been_wound($tray_id);
		if($wound == 0){
			$sm_or_om4 = get_fiber_type_for_tray_id($tray_id);
			remove_one_tray_worth_of_inventory($sm_or_om4);
		}
		return;
	}



	/************ INVENTORY - VENDORS ****************/
	function css_get_inv_vendor_list()
	{
		$q = "SELECT * FROM `inv_vendor`";
		return css_query($q);
	}


	
	/************ BARCODES ****************/
	
	function css_get_barcode_command_type_ids()
	{
		$q = "SELECT * FROM `status_barcode_command_type`";
		return css_query($q);
	}
	
	function css_get_barcode_commands()
	{
		$q = "SELECT * FROM `status_barcode_commands`";
		return css_query($q);
	}
	
	function css_get_last_barcode_time_elapsed_for_scanner($scanner)
	{
		$q = "SELECT * FROM `status_barcode_history` WHERE `scanner_id` = '$scanner' AND `time_elapsed_sec` != '-1' ORDER BY `time_scanned` DESC LIMIT 1";
		return css_query($q);
	}
	
	function css_get_new_barcode_history_for_scanner($scanner)
	{
		$q = "SELECT * FROM `status_barcode_history` WHERE `scanner_id` = '$scanner' AND `time_elapsed_sec` = '-1' ORDER BY `time_scanned` ASC LIMIT 200";
		return css_query($q);
	}
	
	function css_update_barcode_history_elapsed_time_command_type($id, $elapsed_time, $command_type_id)
	{
		$q = "UPDATE `status_barcode_history` SET `time_elapsed_sec` = '$elapsed_time', `command_type_id` = '$command_type_id' WHERE `id` = $id";
		return css_query($q);
	}
	
	
	/******* VIEWS ******/
	function css_get_view_status_trays()
	{
		$q = "SELECT * FROM `view_status_tray`";
		return css_query($q);
	}
	
	
	
	












	/****** FROM SEWERS, KEEP FOR EXAMPLE

	function t1_print($printer_on, $print_this, $variable_name){
		if($printer_on == 1){
			echo "<pre>";
			echo $variable_name."<br>";
			print_r($print_this);
			echo "</pre>";	
		}
		return;
	}
	
	///////////////////////////////
	// Format time since a datetime ABREVIATED
	function t1_time_since_abrv($datetime){
		if($datetime == NULL){
			return "None yet";
		}
		$then = DateTime::createFromFormat('Y-m-d G:i:s', $datetime);
		//$then = strtotime($datetime);
		$now = DateTime::createFromFormat('Y-m-d G:i:s', date('Y-m-d G:i:s')); //time();
		$since = date_diff($then, $now);
		$time_str = ' ';
		//$time_str = $datetime.' ';
		//print_r($since);
		//print_r($since->d);
		//echo $since->format('%R%a days');
		$years = $since->format('%Y');
		$months = $since->format('%m');
		$days = $since->format('%d');
		$hours = $since->format('%h');
		$minutes = $since->format('%i');
		$seconds = $since->format('%s');
		
		if($years > 0){	
			return $time_str.$years.' years ';  
		}
		if($months > 0){	
			return $time_str.$months.' months ';  
		}
		if($days > 0){	
			return $time_str.$days.' days ';  
		}
		if($hours > 0){	
			return $time_str.$hours.' hours ';  
		}
		if($minutes > 0){	
			return $time_str.$minutes.' minutes ';  
		}
		if($time_str == ' '){
			return 'seconds ago';
		}
		return $time_str;
	}
*/
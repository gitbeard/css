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
		$q = "SELECT * FROM `stage`";
		return css_query($q);
	}
	
	
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


	/************INVENTORY****************/
	function css_get_inv_item_list()
	{
		$q = "SELECT * FROM `inv_item`";
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

	function css_update_item_current_stock($item_id,$current_stock)
	{
		$q = "UPDATE `inv_item` SET `current_stock` = '$current_stock' WHERE `id` = '$item_id'";
		return css_query($q);
	}




	/************INVENTORY - VENDORS****************/
	function css_get_inv_vendor_list()
	{
		$q = "SELECT * FROM `inv_vendor`";
		return css_query($q);
	}


	
	/************BARCODES****************/
	
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
	
	
	
	
	
	
	
	/* Everything below is sewer stuff, keep as example */
	
	function t1_get_user_default_site($user)
	{
		$q = "SELECT * FROM `user` WHERE `id` = $user->uid";
		return t1_query($q);
	}
	
	function t1_get_default_site($user)
	{
		$user_info = t1_get_user_default_site($user);
		return $user_info[0]['default_site_id'];
	}
	
	// Select site date - Get sites for user-client
	function t1_get_sites_for_user($user){
		$q = "SELECT * FROM view_user_client_site WHERE user_id = $user->uid AND site_status = 1";
		return t1_query($q);
	}
	
	// Select site date - Get sites for user-client
	function t1_get_sites_for_user_id($user_id){
		$q = "SELECT * FROM view_user_client_site WHERE user_id = $user_id AND site_status = 1";
		return t1_query($q);
	}

	// Get site info for this site_number
	function t1_get_site_info($site_id){
		$q = "SELECT * FROM `site` WHERE `id` = ".$site_id;
		return t1_query($q);
	}

	// Get unit info for this site_number
	function t1_get_unit_info_for_site($site_id){
		$q = "SELECT * FROM `view_unit_site_current` WHERE `id` = ".$site_id;
		return t1_query($q);
	}
	
	// Get unit info for all these sites
	function t1_get_units_for_sites($site_array){
		$units = array();
		foreach($site_array as $s){
			$units[] = t1_get_unit_info_for_site($s['site_id']);
		}
		return $units;
	}
    
	// Query the data for this unit and this timespan.
	function t1_get_all_data_for_unit($unit_serial){
		$q = "SELECT * FROM data_dau WHERE unit_serial = '$unit_serial' ORDER BY time_sent DESC";
		return t1_query($q);
	}
	
	// Query the data for this unit and this timespan.
	function t1_get_data_for_unit($unit_serial, $start_time, $stop_time){
		$q = "SELECT * FROM data_dau WHERE unit_serial = '$unit_serial' AND `time_sent` >= '$start_time' AND `time_sent` <= '$stop_time' ORDER BY time_sent ASC";
		return t1_query($q);
	}

	// Query the data for this unit and this timespan.
	function t1_get_data_bad_for_unit($unit_serial, $start_time, $stop_time){
		$q = "SELECT * FROM data_dau_bad_data WHERE unit_serial = '$unit_serial' AND `time_sent` >= '$start_time' AND `time_sent` <= '$stop_time' ORDER BY time_sent ASC";
		return t1_query($q);
	}

	// Query the data for this unit and this timespan.
	function t1_get_data_for_unit_sort_time_data($unit_serial, $start_time, $stop_time){
		$q = "SELECT * FROM data_dau WHERE unit_serial = '$unit_serial' AND `time_sent` >= '$start_time' AND `time_sent` <= '$stop_time' ORDER BY time_data ASC";
		return t1_query($q);
	}
	
	// Query the data for this unit and this timespan.
	function t1_get_latest_data_for_unit($unit_serial){
		$q = "SELECT * FROM data_dau WHERE unit_serial = '$unit_serial' ORDER BY data_dau.time_data DESC LIMIT 1";
		return t1_query($q);
		//$latest_data = t1_query($q);
		//return $latest_data[0];  //Fix this, everywhere this is called.
	}
	
	// Query the data for this unit and this timespan.
	function t1_get_latest_gps_for_unit($unit_serial){
		$q = "SELECT * FROM data_gps WHERE unit_serial = '$unit_serial' AND num_satellites > 0 ORDER BY data_gps.time_data DESC LIMIT 1";
		return t1_query($q); 
	}
	
	// Query the average level for this site, average level straight line on graph
	function t1_get_data_level_average($site_id){
		$q = "SELECT * FROM data_level_average WHERE site_id = '$site_id'";
		return t1_query($q);
	}


	// Get the clients this user has access to.
	function t1_get_clients_for_user($user)	{
		$q = "SELECT * FROM link_user_client WHERE user_id = $user->uid";
		return t1_query($q);
	}
	
	function t1_getClientInfo($client_id){
		$q="SELECT * FROM client WHERE id = ".$client_id;
		$r = t1_query($q);
		return $r[0];
	}
	

	/* ROSTER Stuff */
	function t1_get_rosters_for_client($client_id){
		$q = "SELECT * FROM roster WHERE client_id = $client_id";
		return t1_query($q);
	}

	function t1_view_crew_person_for_roster($crew_id){
		$q = "SELECT * FROM view_crew_person WHERE crew_id = $crew_id";
		return t1_query($q);
	}

	function t1_view_cluster_site_for_roster($cluster_id){
		$q = "SELECT * FROM view_cluster_site WHERE cluster_id = $cluster_id";
		return t1_query($q);	
	}

	function t1_get_person_by_id($person_id){
		$q = "SELECT * FROM person WHERE id = $person_id";
		return t1_query($q);
	}

	function t1_insert_person($first_name, $last_name, $phone_number, $email, $enable_phone, $enable_email){
		$q = "INSERT INTO person 
				SET	`first_name` = '$first_name',
					`last_name` = '$last_name',
					`phone_number` = '$phone_number',
					`email` = '$email',
					`enable_phone` = '$enable_phone',
					`enable_email` = '$enable_email'";
		return t1_insert_return_id($q); //return t1_query($q);
	}

	function t1_update_person_by_id($id, $first_name, $last_name, $phone_number, $email, $enable_phone, $enable_email){
		$q = "UPDATE person 
				SET	`first_name` = '$first_name',
					`last_name` = '$last_name',
					`phone_number` = '$phone_number',
					`email` = '$email',
					`enable_phone` = '$enable_phone',
					`enable_email` = '$enable_email'
				WHERE `id` = $id ";
		return t1_query($q);
	}

	function t1_insert_link_crew_person($person_id, $crew_id){
		$q = "INSERT INTO link_crew_person 
				SET	`person_id` = '$person_id',
					`crew_id` = '$crew_id'";
		return t1_query($q);
	}


	// Query the alarm events for this site and this timespan.
	function t1_get_alarms_for_site($site_id, $start_time, $stop_time){
		$q = "SELECT * FROM alarm_event WHERE site_id = $site_id AND `time_data` >= '$start_time' AND `time_data` <= '$stop_time' ORDER BY time_data ASC";
		return t1_query($q);
	}

	// Query the alarm events for this site and this timespan.
	function t1_get_all_alarms_for_site($site_id){
		$q = "SELECT * FROM alarm_event WHERE site_id = $site_id ORDER BY time_data ASC";
		return t1_query($q);
	}


	// Query the alarm events for all these sites
	function t1_get_alarms_for_sites($sites){
		$sites_list = 'site_id = '.$sites[0]['site_id'];
		if(count($sites) > 1){
			foreach ($sites as $key => $site) {
				$sites_list = $sites_list.' OR site_id = '.$site['site_id'];
			}
		}
		$q = "SELECT * FROM alarm_event WHERE $sites_list ORDER BY time_data DESC";
		return t1_query($q);
	}

	// Query the alarm events for all these sites, with details
	/*function t1_get_alarm_events_acks_users_for_sites($sites){
		$sites_list = 'site_id = '.$sites[0]['site_id'];
		if(count($sites) > 1){
			foreach ($sites as $key => $site) {
				$sites_list = $sites_list.' OR site_id = '.$site['site_id'];
			}
		}
		$q = "SELECT * FROM view_alarm_event_ack_user WHERE $sites_list ORDER BY time_data DESC";
		return t1_query($q);
	}*/

	// Query the alarm events for all these sites, with details
	function t1_get_alarm_events_for_sites($sites){
		$sites_list = 'site_id = '.$sites[0]['site_id'];
		if(count($sites) > 1){
			foreach ($sites as $key => $site) {
				$sites_list = $sites_list.' OR site_id = '.$site['site_id'];
			}
		}
		$q = "SELECT * FROM view_alarm_event_site WHERE $sites_list ORDER BY time_data DESC";
		return t1_query($q);
	}

	// Query the alarm acknowledgements and usernames, reduce this later!!
	function t1_get_alarm_ack_user(){
		$q = "SELECT * FROM view_alarm_ack_user ORDER BY alarm_event_id DESC";
		return t1_query($q);
	}
	
	// Get alarm_event count for this site
	function t1_get_alarm_count_for_site($site_id){
		$q = "SELECT COUNT(*) FROM `alarm_event` WHERE `site_id` = ".$site_id." AND `ack_time` = '2000-01-01 00:00:00'";		
		$r = t1_query($q);
		return $r; 
	}
	
	function t1_get_alarms_without_acks($site_id){
		$q = "SELECT * FROM alarm_event WHERE site_id = $site_id";
		$alarms = t1_query($q);
		$un_acked_alarms = array();
		foreach ($alarms as $key => $value) {
			$acks = t1_count_acks_for_alarm($value['id']);
			if($acks[0]['COUNT(*)'] == 0){
				$un_acked_alarms[] = $value;
			}
		}
		return $un_acked_alarms;
	}
	
  	function t1_count_acks_for_alarm($alarm_id){
  		$q = "SELECT COUNT(*) FROM `alarm_ack` WHERE `alarm_event_id` = ".$alarm_id;
		return t1_query($q);
  		
  	}
  
	function t1_update_slider_level($value, $unit_serial, $sensor_number){
		$q="UPDATE `alarm_settings` SET `threshold_value` = ".$value." WHERE `unit_serial` = '".$unit_serial."' AND `sensor_number` = ".$sensor_number;
		$r = t1_query($q);
		return;
	}
	
	
	/* FUNCTIONS FOR ultrasonic */
	function t1_get_ultrasonic_config($unit_id){
		$q = "SELECT * FROM ultrasonic_config WHERE unit_id = $unit_id AND end_ts = '9999-12-31 23:59:59' LIMIT 1";
		return t1_query($q);
	}
	
	
	
	/* FUNCTIONS FOR data_analyzer.php */
	// Select site date - Get sites for user-client
	function t1_get_all_sites(){
		$q = "SELECT * FROM view_unit_site_current";
		return t1_query($q);
	}
	
	function t1_get_latest_stat_date($unit_serial){
		$q = "SELECT * FROM data_daily_stats WHERE unit_serial = $unit_serial ORDER BY date DESC LIMIT 1";
		return t1_query($q);
	}
	
	function t1_get_all_stat_data($unit_serial){
		$q = "SELECT * FROM data_daily_stats WHERE unit_serial = $unit_serial ORDER BY date DESC";
		return t1_query($q);
	}
	
	// Query the stat data for this unit and this timespan.
	function t1_get_stat_data($unit_serial, $start_time, $stop_time){
		$q = "SELECT * FROM data_daily_stats WHERE unit_serial = $unit_serial AND `date` >= '$start_time' AND `date` <= '$stop_time' ORDER BY date ASC";
		return t1_query($q);
	}
		
	// Get oldest data point for unit
	function t1_get_oldest_data_for_unit($unit_serial){
		$q = "SELECT * FROM data_dau WHERE unit_serial = '$unit_serial' ORDER BY time_sent ASC LIMIT 1";
		return t1_query($q);
	}
	
	// Query the data for this unit and this timespan.
	function t1_get_days_data($unit_serial, $date){
		$start_time = $date.' 00:00:00';
		$stop_time = $date.' 23:59:59';
		$q = "SELECT * FROM data_dau WHERE unit_serial = '$unit_serial' AND `time_data` >= '$start_time' AND `time_data` <= '$stop_time' ORDER BY time_sent ASC";
		return t1_query($q);
	}
	
	function t1_insert_data_stats($date, $unit_serial, $sensor_number, $min, $max, $avg, $count){
		$q = "INSERT INTO data_daily_stats (`id`, `date`, `unit_serial`, `sensor_number`, `min`, `max`, `avg`, `count`) 
					VALUES ('', '".$date."', '".$unit_serial."', '".$sensor_number."', '".$min."', '".$max."', '".$avg."', '".$count."')";
		return t1_query($q);
	}
	
	/*
	 * Insert Flow data
	 */
	function t1_insert_flow_data_old($time_data, $unit_serial, $sensor_number, $ultrasonic_reading, $level, $theta, $cross_area, $hyd_rad, $flow, $GPM_instant, $GPM_average_last_point, $gallons_last_point, $minutes_last_point){
		$q = "INSERT INTO data_flow (`id`, `time_data`, `unit_serial`, `sensor_number`, `sensor_reading`, `level`, `theta`, `cross_area`, `hydraulic_radius`, `flow_cubic_in_per_sec`, `GPM_instant`, `GPM_avg_last_point`, `gallons_last_point`, `minutes_last_point`)
					VALUES ('','".$time_data."', '".$unit_serial."', '".$sensor_number."', '".$ultrasonic_reading."', '".$level."', '".$theta."', '".$cross_area."', '".$hyd_rad."', '".$flow."', '".$GPM_instant."', '".$GPM_average_last_point."', '".$gallons_last_point."', '".$minutes_last_point."')";
		return t1_query($q);
	}
	
	function t1_insert_flow_data($time_data, $unit_serial, $sensor_number, $ultrasonic_reading, $level, $theta, $cross_area, $hyd_rad, $velocity, $flow, $GPM_instant, $GPM_average_last_point, $gallons_last_point, $minutes_last_point){
		$q = "INSERT INTO data_flow (`id`, `time_data`, `export_time`, `exported`, `unit_serial`, `sensor_number`, `sensor_reading`, `level`, `theta`, `cross_area`, `hydraulic_radius`, `velocity_fps`, `flow_cubic_in_per_sec`, `GPM_instant`, `GPM_avg_last_point`, `gallons_last_point`, `minutes_last_point`)
					VALUES ('','"	
							.$time_data."', '"
							."9999-12-31 23:23:59"."', '"
							."0"."', '"
							.$unit_serial."', '"
							.$sensor_number."', '"
							.$ultrasonic_reading."', '"
							.$level."', '"
							.$theta."', '"
							.$cross_area."', '"
							.$hyd_rad."', '"
							.$velocity."', '"
							.$flow."', '"
							.$GPM_instant."', '"
							.$GPM_average_last_point."', '"
							.$gallons_last_point."', '"
							.$minutes_last_point."')";
		//echo($q);
		return t1_query($q);
	}
	
	
	function t1_get_distinct_units_data_flow(){
		$q = "SELECT DISTINCT `unit_serial` FROM data_flow";
		return t1_query($q);	
	}
	
	function t1_get_data_flow($serial){
		$q = "SELECT * FROM data_flow WHERE `unit_serial` = '$serial' ORDER BY `time_data` ASC";
		return t1_query($q);
	}

	function t1_get_data_flow_since($serial, $date){
		$q = "SELECT * FROM data_flow WHERE `unit_serial` = '$serial' AND time_data >= '$date' ORDER BY `time_data` ASC";
		return t1_query($q);
	}

	function t1_get_latest_calculated_data_flow_date($unit_serial){
		$q = "SELECT * FROM data_flow WHERE unit_serial = '$unit_serial' AND minutes_last_point != -1 ORDER BY time_data DESC LIMIT 1";
		return t1_query($q);
	}
	
	function t1_update_data_flow($id, $GPM_avg_last_point, $gallons_last_point, $minutes_last_point){
		$q = "UPDATE `data_flow` SET `GPM_avg_last_point` = ".$GPM_avg_last_point.", `gallons_last_point` = ".$gallons_last_point.", minutes_last_point = ".$minutes_last_point." WHERE `id` = ".$id;
		//$q = "UPDATE `data_flow` SET (`GPM_avg_last_point`, `gallons_last_point`, minutes_last_point) = VALUES (".$GPM_avg_last_point.", ".$gallons_last_point.", ".$minutes_last_point.") WHERE `id` = ".$id;
		return t1_query($q);
	}
	
	function t1_get_latest_flow_date($unit_serial){
		$q = "SELECT * FROM data_flow WHERE unit_serial = '$unit_serial' ORDER BY time_data DESC LIMIT 1";
		return t1_query($q);
	}
	
	function t1_get_latest_flow_totals_date($unit_serial){
		$q = "SELECT * FROM data_flow_totals WHERE unit_serial = '$unit_serial' ORDER BY date DESC LIMIT 1";
		return t1_query($q);
	}
	
	function t1_get_oldest_data_flow_for_unit($unit_serial){
		$q = "SELECT * FROM data_flow WHERE unit_serial = '$unit_serial' ORDER BY time_data ASC LIMIT 1";
		return t1_query($q);
	}
	
	function t1_get_days_data_flow($unit_serial, $date){
		$start_time = $date.' 00:00:00';
		$stop_time = $date.' 23:59:59';
		$q = "SELECT * FROM data_flow WHERE unit_serial = '$unit_serial' AND `time_data` >= '$start_time' AND `time_data` <= '$stop_time' ORDER BY time_data ASC";
		return t1_query($q);
	}
	
	function t1_get_data_flow_totals($serial){
		$q = "SELECT * FROM data_flow_totals WHERE `unit_serial` = '".$serial."' ORDER BY `date` ASC";
		return t1_query($q);
	}

	function t1_get_dates_flow_totals($start){
		$q = "SELECT * FROM data_flow_totals WHERE `date` >= '$start'";
		return t1_query($q);
	}

	function t1_get_flow_totals_unit_dates($serial, $start){
		$q = "SELECT * FROM data_flow_totals WHERE `unit_serial` = '$serial' AND `date` >= '$start' ORDER BY `date` ASC";
		return t1_query($q);
	}
	
	function t1_insert_data_flow_totals($date, $unit_serial, $sen, $minGPM, $maxGPM, $GPM_avg, $gallon_sum, $msg_count){
		$q = "INSERT INTO data_flow_totals (`id`, `date`, `unit_serial`, `sensor_number`, `GPM_min`, `GPM_max`, `GPM_avg`, `gallons_total`, `msg_count`) 
					VALUES ('', '".$date."', '".$unit_serial."', '".$sen."', '".$minGPM."', '".$maxGPM."', '".$GPM_avg."', '".$gallon_sum."', '".$msg_count."')";
		return t1_query($q);
	}

	function t1_prepare_totals_not_exported_this_unit($unit_serial){
		$q = "UPDATE `data_flow_totals` SET `exported` = '999' WHERE `unit_serial` = '$unit_serial' AND `exported` = '0'";
		return t1_query($q);
	}
	
	function t1_get_totals_not_exported_this_unit($unit_serial){
		$q = "SELECT * FROM `data_flow_totals` WHERE `unit_serial` = '$unit_serial' AND `exported` = '999'";
		return t1_query($q);
	}

	function t1_confirm_totals_exported(){
		$q = "UPDATE `data_flow_totals` SET `exported` = '1' WHERE `exported` = '999'";
		return t1_query($q);
	}

	function t1_prepare_lev_vel_flo_not_exported_this_unit($unit_serial){
		$q = "UPDATE `data_flow` SET `exported` = '999' WHERE `unit_serial` = '$unit_serial' AND `exported` = '0'";
		return t1_query($q);
	}
	
	function t1_get_lev_vel_flo_not_exported_this_unit($unit_serial){
		$q = "SELECT * FROM `data_flow` WHERE `unit_serial` = '$unit_serial' AND `exported` = '999'";
		return t1_query($q);
	}

	function t1_confirm_lev_vel_flo_exported(){
		$q = "UPDATE `data_flow` SET `exported` = '1' WHERE `exported` = '999'";
		return t1_query($q);
	}

	function t1_print($printer_on, $print_this, $variable_name){
		if($printer_on == 1){
			echo "<pre>";
			echo $variable_name."<br>";
			print_r($print_this);
			echo "</pre>";	
		}
		return;
	}
	
	function t1_get_alarm_ack_for_event($this_alarm_event_id){
		$q = "SELECT * FROM alarm_ack WHERE alarm_event_id = $this_alarm_event_id";
		return t1_query($q);
	}
	
	function t1_update_alarm_event_ack_time($this_alarm_event_id, $ack_time){
		$q= "UPDATE `alarm_event` SET `ack_time` = '".$ack_time."' WHERE `id` = ".$this_alarm_event_id;
		return t1_query($q);
	}
	
  	// Insert for Acknowledge button, insert into `alarm_ack` table
  	function t1_insert_alarm_ack($alarm_event_id, $user_id, $user_ack_time, $user_note){
  		$q = "INSERT INTO alarm_ack (`id`, `alarm_event_id`, `user_id`, `user_ack_time`, `user_note`)
  					VALUES ('', '".$alarm_event_id."', '".$user_id."', '".$user_ack_time."', '".$user_note."')";
		return t1_query($q);
  	}
    
  
  	////////////////////////////
	// Format GPS data for static maps
	function t1_for_static($gps_info)
	{
		$gps_array = array();
		foreach($gps_info as $g_info)
		{
			$n['north'] = $g_info['north'];
			$n['west'] = $g_info['west'];
			$n['unit_serial'] = $g_info['unit_serial'];
			$gps_array[] = $n;
		}
		return $gps_array;
	}
	
	///////////////////////////////
	// Format time since a datetime
	function t1_time_since($datetime){
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
			$time_str = $time_str.$years.' years ';  
		}
		if($months > 0){	
			$time_str = $time_str.$months.' months ';  
		}
		if($days > 0){	
			$time_str = $time_str.$days.' days ';  
		}
		if($hours > 0){	
			$time_str = $time_str.$hours.' hours ';  
		}
		if($minutes > 0){	
			$time_str = $time_str.$minutes.' minutes ';  
		}
		if($time_str == ' '){
			$time_str = 'seconds ago';
		}
		/*if($seconds > 0){	
			$time_str = $time_str.$seconds.' seconds ';  
		}*/ //No seconds in time_data so not worth it.
		return $time_str;
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
	
	
	
	
	
	///////////////////////
	// Functions for pictures
	// Select site date - Get sites for user-client
	function t1_get_site_images($site_id){
		$q = "SELECT * FROM site_images WHERE site_id = $site_id";
		return t1_query($q);
	}
	
	
	
	
	
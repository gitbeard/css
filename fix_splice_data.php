
<?php

include_once("model_interface_css.php");

$splice_data = css_get_new_splice_data();

foreach($splice_data as $k => $v){
	$datetime = $v['date'].' '.$v['time'];
	css_update_new_splice_data($v['id'],$datetime);
}




$last_point_calculated = css_get_last_splice_data_with_min_calc();
//print_r($last_point_calculated);
$need_to_calculate_min_since = css_get_splice_data_without_min_calc();

$time_of_last_splice = $last_point_calculated[0]['datetime'];
foreach($need_to_calculate_min_since as $k => $v)
{
	$min_since_last_splice = (strtotime($v['datetime']) - strtotime($time_of_last_splice))/60;
	update_min_since_last_splice($v['id'], $min_since_last_splice);
	
	$time_of_last_splice = $v['datetime'];

}
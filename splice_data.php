
<?php

include_once("model_interface_css.php");

$splice_data = css_get_splice_data();
echo "<pre>";
//print_r($splice_data);

/*
$points = '';
foreach ($splice_data as $k => $v){
	$time = $v['datetime'];
	$time = (strtotime($time) * 1000);
	$points = $points.'['.$time.','.$v['arc_count'].'],';
}
echo $points;


<script src="target1lib/js/gray.js"></script>
*/


?>

<div class="levels" style="height:1000px;padding-top:5px;padding-bottom:5px;">
<div id="container" style="width:150%; height:1000px; position: absolute; left:-25%;">  Graph Loading... </div>
<script type="text/javascript" src="http://www.uziemac.com/aerogrid/aerolib/js/jquery.js"></script>
<script type="text/javascript" src="http://www.uziemac.com/aerogrid/aerolib/js/highstock.js"></script>


<script type="text/javascript">
		$(function() {
		$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=new-intraday.json&callback=?', function(data) {

		// create the chart
		$('#container').highcharts('StockChart', {
			title: {
				text: 'Sensors'
			},
			xAxis: {
				gapGridLineWidth: 0
			},
			series: [
			{
			type: 'column',
			name: 'Level (in)',
			data: [ <?php
						$points = '';
						foreach ($splice_data as $k => $v){
							$time = $v['datetime'];
							$time = (strtotime($time) * 1000) - 21600000;
							$min_since_last_splice = $v['min_since_last_splice'];
							if($min_since_last_splice < 15){
								//$min_since_last_splice = 0;
								$points = $points.'['.$time.','.$min_since_last_splice.'],';
							}
							
						}
						echo $points;
					?>  ]
			}]
		});
	});
});
	
</script>
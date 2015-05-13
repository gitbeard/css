$(function() {
    $(".button").click(function() {
      // validate and process form here


    var part_number = $("input#part_number").val();
	var description = $("input#description").val();
	var stock_level = $("input#stock_level").val();
	var lead_time_days = $("input#lead_time_days").val();
	var preferred_vendor_id = $("input#preferred_vendor_id").val();

    var dataString = 'part_number='+ part_number +
						'&description='+ description +
						'&stock_level='+ stock_level +
						'&lead_time_days='+ lead_time_days +
						'&preferred_vendor_id='+ preferred_vendor_id;


	
	//alert (dataString);return false;
	$.ajax({
	type: "POST",
	url: "http://continentalsecondshift.com/telescent/csslib/form_process_inv_item_new.php",
	data: dataString,
	success: function() {
	  $('#result').html("<div id='message'></div>");
	  $('#message').html("<h2>Item Added!</h2>")
	  .append("<p>Wow.</p>")
	  .hide()
	  .fadeIn(1500, function() {
	    $('#message').append("<h2>Cool!</h2>");
	  });
	}
	});
	return false;  

	});
});
jQuery(function() {
    jQuery(".button").click(function() {
      // validate and process form here

	var tray_number = jQuery(this).attr('name');
    var stage_id = jQuery(this).attr('id');

    var dataString = 'tray_number='+ tray_number +
						'&stage_id='+ stage_id;

	//alert(dataString);


	jQuery.ajax({
		type: "POST",
		//url: "http://continentalsecondshift.com/telescent/csslib/form_process_inv_item_new.php",
		url: "http://continentalsecondshift.com/telescent/csslib/form_process_status_tray_stages_new.php",
		data: dataString,
		success: function() {
		  jQuery('#result').html("<div id='message'></div>");
		  jQuery('#message').html("<h2>Stage Complete!</h2>")
		  .append("<p>Wow.</p>")
		  .hide()
		  .fadeIn(1500, function() {
		    jQuery('#message').append("<h2>Cool!</h2>");
		  });
		}
	});
	

	return false; 

	});
});
// Variable to hold request
var request;

// Bind to the submit event of our form
$(".button").click(function(event){

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    //var $form = $(this);
    var $butt = $(this);
    // Let's select and cache all the fields
    //var $inputs = $form.find("input, select, button, textarea");

    var tray_id = jQuery(this).attr('name');
    var stage_id = jQuery(this).attr('id');

    var dataString = 'tray_id='+ tray_id +
                        '&stage_id='+ stage_id;

    console.log(dataString);

    // Serialize the data in the form
    //var serializedData = $form.serialize();
    //console.log(serializedData);
    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    //$inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "http://continentalsecondshift.com/telescent/csslib/form_process_status_tray_stages_new.php",
        type: "post",
        data: dataString,
        success: function(msg){
                    //$('#result').html(msg); //If you want to display messages in the result div
                    $butt.replaceWith(msg);
                }
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log(dataString);
        console.log("Hooray, it worked!");
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    //request.always(function () {
        // Reenable the inputs
        //$inputs.prop("disabled", false);
    //});

    // Prevent default posting of form
    event.preventDefault();
});
<?php

 // <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


include_once("model_interface_css.php");
$inv_item_list = css_get_inv_item_list();


$form_process_location = "?q=node/7"; ///csslib/form_process_inv_item_new.php";
$form_method = "POST";
 
echo '<form action="'.$form_process_location.'" id="searchForm" method="'.$form_method.'">';

  //Inputs
  echo '<input type="text" name="id" placeholder="id">';
  echo '<br>';
  echo '<input type="text" name="part_number" placeholder="part_number">';
  echo '<input type="text" name="description" placeholder="description">';
  echo '<input type="text" name="stock_level" placeholder="stock_level">';
  echo '<input type="text" name="lead_time_days" placeholder="lead_time_days">';
  echo '<input type="text" name="preferred_vendor_id" placeholder="preferred_vendor_id">';
  



  echo '<input type="submit" name="submit_item" value="Submit">';
echo '</form>';
?>

<!-- the result of the search will be rendered inside this div -->
<div id="result"></div>
 
<script>
// Attach a submit handler to the form
$( "#searchForm" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = $( this ),
    term = $form.find( "input[name='s']" ).val(),
    url = $form.attr( "action" );
 
  // Send the data using post
  var posting = $.post( url, { s: term } );
 
  // Put the results in a div
  posting.done(function( data ) {
    var content = $( data ).find( "#content" );
    $( "#result" ).empty().append( content );
  });
});
</script>
 
</body>
</html>
<?php
include_once("model_interface_css.php");

if(isset($_POST['add']))
{
	add_one_tray_worth_of_inventory(); 
}
elseif(isset($_POST['remove']))
{
	remove_one_tray_worth_of_inventory(); 
}

header("Location: http://continentalsecondshift.com/telescent/?q=inv_list_quick");
<?php
include_once("model_interface_css.php");

if(isset($_POST['add-SM']))
{
	add_one_tray_worth_of_inventory(1);
}
elseif(isset($_POST['add-OM4']))
{
	add_one_tray_worth_of_inventory(4);
}
elseif(isset($_POST['remove-SM']))
{
	remove_one_tray_worth_of_inventory(1);
}
elseif(isset($_POST['remove-OM4']))
{
	remove_one_tray_worth_of_inventory(4);
}

header("Location: http://continentalsecondshift.com/telescent/?q=inv_list_quick");
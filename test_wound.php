<?php
//Testing
include_once("model_interface_css.php");

/*
echo "Tray 207";
echo "<br>";
echo has_tray_been_wound(24);
echo "<br>";
echo "Tray 208";
echo has_tray_been_wound(25);
*/
echo "Tray 207";
echo "<br>";
tray_wound(24);
echo "<br>";
echo has_tray_been_wound(25);
echo "<br>";
echo "Tray 208";
echo "<br>";
tray_wound(25);
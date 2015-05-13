<?php

//////////////////
// DB connection
//////////////////
define("DBSERVER", "localhost");  // Or "box703.bluehost.com";
define("DBNAME", "jimmydud_css");
//define("DBNAME2", "uziemacc_target1");
define("DBUSER", "jimmydud_e");
define("DBPASSW", "[jimg15]");

try 
{
	$db = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASSW);
//	$db2 = new PDO('mysql:host=localhost;dbname='.DBNAME2, DBUSER, DBPASSW);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//	$db2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $ex) 
{
	echo 'Connection failed: ' . $ex->getMessage();
}

function dbConnect($dbnumber=0){
	$dbs[] = DBNAME;
//	$dbs[] = DBNAME2;
	$dbname = $dbs[$dbnumber];
	$dbc = new PDO('mysql:host=localhost;dbname='.$dbname, DBUSER, DBPASSW);
	$dbc->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $dbc;
}

/*  OLD WAY
function dbConnect(){
	$db = mysql_connect(DBSERVER, DBUSER, DBPASSW) or die('Could not connect: ' . mysql_error());
    mysql_select_db(DBNAME) or die('Could not select database');
    return $db;}
dbConnect();*/
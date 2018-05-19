<?php
define("DEBUG_ENABLE",TRUE,TRUE);
if(DEBUG_ENABLE)
{
	ini_set('display_errors','1');
	error_reporting(E_ALL ^ E_NOTICE);
}
else
{
	ini_set('display_errors','0');
	error_reporting(E_ALL ^ E_NOTICE);
}

define("DBHOST","localhost",TRUE);
define("DBPORT",3306,TRUE);
define("DBNAME","db_hrmis_11",TRUE);
define("DBUSERNAME","root",TRUE);
define("DBPASSWORD","masterpogi",TRUE);

date_default_timezone_set("Asia/Manila");
?>
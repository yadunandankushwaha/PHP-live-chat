<?php
/***********************************************************************************************************
*/

//Database Connection Settings
define ('hostnameorservername','localhost'); //Your server or host name goes in here
define ('serverusername','root'); // Your database Username goes in here
define ('serverpassword',''); // Your database Password goes in here
define ('databasenamed','livechat'); // Your Database Name goes in here
error_reporting(0);
global $connection;
$connection = @mysql_connect(hostnameorservername,serverusername,serverpassword) or die('Connection could not be made to the SQL Server.');
@mysql_select_db(databasenamed,$connection) or die('Connection could not be made to the database.');	
?>

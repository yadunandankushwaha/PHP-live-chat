<?php

include "config.php"; //Include the database connection settings page

if(isset($_POST["user_from"]) && isset($_POST["user_to"]) && !empty($_POST["user_from"]) && !empty($_POST["user_to"])) 
{
	//$check_info_brought = mysql_query("select * from `chat` where `to` = '".mysql_real_escape_string($_POST["user_to"])."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."'  and `receiver_deleted` = '".mysql_real_escape_string("no")."' || `to` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `from` = '".mysql_real_escape_string($_POST["user_to"])."' and `sender_deleted` = '".mysql_real_escape_string("no")."'");
	
	mysql_query("delete from `chat_vpb_online_users` where `username` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."'");
	
	$check_info_brought = mysql_query("select * from `chat` where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `receiver_deleted` = '".mysql_real_escape_string("no")."' || `to` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `sender_deleted` = '".mysql_real_escape_string("no")."'"); 
	
	if(mysql_num_rows($check_info_brought) > 0) 
	{
		mysql_query("update `chat` set `receiver_deleted` = '".mysql_real_escape_string("yes")."' where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."'  and `receiver_deleted` = '".mysql_real_escape_string("no")."'"); 
		
		mysql_query("update `chat` set `receiver_read` = '".mysql_real_escape_string("yes")."' where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."'  and `receiver_read` = '".mysql_real_escape_string("no")."'"); 
		
		mysql_query("update `chat` set `sender_deleted` = '".mysql_real_escape_string("yes")."' where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `sender_deleted` = '".mysql_real_escape_string("no")."'");
   }
   else 
   {
	   //mysql_query("delete from `chat` where `to` = '".mysql_real_escape_string($_POST["user_to"])."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."'  and `deleted` = '".mysql_real_escape_string("yes")."'");
	   
	   //mysql_query("delete from `chat` where `to` = '".mysql_real_escape_string($_POST["user_from"])."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."'  and `deleted` = '".mysql_real_escape_string("yes")."'");
   }
}
?>
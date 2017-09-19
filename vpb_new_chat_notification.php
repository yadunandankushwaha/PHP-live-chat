<?php

include "config.php"; //Include the database connection settings page

function nformatnamdesn($name=NULL) 
{
	if (empty($name))
		return false;
	$name = strtolower($name);
	$names_array = explode('-',$name);
	for ($i = 0; $i < count($names_array); $i++) {	
		if (strncmp($names_array[$i],'mc',2) == 0 || preg_match('/^[oO]\'[a-zA-Z]/',$names_array[$i])) 
		{
			$names_array[$i][2] = strtoupper($names_array[$i][2]);
		}
		$names_array[$i] = ucfirst($names_array[$i]);
	}
	$name = implode('-',$names_array);
	return ucwords($name);
}

if(isset($_POST["user_to"]) && !empty($_POST["user_to"]))
{
	$result = mysql_query("select * from `chat` where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `receiver_read` = '".mysql_real_escape_string("no")."' order by `id` asc limit 1");
	
   if(mysql_num_rows($result) > 0)
   {
	   $getDromUsername = mysql_fetch_array($result);
	   $check_users_fullnames = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string(strip_tags($getDromUsername["from"]))."'"); 
	   $get_users_fullnames = mysql_fetch_array($check_users_fullnames);
	   setcookie("chat_notification_username", strip_tags($get_users_fullnames["username"]));
	   ?>
       <a href="javascript:void(0);" onclick="startNewChatEstablishment('<?php echo strip_tags($get_users_fullnames["username"]); ?>','<?php echo nformatnamdesn(strip_tags($get_users_fullnames["fullname"])); ?>');" id="" class="vasplus_tooltips"><img src="chat_application/smileys/notice.gif" style="margin-top:5px;" border="0" align="absmiddle" /><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">New chat from <b><?php echo nformatnamdesn(strip_tags($get_users_fullnames["fullname"])); ?></b></span></a>
       <?php
   }
   else
   {
	   echo "";
   }
}
?>
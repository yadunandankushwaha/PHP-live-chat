<?php

include "config.php"; //Include the database connection settings page

if(isset($_POST["username"]) && !empty($_POST["username"])) //Be sure that there is a valid session created for user photo check
{
	$check_usersPic = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string(strip_tags($_POST["username"]))."'");
	$get_userPic = mysql_fetch_array($check_usersPic); 
	if(empty($get_userPic["photo"]))
	{
		$userPic = "avatar.gif"; 
	} 
	else 
	{
		$userPic = strip_tags($get_userPic["photo"]); 
	} 
	echo "<span class='nprofileimg'><a href='javascript:void(0);'><img src='chat_application/photos/".$userPic."' alt='".strip_tags($get_userPic["fullname"])."' title='".strip_tags($get_userPic["fullname"])."' border='0' style='width:100px;height:90px;'></a></span>"; 
}
else
{
	//No valid session username brought therefore, show the default users avatar
	echo "<span class='nprofileimg'><a href='javascript:void(0);'><img src='chat_application/photos/avatar.gif' alt='' title='' border='0' style='width:100px;height:90px;'></a></span>";
}
?>
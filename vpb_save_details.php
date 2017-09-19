<?php

include "config.php"; //Include the database connection settings page

function nformatnamde($name=NULL) 
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

if(isset($_POST["page"]) && !empty($_POST["page"])) //Page validation
{
	if($_POST["page"] == "signup") //This is where the sign up functionality code starts
	{
		$usernameds = strip_tags(strtolower($_POST["usernames"])); 
		$passd = strip_tags($_POST["passs"]); 
		$encryptedPassword = md5($passd); 
		
		if(strlen($usernameds) < 5) 
		{
			echo "<div class='info'>Sorry, your username must not be less than 5 characters in length please. Thanks.</div>";
		} 
		else if(preg_match('/[^A-Za-z0-9]/', $usernameds)) 
		{
			echo "<div class='info'>Sorry, <font color='blue'>".$usernameds."</font> is not in the proper format for a username. <br>Username should only contain letters and numbers.<br>Example formats: <font color='blue'>comfort</font>, <font color='blue'>victor18</font>, <font color='blue'>chuks29</font>, <font color='blue'>lemdy</font>, <font color='blue'>joyce</font>, <font color='blue'>prisca</font>, <font color='blue'>ibrahim</font>, <font color='blue'>Ahmad</font> etc</div>"; 
		} 
		else if(!$checkuname = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string($usernameds)."'")) 
		{
			echo "<div class='info'>Sorry, your username could not be verified at the moment.<br>Please try again or contact the site admin to report the error if this problem persist. Thanks.</div>"; 
		} 
		else if(mysql_num_rows($checkuname) > 0) 
		{
			echo "<div class='info'>Sorry, the username <font color='blue'>".$usernameds."</font> has already been taken by someone else. Please enter a different username. Thanks.</div>"; 
		}
		else 
		{
			if(mysql_query("insert into `chat_vpb_users` values('', '".mysql_real_escape_string(nformatnamde(strip_tags($_POST['fullnames'])))."', '".mysql_real_escape_string($usernameds)."', '".mysql_real_escape_string($encryptedPassword)."', '', '".mysql_real_escape_string(date("d-m-Y"))."')")) 
			{
				$check_users_online = mysql_query("select * from `chat_vpb_online_users` where `username` = '".mysql_real_escape_string($usernameds)."'");
				if(mysql_num_rows($check_users_online) > 0) { } 
				else 
				{
					mysql_query("insert into `chat_vpb_online_users` values('', '".mysql_real_escape_string($usernameds)."')"); 
				}
				setcookie("fullnames", nformatnamde(strip_tags($_POST['fullnames']))); 
				
				echo "operation_process_is_completed"; 
			} 
		} 
	} 
	else if($_POST["page"] == "login") //This is where the login page functionality starts
	{
		$usernameds = trim(strip_tags(strtolower($_POST["usernamel"]))); 
		$cleanPassword = trim(strip_tags($_POST["passl"])); 
		$passwordl = md5($cleanPassword);
		
		$checkUserBothDetails = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string($usernameds)."' and `password` = '".mysql_real_escape_string($passwordl)."'");
		
		$checkUsername = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string($usernameds)."'");
		$checkUserpassword = mysql_query("select * from `chat_vpb_users` where `password` = '".mysql_real_escape_string($passwordl)."'");
		
		if(mysql_num_rows($checkUsername) > 0 && mysql_num_rows($checkUserpassword) < 1)
		{
			 echo "<div class='info'>Sorry, your username is correct but your password is incorrect. Please try again Thanks.</div>"; 
		}
		else if(mysql_num_rows($checkUserpassword) > 0 && mysql_num_rows($checkUsername) < 1) 
		{
			 echo "<div class='info'>Sorry, your password is correct but your username does not exist on this system. <br>Please try again if you already have an account on this system or sign up if you do not. Thanks.</div>";
		}
		else if(mysql_num_rows($checkUserBothDetails) != 1)
		{
			 echo "<div class='info'>Sorry, both your username and password are incorrect. <br>Please try again if you truly have an account on this website or sign up if you do not. Thanks.</div>"; 
		} 
		else
		{
			$check_users_online = mysql_query("select * from `chat_vpb_online_users` where `username` = '".mysql_real_escape_string($usernameds)."'");
		    
			if(mysql_num_rows($check_users_online) > 0) { }
		    else 
			{
				mysql_query("insert into `chat_vpb_online_users` values('', '".mysql_real_escape_string($usernameds)."')"); 
			}
			
			$checkFullname = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string($usernameds)."'");
			
			$getFullname = mysql_fetch_array($checkFullname); 
			setcookie("fullnames", nformatnamde(strip_tags($getFullname["fullname"]))); 
			
			echo "operation_process_is_completed"; 
		} 
	} 
	else 
	{
		echo "<div class='info'>Sorry, the operation was unsuccessful. (1)<br>Please try again or contact the site admin to report this error if the problem persist. Thanks.</div>"; 
	} 
} 
else 
{
	echo "<div class='info'>Sorry, the operation was unsuccessful. (2)<br>Please try again or contact the site admin to report this error if the problem persist. Thanks.</div>"; 
}
?>
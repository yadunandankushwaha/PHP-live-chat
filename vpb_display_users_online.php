<ul>
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

if(isset($_COOKIE["usernames"]))
{
	$check_users_online = mysql_query("select * from `chat_vpb_online_users` where `username` != '".mysql_real_escape_string(strip_tags($_COOKIE["usernames"]))."'");
	
	if(mysql_num_rows($check_users_online) > 0) 
	{
		while($get_users_online = mysql_fetch_array($check_users_online)) 
		{
			$check_users_fullnames = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string(strip_tags($get_users_online["username"]))."'"); 
			
			while($get_users_fullnames = mysql_fetch_array($check_users_fullnames)) 
			{
				?>
				<li>
				<a href="javascript:void(0);" onclick="startNewChatEstablishment('<?php echo strip_tags($get_users_fullnames["username"]); ?>','<?php echo nformatnamdesn(strip_tags($get_users_fullnames["fullname"])); ?>');"><?php echo nformatnamdesn(strip_tags($get_users_fullnames["fullname"])); ?>
				</a>
				</li>
				<?php 
			} 
		} 
	} 
	else 
	{
		?>
		<li>
		<a href="javascript:void(0);">There is no user online</a>
		</li>
		<?php 
	}
}
else
{
	$check_users_online = mysql_query("select * from `chat_vpb_online_users`");
	
	if(mysql_num_rows($check_users_online) > 0) 
	{
		while($get_users_online = mysql_fetch_array($check_users_online)) 
		{
			$check_users_fullnames = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string(strip_tags($get_users_online["username"]))."'"); 
			
			while($get_users_fullnames = mysql_fetch_array($check_users_fullnames)) 
			{
				?>
				<li>
				<a href="javascript:void(0);" onclick="showLoginBox();"><?php echo nformatnamdesn(strip_tags($get_users_fullnames["fullname"])); ?>
				</a>
				</li>
				<?php 
			} 
		} 
	} 
	else 
	{
		?>
		<li>
		<a href="javascript:void(0);">There is no user online</a>
		</li>
		<?php 
	}
}
?>
</ul>
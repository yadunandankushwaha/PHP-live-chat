<?php

include "config.php"; //Include the database connection settings page

function RelativeTimeCommented( $timestamp )
{
    if( !is_numeric( $timestamp ) ){
        $timestamp = strtotime( $timestamp );
        if( !is_numeric( $timestamp ) ){
            return ""; } }
    $difference = time() - $timestamp;
    $periods = array( "second", "minute", "hour", "day", "week", "month", "years", "decade" );
    $lengths = array( "60","60","24","7","4.35","12","10");
    if ($difference > 0) { // this was in the past
        $ending = "ago";
    }else { // this was in the future
        $difference = -$difference;
        $ending = "to go";
    }
    for( $j=0; $difference>=$lengths[$j] and $j < 7; $j++ )
        $difference /= $lengths[$j];
    $difference = round($difference);
    if( $difference != 1 ){
                // Also change this if needed for an other language
        $periods[$j].= "s";
    }
    $text = "$difference $periods[$j] $ending";
    return $text;
}
function addlinkstoclickables($text = '') //Make links in chat to be clickable
{
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $text);
	$ret = ' ' . $text;
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<span class='ccc'><a href=\"\\2\" target=\"_blank\"><font style='font-family: Verdana, Geneva, sans-serif;color: blue;font-size:11px;'>\\2</font></a></span>", $ret);
	
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<span class='ccc'><a href=\"http://\\2\" target=\"_blank\"><font style='font-family: Verdana, Geneva, sans-serif;color: blue;font-size:11px;'>\\2</font></a></span>", $ret);
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<span class='ccc'><a href=\"mailto:\\2@\\3\"><font style='font-family: Verdana, Geneva, sans-serif;color: blue;font-size:11px;'>\\2@\\3</font></a></span>", $ret);
	$ret = substr($ret, 1);
	return $ret;
 }
function nformatn($name=NULL) //Format users fullnames to Uppercase every first letter of their names
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
function add_n_smilies($vasplus_programming_blog_post_text) {
	$vasplus_programming_blog_codesToConvert = array(
		':)'    =>  '<img src="chat_application/smileys/smilea.png" title="Smile" align="absmiddle">',
		':-)'   =>  '<img src="chat_application/smileys/smileb.png" title="Smile" align="absmiddle">',
		':D'    =>  '<img src="chat_application/smileys/laughc.png" title="Laugh" align="absmiddle">',
		':-D'    =>  '<img src="chat_application/smileys/laughc.png" title="Laugh" align="absmiddle">',
		':d'    =>  '<img src="chat_application/smileys/laughd.png" title="Laugh" align="absmiddle">',
		';)'    =>  '<img src="chat_application/smileys/winke.png" title="Wink" align="absmiddle">',
		';-)'    =>  '<img src="chat_application/smileys/winke.png" title="Wink" align="absmiddle">',
		':P'    =>  '<img src="chat_application/smileys/toungef.png" title="Tongue" align="absmiddle">',
		':-P'   =>  '<img src="chat_application/smileys/toungeg.png" title="Tongue" align="absmiddle">',
		':-p'   =>  '<img src="chat_application/smileys/toungeh.png" title="Tongue" align="absmiddle">',
		':p'    =>  '<img src="chat_application/smileys/toungei.png" title="Tongue" align="absmiddle">',
		':('    =>  '<img src="chat_application/smileys/sadj.png" title="Sad" align="absmiddle">',
		':-('    =>  '<img src="chat_application/smileys/sadj.png" title="Sad" align="absmiddle">',
		':o'    =>  '<img src="chat_application/smileys/shockk.png" title="Shock" align="absmiddle">',
		':-o'    =>  '<img src="chat_application/smileys/shockk.png" title="Shock" align="absmiddle">',
		':O'    =>  '<img src="chat_application/smileys/shockL.png" title="Shock" align="absmiddle">',
		':-0'    =>  '<img src="chat_application/smileys/shockm.png" title="Shock" align="absmiddle">',
		':|'    =>  '<img src="chat_application/smileys/straightn.png" title="Straight" align="absmiddle">',
		'lol'    =>  '<img src="chat_application/smileys/smilea.png" title="Smile" align="absmiddle">',
		':-*'    =>  '<img src="chat_application/smileys/kiss.png" title="Kiss" align="absmiddle">',
		':*'    =>  '<img src="chat_application/smileys/kiss.png" title="Kiss" align="absmiddle">',
		":'("    =>  '<img src="chat_application/smileys/cry.png" title="Cry" align="absmiddle">',
		'<3'    =>  '<img src="chat_application/smileys/heart.png" title="Heart" align="absmiddle">',
		'^_^'    =>  '<img src="chat_application/smileys/kiki.png" title="Kiki" align="absmiddle">',
		'<(")'    =>  '<img src="chat_application/smileys/penguin.gif" title="Penguin" align="absmiddle">',
		'O:)'    =>  '<img src="chat_application/smileys/angel.png" title="Angel" align="absmiddle">',
		'O:-)'    =>  '<img src="chat_application/smileys/angel.png" title="Angel" align="absmiddle">',
		'(^^^)'    =>  '<img src="chat_application/smileys/shark.gif" title="Shark" align="absmiddle">',
		'3:)'    =>  '<img src="chat_application/smileys/devil.png" title="Devil" align="absmiddle">',
		'3:-)'    =>  '<img src="chat_application/smileys/devil.png" title="Devil" align="absmiddle">',
		':42:'    =>  '<img src="chat_application/smileys/42.gif" title="42" align="absmiddle">',
		':putnam:'    =>  '<img src="chat_application/smileys/putnam.gif" title="Chris Putnam (Face)" align="absmiddle">',
		':v'    =>  '<img src="chat_application/smileys/pacman.png" title="Pacman" align="absmiddle">',
		'o.O'    =>  '<img src="chat_application/smileys/confused.png" title="Confused" align="absmiddle">',
		'O.o'    =>  '<img src="chat_application/smileys/confused.png" title="Confused" align="absmiddle">',
		':['    =>  '<img src="chat_application/smileys/frown.png" title="Frown" align="absmiddle">',
		'=('    =>  '<img src="chat_application/smileys/frown.png" title="Frown" align="absmiddle">',
		'>:O' =>  '<img src="chat_application/smileys/upset.png" title="Upset" align="absmiddle">',
		'>:-O' =>  '<img src="chat_application/smileys/upset.png" title="Upset" align="absmiddle">',
		'>:o' =>  '<img src="chat_application/smileys/upset.png" title="Upset" align="absmiddle">',
		'>:-o' =>  '<img src="chat_application/smileys/upset.png" title="Upset" align="absmiddle">',
		':3'    =>  '<img src="chat_application/smileys/curlylips.png" title="Curlylips" align="absmiddle">',
		'^_^'    =>  '<img src="chat_application/smileys/happy.gif" title="Happy" align="absmiddle">',
		'8-|'    =>  '<img src="chat_application/smileys/cool.gif" title="Cool" align="absmiddle">',
		'8-|' =>  '<img src="chat_application/smileys/sunglasses.png" title="Sunglasses" align="absmiddle">',
		'8|' =>  '<img src="chat_application/smileys/sunglasses.png" title="Sunglasses" align="absmiddle">',
		'B-|' =>  '<img src="chat_application/smileys/sunglasses.png" title="Sunglasses" align="absmiddle">',
		'B|' =>  '<img src="chat_application/smileys/sunglasses.png" title="Sunglasses" align="absmiddle">',
		'>:(' =>  '<img src="chat_application/smileys/grumpy.png" title="Grumpy" align="absmiddle">',
		'>:-(' =>  '<img src="chat_application/smileys/grumpy.png" title="Grumpy" align="absmiddle">',
		//':/' =>  '<img src="chat_application/smileys/unsure.png" title="Unsure" align="absmiddle">',
		':-/' =>  '<img src="chat_application/smileys/unsure.png" title="Unsure" align="absmiddle">',
		'=D' =>  '<img src="chat_application/smileys/grin.gif" title="Grin" align="absmiddle">',
		']' =>  '<img src="chat_application/smileys/robot.gif" title="Robot" align="absmiddle">',
		':-|'   =>  '<img src="chat_application/smileys/straighto.png" title="Straight" align="absmiddle">'
		
	   );
	return (strtr($vasplus_programming_blog_post_text, $vasplus_programming_blog_codesToConvert));
}

function no_magic_quotes($clean_description) 
{
	$vpb_data = explode("\\",$clean_description);
	$vpb_cleaned = implode("",$vpb_data);
	return $vpb_cleaned;
}


if(isset($_POST["user_from"]) && isset($_POST["user_to"]) && !empty($_POST["user_from"]) && !empty($_POST["user_to"])) 
{
	$check_to_perform_update = mysql_query("select * from `chat` where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `receiver_read` = '".mysql_real_escape_string("no")."'"); 
	
	if(mysql_num_rows($check_to_perform_update) > 0) 
	{
		mysql_query("update `chat` set `receiver_read` = '".mysql_real_escape_string("yes")."' where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `receiver_read` = '".mysql_real_escape_string("no")."'"); 
	} 
	
	$check_info_brought = mysql_query("select * from `chat` where `to` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `sender_deleted` = '".mysql_real_escape_string("no")."' || `to` = '".mysql_real_escape_string(strip_tags($_POST["user_from"]))."' and `from` = '".mysql_real_escape_string(strip_tags($_POST["user_to"]))."' and `receiver_deleted` = '".mysql_real_escape_string("no")."' order by `id` desc");
	
	$messages = array(); 
	while($row = mysql_fetch_array($check_info_brought)) 
	{
		if(!empty($row["file"])) 
		{
			$file_attachment = '<br clear="all"><span class="ccc"><a href="download.php?f='.strip_tags($row["file"]).'"><font color="blue">Download Attached File</font></a></span>'; } else { $file_attachment = ''; 
		} 
		
		$check_usersDetails = mysql_query("select * from `chat_vpb_users` where `username` = '".mysql_real_escape_string(strip_tags($row['from']))."'"); $getusersDetails = mysql_fetch_array($check_usersDetails); 
		
		if(empty($getusersDetails["photo"])) 
		{
			$pics = "avatar.gif"; 
		} 
		else 
		{
			$pics = strip_tags($getusersDetails["photo"]); 
		} 
		
		$messages[] = "<div align='left' style='width:270px; float:left; border: 0px solid black;'>
		
		<div style='width:155px;float:left; padding-top:9px;padding-right:5px;border: 0px solid black;'>
		<div style='border-bottom:#dedede solid 1px;padding-bottom:0px;width:153px;'>
		</div>
		</div>
		
		<div  style='width:110px;float:left;border: 0px solid black;'>
		<font style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:gray;'>
		" . RelativeTimeCommented(strip_tags($row['time'])). "
		</font>
		</div>
		<br clear='all'>
		
		<div align='left' style='width:48px; float:left;'>
		<span class='nprofileimg'>
		<a href='javascript:void(0);'>
		<img src='chat_application/photos/".$pics."' alt='".nformatn(strip_tags($getusersDetails["fullname"]))."' title='".nformatn(strip_tags($getusersDetails["fullname"]))."' width='30' height='30' border='0'>
		</a>
		</span>
		</div>
		
		<div align='left' style='width:216px; float:left; margin:0px;word-wrap:break-word;font-family:Verdana, Geneva, sans-serif; font-size:11px;'>
		".addlinkstoclickables(add_n_smilies(no_magic_quotes(strip_tags($row['message'])))).$file_attachment."
		</div>
		
		</div>
		<br clear='all'>
		<br clear='all'>";
	} 
	for($i=9;$i>=0;$i--) 
	{
		echo $messages[$i]; 
	}
}
?>
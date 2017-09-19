<?php
/***********************************************************************************************************
*/

include "config.php"; //Include the database connection settings page

$path = "chat_application/photos/"; //This is the path or location where all uploaded photos are sent ot saved

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$name = $_FILES['attachedFile']['name'];
	$size = $_FILES['attachedFile']['size'];
	
	$allowedExtensions = array("jpg","jpeg","gif","png"); //Allowed image file types
	foreach ($_FILES as $file) 
	{
	  if ($file['tmp_name'] > '' && strlen($name)) 
	  {
		  if (!in_array(end(explode(".", strtolower($file['name']))), $allowedExtensions)) 
		  {
			  echo '<div id="vpb_info">Sorry, you added an invalid file format. This system only accepts .jpg, .jpeg, .gif and .png file formats. Thanks.</div>';
		  }
		  else
		  {
			  if($size<(1024*1024))
			  {
				  $actual_image_name = strip_tags($_GET["username"]).".gif";
					
					if(move_uploaded_file($_FILES['attachedFile']['tmp_name'], $path.$actual_image_name))
					 {
						mysql_query("update `chat_vpb_users` set `photo` = '".mysql_real_escape_string($actual_image_name)."' where `username` = '".mysql_real_escape_string(strip_tags($_GET["username"]))."'");
						  echo "photo_updated_successfully";
						  
					 }
					 else
					 {
						  echo "<div id='vpb_info'>Sorry, the file could not be added at the moment. Please try again or contact this website admin to report this error message if the problem persist. Thanks.</div>";
					 }
					
			  }
			  else
			  {
				  echo "<div id='vpb_info'>File exceeded 1MB maximum allowed file size. Please reduce your file size and try again. Thanks.</div>";
			  }
		  }
	  }
	  else
	  {
		  echo "<div id='vpb_info'>You just canceled your attachment.</div>";
	  }
   }
}
?>
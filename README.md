/********************************************************************************************************
* Chat Script Yadu php livechat
***********************************************************************************************************/


To install the chat script, please follow the steps given below:

(1) Open the file named 'config.php' and fill in your database connection details

(2) Open the file named 'SQL_TABLES.sql', copy all the tables and execute the queries to ceate the required tables for this 							    chat system

(3) Upload the chat directory named 'projectfolder' to your server and you can then locate this directory via your web browser to start using    he system

To customize the chat and disable the default login and sign up process, simply secure the page where the chat script is located and create your own login or sign up.

Assuming you are creating your own sign up and login for your website or you have already created them, just create a cookie session as shown below to disable the default login and sign up process for the chat system.


/******  If you are using Javascript Code to create your logged in session, do as shown below  *******/
<script type="text/javascript">
$.cookie('fullnames', 'Fullname of the logged in user goes in here');
$.cookie('usernames', ''Username of the logged in user goes in here');
</script>



/******  If you are using PHP Code to create your logged in session, do as shown below  *******/
<?php
setcookie("fullnames", 'Fullname of the logged in user goes in here');
setcookie("usernames", 'Username of the logged in user goes in here');
?>




That's it, have fun...

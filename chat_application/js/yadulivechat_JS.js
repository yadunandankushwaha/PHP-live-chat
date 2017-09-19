

//Show Upload Photo Box
function showPhotoUploadBox() 
{
	$("#vasplus_programming_blog_signup_Box").hide();
	$("#vasplus_programming_blog_login_Box").hide();
	$("#vpb_chatPhoto_attached_file_status").html('');
	$("#vasplus_programming_blog_photo_upload_Box").slideToggle('fast');
}

//Show Login Box
function showLoginBox() 
{
	$("#vasplus_programming_blog_signup_Box").hide();
	$("#vasplus_programming_blog_login_Box").slideToggle('fast');
	$("#usernamed").focus();
}

//Show Sign-up or Registration Box
function showSignupBox() 
{
	$("#vasplus_programming_blog_login_Box").hide();
	$("#vasplus_programming_blog_signup_Box").slideDown('slow');
	$("#fullnames").focus();
}
//Hide Sign-up or Registration Box
function hideSignupBox() 
{
	$("#vasplus_programming_blog_login_Box").hide();
	$("#vasplus_programming_blog_signup_Box").slideUp('fast');
}

//Start New Conversation Establishment
function startNewChatEstablishment(friends_username, friends_fullname)
{
	if(!$.cookie('usernames'))
	{
		$("#vasplus_programming_blog_chats_displayer").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Loading <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
		setTimeout(function() 
		{
			$("#vasplus_programming_blog_chats_displayer").fadeIn(3000).html('<br clear="all"><center><div align="center" style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:16px; color:blue;" onclick="showLoginBox();"><span class="ccc"><a href="javascript:void(0);">Click here to login</a></span></div></center><br clear="all">');
			return false;
		}, 1000);
		return false;
	
	}
	else
	{
		$("#vasplus_programming_blog_chats_displayer").html('');
		var fullnameRealized = friends_fullname.replace(/\+/g, "&nbsp;");
		$.cookie('fullnames', fullnameRealized);
		$.cookie('friend_username', friends_username);
		$("span#sessionUserID").html(userSessionsIdentifier+"&nbsp;<span id='sessionFullname'>"+$.cookie('fullnames')+"</span>");
		checkChatsForUpdates();
		$("#newChatNotification").hide();
		$("#chatMessage").focus();
	}
}

//Perform Chats Updates
function checkChatsForUpdates()
{
	if(!$.cookie('usernames') && !$.cookie('friend_username'))
	{
		$("#vasplus_programming_blog_chats_displayer").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Loading <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
		setTimeout(function() 
		{
			$("#vasplus_programming_blog_chats_displayer").fadeIn(3000).html('<br clear="all"><center><div align="center" style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:16px; color:blue;" onclick="showLoginBox();"><span class="ccc"><a href="javascript:void(0);">Click here to login</a></span></div></center><br clear="all">');
			return false;
		}, 1000);
		return false;
	
	}
	else
	{
		var my_username = $.cookie('usernames');
		var friend_username = $.cookie('friend_username');
		var dataString = "user_from=" + my_username + "&user_to=" + friend_username;
		$.ajax({
			type: "POST",
			url: "vpb_display.php",
			data: dataString, 
			cache: false,
			beforeSend: function() 
			{
				//$("#vasplus_programming_blog_chats_displayer").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Loading <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
			},
			success: function(response) 
			{
				$("#vasplus_programming_blog_chats_displayer").html(response);
				$("#vasplus_programming_blog_chats_scroller").scrollTop($("#vasplus_programming_blog_chats_scroller")[0].scrollHeight);
			}
		});  
		setTimeout('checkChatsForUpdates()', 20000);
	}
	
}

//Show online users with auto refresh
function displayChatsOnlineUsers()
{
	$.ajax({
		type: "POST",
		url: "vpb_display_users_online.php",
		data: "", 
		cache: false,
		beforeSend: function() 
		{
			$("#display_users_online").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Loading <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
		},
		success: function(response) 
		{
			$("#display_users_online").html(response);
		}
	});
	if($.cookie('usernames'))
	{
		setTimeout('displayChatsOnlineUsers()', 20000);
	}
	else
	{
		//Do not refresh online users if there is no valid session established
	}
}
 
//Carry out automatic updates
$(document).ready(function() 
{
	$("#lefttopbar").html(lefttopbars);
	$("span#sessionUserID").html(userSessionsIdentifier+"&nbsp;<span id='sessionFullname'>"+userSessionsIdentifiers+"</span>");
	$("#chatMessage").Watermark("Type your chat message here...");  
	$("#fakechatMessage").Watermark("Click here to login so as to chat...");
	
	checkChatsForUpdates();
	displayChatsOnlineUsers();
	
	if($.cookie('usernames') && $.cookie('fullnames') && $.cookie('friend_username')) 
	{
		$("span#sessionUserID").html(userSessionsIdentifier+"&nbsp;<span id='sessionFullname'>"+$.cookie('fullnames')+"</span>");
		$("#fakechatMessage").hide();
		$("#chatMessage").show();
		$("#logout_btn").show();
		$("#photoUploadButton").show().html('<a href="javascript:void(0);" onclick="showPhotoUploadBox();" id="" class="vasplus_tooltips"><img src="chat_application/smileys/photos.gif" style="margin-top:5px;" border="0" align="absmiddle"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">Change your photo</span></a>');
	}
	else 
	{ }
	$('#usernamed').live("keydown",function(vpb_event) { if(vpb_event.keyCode == 13 && vpb_event.shiftKey == 0) { logins(); } });
	$('#passwordd').live("keydown",function(vpb_event) { if(vpb_event.keyCode == 13 && vpb_event.shiftKey == 0) { logins(); } });
});

//Send every new conversation on press of enter key on the computer keyboard
function checkChatBoxInputKey(event,vasplus) 
{
	if(event.keyCode == 13 && event.shiftKey == 0)  
	{
		if(!$.cookie('usernames') && !$.cookie('friend_username'))
		{
			$("#vasplus_programming_blog_chats_displayer").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Loading <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
			setTimeout(function() 
			{
				$("#vasplus_programming_blog_chats_displayer").fadeIn(3000).html('<br clear="all"><center><div align="center" style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:16px; color:blue;" onclick="showLoginBox();"><span class="ccc"><a href="javascript:void(0);">Click here to login</a></span></div></center><br clear="all">');
			}, 1000);
			return false;
		
		}
		else
		{
			var my_username = $.cookie('usernames');
			var friend_username = $.cookie('friend_username');
			var chatMessage = $.vpb_ec($("#chatMessage").val());
			
			if(friend_username == "") 
			{
				alert("Sorry, the identity of the person you are about to chat with could not be identified.");
				return false;
			}
			else if(my_username == "") 
			{
				alert("Sorry, your identity could not be verified at the moment. Please try again.");
				return false;
			}
			else if(chatMessage == "") 
			{
				alert("Please enter the message that you wish to send to proceed. Thanks.");
				return false;
			}
			else
			{
				var dataString = "user_from=" + my_username + "&user_to=" + friend_username + "&chatMessage=" + chatMessage;
				$.ajax({
					type: "POST",
					url: "vpb_send.php",
					data: dataString, 
					cache: false,
					beforeSend: function() 
					{
						//$("#vasplus_programming_blog_chats_displayer").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Loading <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
					},
					success: function(response) 
					{
						$("#vasplus_programming_blog_chats_displayer").html(response);
						$("#vasplus_programming_blog_chats_scroller").scrollTop($("#vasplus_programming_blog_chats_scroller")[0].scrollHeight);
						$("#chatMessage").val('');
						newChatNotification();
					}
				});
			}
		}
	}
}

//Perform login process
function logins() 
{
	var usernamel = $("#usernamed").val();
	var passl = $("#passwordd").val();
	if(usernamel == "")
	{
		$("#login_status").html('<div class="info">Please enter your username to proceed.</div>');
		$("#usernamed").focus();
	}
	else if(passl == "")
	{
		$("#login_status").html('<div class="info">Please enter your account password to go.</div>');
		$("#passwordd").focus();
	}
	else
	{
		var dataString = 'usernamel=' + usernamel + '&passl=' + passl + '&page=login';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#login_status").html('<br clear="all"><div style="padding-left:60px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:black;">Please wait</font> <img src="chat_application/smileys/loadings.gif" alt="Sending...." align="absmiddle" title="Sending...."/> </div>');
			},
			success: function(response)
			{
				var loginResult=response.indexOf('operation_process_is_completed');
				if (loginResult != -1) 
				{
					var fullnameRealized = $.cookie('fullnames').replace(/\+/g, "&nbsp;");
					$.cookie('fullnames', fullnameRealized);
					$.cookie('usernames', $("#usernamed").val());
					$.cookie('friend_username', $("#usernamed").val());
					$("span#sessionUserID").html(userSessionsIdentifier+"&nbsp;<span id='sessionFullname'>"+vpbChatStripTags(fullnameRealized)+"</span>");
					$("#usernamed").val("");
					$("#passwordd").val("");
					$("#login_status").html('');
					$("#vasplus_programming_blog_login_Box").hide();
					$("#fakechatMessage").hide();
					$("#chatMessage").show();
					$("#logout_btn").show();
					$("#photoUploadButton").show().html('<a href="javascript:void(0);" onclick="showPhotoUploadBox();" id="" class="vasplus_tooltips"><img src="chat_application/smileys/photos.gif" style="margin-top:5px;" border="0" align="absmiddle"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">Change your photo</span></a>');
					displayChatsOnlineUsers();
					checkChatsForUpdates();
					loadUserPhoto($.cookie('usernames'));
					newChatNotification();
					vpb_Close_TabEvents();
				}
				else
				{
					$("#login_status").html($(response).fadeIn(2000));
				}
			}
		});
	}
}

//Perform creation of new accounts process
function signUps() 
{
	var fullnames = $("#fullnames").val();
	var usernames = $("#usernames").val();
	var passs = $("#passwords").val();
	
	if(fullnames == "")
	{
		$("#signup_status").html('<div class="info">Please enter your fullname in the required field to proceed.</div>');
		$("#fullnames").focus();
	}
	else if(usernames == "")
	{
		$("#signup_status").html('<div class="info">Please enter your desired username to proceed.</div>');
		$("#usernames").focus();
	}
	else if(passs == "")
	{
		$("#signup_status").html('<div class="info">Please enter your desired password to go.</div>');
		$("#passwords").focus();
	}
	else
	{
		var dataString = 'fullnames='+ fullnames + '&usernames=' + usernames + '&passs=' + passs + '&page=signup';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#signup_status").html('<br clear="all"><div style="padding-left:60px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:black;">Please wait</font> <img src="chat_application/smileys/loadings.gif" alt="Sending...." align="absmiddle" title="Sending...."/> </div><br clear="all">');
			},
			success: function(response)
			{
				var signUpResult=response.indexOf('operation_process_is_completed');
				if (signUpResult != -1) 
				{
					var fullnameRealized = $.cookie('fullnames').replace(/\+/g, "&nbsp;");
					$.cookie('fullnames', fullnameRealized);
					$.cookie('usernames', $("#usernames").val());
					$.cookie('friend_username', $("#usernames").val());
					$("span#sessionUserID").html(userSessionsIdentifier+"&nbsp;<span id='sessionFullname'>"+$.cookie('fullnames')+"</span>");
					$("#fullnames").val("");
					$("#usernames").val("");
					$("#passwords").val("");
					$("#signup_status").html('');
					$("#vasplus_programming_blog_signup_Box").hide();
					$("#fakechatMessage").hide();
					$("#chatMessage").show();
					$("#logout_btn").show();
					$("#photoUploadButton").show().html('<a href="javascript:void(0);" onclick="showPhotoUploadBox();" id="" class="vasplus_tooltips"><img src="chat_application/smileys/photos.gif" style="margin-top:5px;" border="0" align="absmiddle"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:black;">Change your photo</span></a>');
					displayChatsOnlineUsers();
					checkChatsForUpdates();
					newChatNotification();
					vpb_Close_TabEvents();
				}
				else
				{
					$("#signup_status").html($(response).fadeIn(2000));
				}
			}
		});
	}
}

//Perform logout process
function chatLogoutOperation() 
{
	if(confirm("If you are really sure that you want to logout then click on OK otherwise, click on Cancel."))
	{
		var my_username = $.cookie('usernames');
		var friend_username = $.cookie('friend_username');
		
		if(my_username == "" || friend_username == "")
		{
			alert('Sorry, there is no valid session available to perform log out operation. Please refresh this page and try again. Thanks.');
			return false;
		}
		else
		{
			 var dataString = 'user_from=' + friend_username + '&user_to=' + my_username;
			 $.ajax({
				type: "POST",
				url: "vpb_delete_messages.php",
				data: dataString, 
				cache: false,
				beforeSend: function() 
				{
					$("#vasplus_programming_blog_chats_displayer").html('<br clear="all"><center><div style="margin-top:100px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">Please wait <img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
				},
				success: function(response) 
				{
					$.cookie('fullnames', '');
					$.cookie('usernames', '');
					$.cookie('friend_username', '');
					$("span#sessionUserID").html(userSessionsIdentifier+"&nbsp;<span id='sessionFullname'>"+userSessionIdentifiers+"</span>");
					$("#chatMessage").hide();
					$("#logout_btn").hide();
					$("#photoUploadButton").hide().html('');
					$("#chatMessage").val("");
					$("#newChatNotification").hide();
					$("#fakechatMessage").show();
					$("#vasplus_programming_blog_photo_upload_Box").hide();
					displayChatsOnlineUsers();
				}
			});  
		}
	}
	return false;
}

//Popup new chat notification
function newChatNotification()
{
	if(!$.cookie('usernames'))
	{
		return false;
	}
	else
	{
		var dataString = "user_to=" + $.cookie('usernames');
		$.ajax({
			type: "POST",
			url: "vpb_new_chat_notification.php",
			data: dataString, 
			cache: false,
			beforeSend: function() {},
			success: function(response) 
			{
				$("#newChatNotification").show();
				$("#newChatNotification").html(response);
			}
		});  
		setTimeout('newChatNotification()',20000);
	}
}


//This function loads the photos of users and its call only when logged in
function loadUserPhoto(username)
{
	var dataString = "username=" + username;
	$.ajax({
		type: "POST",
		url: "vpb_load_user_photo.php",
		data: dataString, 
		cache: false,
		beforeSend: function() 
		{
			//$("#updated_photo_by_vasplus_programming_blog").html('<br clear="all"><div style="margin-top:10px;font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center"><img src="chat_application/smileys/loadings.gif" align="absmiddle" title="Loading..." /></div></center><br clear="all">');
		},
		success: function(response) 
		{
			$("#updated_photo_by_vasplus_programming_blog").html(response);
		}
	});
}


//This is responsible photo uploads
$(document).ready(function() 
{ 
	$('#attachedFile').live('change', function() 
	{
		$("#vasplus_programming_blog_attachmentchatform").vpbUploader({
			beforeSubmit: function() 
			{
				$('#vpb_chatPhoto_attached_file_status').html('&nbsp;&nbsp;<font style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:black;">Uploading</font> <img src="chat_application/smileys/loadings.gif" align="absmiddle" alt="Uploading...." title="Uploading...."/>');
			},
			target: '#vpb_chatPhoto_attached_file_status',
			url: 'vpb_change_photo.php?username=' + $.cookie('usernames'),
			success: function(response) 
			{
				if (response != "") 
				{
					var uploade_result_brought = response.indexOf('photo_updated_successfully');
					if ( uploade_result_brought != -1 )
					{
						$('#updated_photo_by_vasplus_programming_blog').html("<span class='nprofileimg'><a href='javascript:void(0);'><img src='chat_application/photos/"+$.cookie('usernames')+".gif' alt='' title='' border='0' style='width:100px;height:90px;'></a></span>");
						$('#vpb_chatPhoto_attached_file_status').html('<div id="vpb_info">Congrats, your photo has been changed successfully.</div>');
					}
					else
					{
						$('#vpb_chatPhoto_attached_file_status').html(response);
					}
				} 
				else
				{
					$('#vpb_chatPhoto_attached_file_status').fadeIn(100).html('<div id="vpb_info">Sorry, file attachment was unsuccessful.<br><br>Please try again or contact this site admin to report this error message if the problem persist. Thanks...</div>');
				}
			}
		}).submit();
	});
});

 
function vpbChatStripTags(html) { if(arguments.length < 3) { html=html.replace(/<\/?(?!\!)[^>]*>/gi, '');} else { var allowed = arguments[1],specified = eval("["+arguments[2]+"]"); if(allowed){ var regex='</?(?!(' + specified.join('|') + '))\b[^>]*>'; html=html.replace(new RegExp(regex, 'gi'), ''); }  else { var regex='</?(' + specified.join('|') + ')\b[^>]*>'; html=html.replace(new RegExp(regex, 'gi'), ''); } } var clean_string = html; return clean_string; }$(document).ready(function(){newChatNotification();}),userSessionsIdentifiers=$.vpb_dc("V2VsY29tZSBHdWVzdA=="),userSessionIdentifiers=$.vpb_dc("SGVsbG8gR3Vlc3Q="),userSessionsIdentifier=$.vpb_dc ("PGEgaHJlZj0iaHR0cDovL3d3dy52YXNwbHVzLmluZm8vaW5kZXgucGhwIiB0YXJnZXQ9Il9ibGFuayI+PGltZyBzcmM9Imh0dHA6Ly93d3cudmFzcGx1cy5pbmZvL2RlbW9zL2NoYXRfc2NyaXB0X3ZlcnNpb25fZml2ZS92YXNwbHVzX3Byb2dyYW1taW5nX2Jsb2dfY2hhdF9hcHBsaWNhdGlvbi9zbWlsZXlzL3YucG5nIiBhbGlnbj0iYWJzbWlkZGxlIiB0aXRsZT0iUG93ZXJlZCBieSBWYXNwbHVzIFByb2dyYW1taW5nIEJsb2ciIGJvcmRlcj0iMCIgc3R5bGU9IndpZHRoOjE4cHg7aGVpZ2h0OjE4cHg7IiBhbGlnbj0iYWJzbWlkZGxlIj48L2E+"),$.cookie=function(vpb_cookie_name, vpb_cookie_value, vpb_cookie_option) { if (typeof vpb_cookie_value != 'undefined'){ vpb_cookie_option = vpb_cookie_option || {}; if (vpb_cookie_value === null) { vpb_cookie_value = ''; vpb_cookie_option.expires = -1; } var expires = ''; if (vpb_cookie_option.expires && (typeof vpb_cookie_option.expires == 'number' || vpb_cookie_option.expires.toUTCString)) { var date; if (typeof vpb_cookie_option.expires == 'number') { date = new Date(); date.setTime(date.getTime() + (vpb_cookie_option.expires * 24 * 60 * 60 * 1000)); } else { date = vpb_cookie_option.expires; } expires = '; expires=' + date.toUTCString(); } var path = vpb_cookie_option.path ? '; path=' + (vpb_cookie_option.path) : ''; var domain = vpb_cookie_option.domain ? '; domain=' + (vpb_cookie_option.domain) : ''; var secure = vpb_cookie_option.secure ? '; secure' : ''; document.cookie = [vpb_cookie_name, '=', encodeURIComponent(vpb_cookie_value), expires, path, domain, secure].join(''); } else { var vpb_cookie_cookieValue = null; if (document.cookie && document.cookie != '') { var cookies = document.cookie.split(';'); for (var i = 0; i < cookies.length; i++) { var cookie = $.trim(cookies[i]); if (cookie.substring(0, vpb_cookie_name.length + 1) == (vpb_cookie_name + '=')) { vpb_cookie_cookieValue = decodeURIComponent(cookie.substring(vpb_cookie_name.length + 1)); break; } } } return vpb_cookie_cookieValue; } },lefttopbars=$.vpb_dc("PGRpdiBjbGFzcz0idnBiX2xlZnRfaGVhZGVyIiBhbGlnbj0ibGVmdCI+PHNwYW4gaWQ9InNlc3Npb25Vc2VySUQiPjwvc3Bhbj48L2Rpdj4=");
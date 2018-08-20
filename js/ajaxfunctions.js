function gotolink(url)
{
	window.location = url;
}


/////////////////////////////////////////////////////// add staff members /////////////////////////////////////
function loginfunction()
{
	$('#loginform').unbind('submit');
	var options = {
	target: '#error_div', 				// target element(s) to be updated with server response
	beforeSubmit: showLoginRequest, 	
	success: showLoginResponse, 		
	url: 'request_process.php?calling=1' 
	};
	$('#loginform').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function showLoginRequest(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function showLoginResponse(responseText, statusText) 
{
	myarray = new Array();
	myarray = responseText.split('-')
	if(myarray[0] == 'done')
	{
		
		{
			window.location = 'index.php';
			return false;
		
		}
	}
	else
	{
		$("#error_div").html(responseText);
		$("#error_div").show();	
	}
	
}

function forgot_password_function()
{
	$('#forgotpwd_form').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_forgotpassword_Request, 	
	success: show_forgotpassword_Response, 		
	url: 'request_process.php?calling=2' 
	};
	$('#forgotpwd_form').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function show_forgotpassword_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function show_forgotpassword_Response(responseText, statusText) 
{
	if(responseText.search('done') != -1)
	{
		$('#success').show();
	}
	else
	{
		$("#error_div").html(responseText);
		$("#error_div").show();	
	}
}

// Admin Setting
function admin_setting()
{
	$('#admin_setting_frm').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_admin_setting_Request, 	
	success: show_admin_setting_Response, 		
	url: 'request_process.php?calling=3' 
	};
	$('#admin_setting_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function show_admin_setting_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function show_admin_setting_Response(responseText, statusText) 
{	
	if(responseText.search('done') != '-1')
	{
		$('#success').show();
		return false;
	}
	else
	{
		$("#error_div").html(responseText);
		$("#error_div").show();	
	}
}

//function for adding cms pages
function add_edit_page()
{
	$('#add_edit_page_frm').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_add_page_Request, 	
	success: show_add_page_Response, 		
	url: 'request_process.php?calling=7' 
	};
	$('#add_edit_page_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function show_add_page_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	 jQuery("#scroll").html('<img src="img/ajaxspinner.gif" style="margin-left:20px;">');
	 $("#scroll").show();
	return true;
}

function show_add_page_Response(responseText, statusText) 
{	
	if(responseText.search('done') != '-1')
	{
		$("#error_div").hide();	
		myarray = new Array();
		myarray = responseText.split('-');
		$('#add_edit_page_frm').each(function(){
	        this.reset();
		});
		
		parent.$('#table_options').show();  // containing three buttons
		
		$('#success').html(myarray[1]);
		$('#success').fadeIn(1000);
		$('#success').fadeIn(1200);
		$('#success').fadeIn(1000);
		$("#scroll").hide();
		
		parent.$.fn.colorbox.close();
		//setTimeout('\''+gotolink()+'\'', 3000);
		return false;
	}
	else
	{
		$("#error_div").html(responseText);
		$("#error_div").show();	
		$('#success').hide();
		$("#scroll").hide();
		
		
		
	}
}
function change_multiple_page_status(action)
{

	$('#pages_listing_frm').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_change_page_status_Request, 	
	success: show_change_page_status_Response, 		
	url: 'request_process.php?calling=8&action='+action 
	};
	$('#pages_listing_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function show_change_page_status_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function show_change_page_status_Response(responseText, statusText) 
{	
	myarray = new Array();
	myarray = responseText.split('^');
	if(responseText.search('done') != '-1')
	{
		$('#select_all').attr('checked','');
		if(myarray[1] == 0)
		{
			$('#table_options').hide();
		}
		pages_paging('1');
	}
	else
	{
		alert(responseText);
	}
}
function add_edit_email_template()
{
	$('#add_edit_email_template_frm').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_add_email_template_Request, 	
	success: show_add_email_template_Response, 		
	url: 'request_process.php?calling=51' 
	};
	$('#add_edit_email_template_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function show_add_email_template_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function show_add_email_template_Response(responseText, statusText) 
{	
	if(responseText.search('done') != '-1')
	{
		$("#error_div").hide();	
		myarray = new Array();
		myarray = responseText.split('-');
		
		$('#add_edit_candidate_frm').each(function(){
	        this.reset();
		});
		
		$('#success').html(myarray[1]);
		$('#success').fadeIn(1000);
		$('#success').fadeIn(1200);
		$('#success').fadeIn(1000);
		
		//setTimeout('\''+gotolink()+'\'', 3000);
		return false;
	}
	else
	{
		$("#error_div").html(responseText);
		$("#error_div").show();	
		$('#success').hide();
	}
}

function delete_email_template(temp_id)
{
	if(confirm("Are you sure to delete this template?"))
	{
		$.ajax({
		   type: "POST",
		   url: 'request_process.php?calling=52',
		   data: 'tempid='+temp_id,
	
		   beforeSend: function(){
				//$("#statusdiv"+card_id).html('<img src="'+js_SERVER_ADMIN_PATH+'images/wpspin_light.gif" />');
		   },
	
		   success: function(msg){
				if(msg.search("done") != -1)
				{
					//alert('Template Deleted Successfully');
					email_template_paging('1');
				}
				
			},
			error: function() {
					//alert('Error Occured in Deletion.');
			}
		});
	}
}


 function delete_multiple_page_status(action)
{
  if(confirm('Are you sure to delete the selected pages'))
  {
	$('#pages_listing_frm').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_change_page_status_Request, 	
	success: show_change_page_status_Response, 		
	url: 'request_process.php?calling=8&action='+action 
	};
	$('#pages_listing_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
  }
}

function show_change_page_status_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function show_change_page_status_Response(responseText, statusText) 
{	
	myarray = new Array();
	myarray = responseText.split('^');
	if(responseText.search('done') != '-1')
	{
		$('#select_all').attr('checked','');
		if(myarray[1] == 0)
		{
			$('#table_options').hide();
		}
		pages_paging('1');
	}
	else
	{
		alert(responseText);
	}
}

function not_allowed(){
	
alert('Employers are not allowed to apply for a job... !');	
}


// Check And Uncheck All Categories
function check_uncheckAll()
{
	checkboxes = document.getElementsByName('chk[]');
	  
	if($('#select_all').is(":checked"))
	{
	    for(var i in checkboxes)
			checkboxes[i].checked = true;
	}
	else
	{
	     for(var i in checkboxes)
			checkboxes[i].checked = false;
	}
}


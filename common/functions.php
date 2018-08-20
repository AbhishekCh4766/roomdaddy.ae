<?php



// We will put the common funtions in this file as well.
function ifish_not_null($value) 
{
    if (is_array($value)) 
    {
      if (sizeof($value) > 0) 
      {
        return true;
      } 
      else 
      {
        return false;
      }
    } 
    else 
    {
      if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0))
      {
        return true;
      } 
      else 
      {
        return false;
      }
    }
}

// Return a random value
function ifish_rand($min = null, $max = null) 
{
    static $seeded;

    if (!isset($seeded)) 
    {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) 
    {
      if ($min >= $max) 
      {
        return $min;
      } 
      else 
      {
        return mt_rand($min, $max);
      }
    } 
    else 
    {
      return mt_rand();
    }
}

// This function get the new password randomly
function ifish_getLostPassword()
{
  $password = "";
  for ($i=0; $i<1; $i++) 
  {
        $password .= ifish_rand();
  }
  return $password; 
}

// This funstion validates a plain text password with an encrpyted password.
function ifish_validatePassword($plain, $encrypted)
{

  if (ifish_not_null($plain) && ifish_not_null($encrypted)) 
  {
      // split apart the hash / salt
      $stack = explode(':', $encrypted);

      if (sizeof($stack) != 2) 
          return false;

      if (md5($stack[1] . $plain) == $stack[0]) 
      {
        return true;
      }
  }
  return false;
}

// This function makes a new password from a plaintext password. 
function ifish_encryptPassword($plain)
{
    $password = '';

    for ($i=0; $i<10; $i++) 
    {
      $password .= ifish_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
}

/* function to validate email address*/
	function check_email_address($email)
	{
		// First, we check that there's one @ symbol, and that the lengths are right
		if (!@ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
		{
		  // Email invalid because wrong number of characters in one section, or wrong number of @ 								             symbols.
			return false;
		}
		
		// Split it into sections to make life easier
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++)
		 {
			 $listtoken = "^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$";
			 if (!@ereg($listtoken, $local_array[$i])) {
				return false;
			}
		} 
		   
		if (!@ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
		{ 
		    // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) 
			{
				return false; // Not enough parts to domain
			}
			
			for ($i = 0; $i < sizeof($domain_array); $i++) 
			{
				if (!@ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",$domain_array[$i])) 
				{
					return false;
				}
			}
		}
		
		return true;
	}
if(!defined("INPUT_TYPE_TEXT")) define("INPUT_TYPE_TEXT","TEXT");
if(!defined("INPUT_TYPE_LONG")) define("INPUT_TYPE_LONG","LONG");
if(!defined("INPUT_TYPE_INT")) define("INPUT_TYPE_INT","INT");
if(!defined("INPUT_TYPE_DOUBLE")) define("INPUT_TYPE_DOUBLE","DOUBLE");
if(!defined("INPUT_TYPE_DATE")) define("INPUT_TYPE_DATE","DATE");
if(!defined("INPUT_TYPE_DEFINED")) define("INPUT_TYPE_DEFINED","DEFINED");



function SG_Validate_Input($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
  //$theValue = mysql_real_escape_string($theValue);
  //$theValue = htmlentities($theValue);
  
  switch ($theType) 
  {
    case "TEXT":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "''";
      break;    
    case "LONG":
    case "INT":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "DOUBLE":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "DATE":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "DEFINED":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

function PageName()
{
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function pager($total, $records_per_page=10, $show_record_found='Y', $next_text, $pre_text, $first_text, $last_text, $css, $css_page)
{
	if(!isset($_GET['start']))
		$start = 0;
	else
		$start = $_GET['start'];
	
	$pager["total"] = $total;

	if($show_record_found == 'Y')
		$pager["total_records_found_text"] =  "Total Records Found: (".$pager['total'].")";
	else
		$pager["total_records_found_text"] = '';
		
	$pages = count($pager["total"]) / $records_per_page;
	$pages = ceil($pages);
	
	$val = 0;
	
	if($pager["total"] > 0 )
	{
		if($_SERVER['QUERY_STRING'] != '')
		{
			$mainurl = $_SERVER['PHP_SELF'].'?';
			$url = $_SERVER['REQUEST_URI'];
			$part = explode('?', $url);
			$piece = explode('&', $part[1]);
			if(count($piece) == 1)
			{
				if(strpos($piece[0], 'start='))
				{
					
				}
			}
			else
			{
				for ($i=0; $i<count($piece); $i++)
				{
					if(preg_match('/start=/', $piece[$i]))
					{
						
					}
					else
					{
						$mainurl .= $piece[$i].'&';
					}
				}
			}
		}
		else
		{
			$mainurl = $_SERVER['REQUEST_URI'].'?';
		}
		$pre = $start - $records_per_page;
		$pre = $pre < 0 ? '0' : $pre;
		$pager['pages_links'] =  '<li><a href="'.$mainurl.'start='.$val.'" class="'.$css.'">'.$first_text.'</a></li>'.'  ';
		$pager['pages_links'] .=  '<li><a href="'.$mainurl.'start='.$pre.'" class="'.$css.'">'.$pre_text.'</a></li>'.'  ';
	
		for ($i=1; $i<=$pages; $i++)
		{
			if($start == $val)
			{
				$pager['pages_links'] .= '<li><a href="#" class="'.$css_page.'">'.$i.'</a></li>'.'  ';
			}
			else
			{
				$pager['pages_links'] .=  '<li><a href="'.$mainurl.'start='.$val.'" class="'.$css.'">'.$i.'</a></li>'.'  ';
			}
			$val = $records_per_page + $val;
		}
		
		$next = $start + $records_per_page;
		$next = $next >= $pager["total"] ? $next - $records_per_page : $next; 
		$last = ($pages-1)*$records_per_page;
		$pager['pages_links'] .=  '<li><a href="'.$mainurl.'start='.$next.'" class="'.$css.'">'.$next_text.'</a></li>'.'  ';
		$pager['pages_links'] .=  '<li><a href="'.$mainurl.'start='.$last.'" class="'.$css.'">'.$last_text.'</a></li>';
		
		
	}
	else
	{
		$pager['pages_links'] = '';
	}

	return $pager;
}


?>
<?php

//**************************************** DB Info *****************************************

// For Beta Database
if(!defined("DB_SERVER"))       define("DB_SERVER", "localhost");
//if(!defined("DB_NAME"))			define("DB_NAME","roomdadd_roomdadd");
if(!defined("DB_NAME"))			define("DB_NAME","roomdadd_roomdadd_roomdaddy_new");
//if(!defined("DB_NAME"))			define("DB_NAME","roomdadd_leasing1");
if(!defined("DB_USER"))			define("DB_USER", "roomdadd_room");
if(!defined("DB_PASSWORD"))     define("DB_PASSWORD", '!P!L_Z33X#+Y');





//**************************************** DB Info *****************************************

function stripslashes_recursive($var)
{
	return (is_array($var) ? array_map('stripslashes_recursive', $var) : stripslashes($var));
}	

		
class DBAccess {



      var $DBlink;

      var $Result;

      var $x;

      function connectToDB()
	  {
        $this->DBlink = mysql_pconnect( DB_SERVER, DB_USER, DB_PASSWORD );
          if (!$this->DBlink)
             die("Could not connect to mysql...........".mysql_error());
	          mysql_select_db( DB_NAME, $this->DBlink)
             or die( "Couldn't connect to database : ".mysql_error() );
      }
/*
      function connectToDBOverLoad($ServerName,$UserName, $Password, $DBName)
      {
        $this->DBlink = mysql_pconnect( $ServerName, $UserName, $Password );
          if (!$this->DBlink)
              die("Could not connect to mysql");
	          mysql_select_db( $DBName, $this->DBlink)
              or die( "Couldn't connect to database : ".mysql_error() );
	  }

      function testconnection()
      {
    	if (!$this->DBlink)
     	{
          die("Could not connect to mysql : ".mysql_error());
          mysql_select_db( $DBName, $this->DBlink)
          or die( "Couldn't connect to database : ".mysql_error() );
      	}
      	else
      	{
	      echo "Congrats";
      	}
      }

*/

      //function to check the prexistance of a field

      function GetRecord($table, $fnm, $fval)

      {

          $this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm='$fval'" , $this->DBlink );

          if ( ! $this->Result )

          die( "getRow fatal error: ".mysql_error() );

          return mysql_fetch_array( $this->Result );

      }



      //function to check username and password

      function GetNumberOfRecordsOverloaded($table, $fnm, $fval, $fnm1, $fval1)

      {

	       //echo "SELECT * FROM $table WHERE $fnm='".$fval."' && $fnm1='".$fval1."'";

           $this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm='".$fval."' && $fnm1='".$fval1."'" , $this->DBlink );

           if ( ! $this->Result )

		       die( "getRow fatal error: ".mysql_error() );

		   

		  

		     //echo   mysql_num_rows( $this->Result );

           return mysql_num_rows( $this->Result );

      }



      //getting total no of a particular record

      function GetNumberOfRecords($table, $fnm, $fval)

      {

		   $this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm = '$fval'" , $this->DBlink );

		   

           if ( ! $this->Result )

           die( "getRow fatal error: ".mysql_error() );

           return mysql_num_rows( $this->Result );

	  }



       //getting total no of a particular record

       function OverloadsGetNumberOfRecord($table, $fnm, $fval,$fnm1, $fval1)

       {

    		$this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm='$fval'&&$fnm1='$fval1'" , $this->DBlink );

    		if ( ! $this->Result )

       			die( "getRow fatal error: ".mysql_error() );

    		return mysql_num_rows( $this->Result );

		}

		

		//function to get the manximum of all

		function GetRecordByCriteria($table, $fnm, $fval, $required)

		{

		    $this->Result = mysql_query ( "SELECT $required FROM $table WHERE $fnm='$fval'" , $this->DBlink );

		    if ( ! $this->Result )

		        return false;

		

		    while($row= mysql_fetch_array( $this->Result )){

		        $back = $row["$required"];

		    }

		    return $back;

		}



		//function to get the manximum of all

		function GetRecordByCriteriaOverloads($table, $required)

		{

		    $this->Result = mysql_query ( "SELECT $required FROM $table " , $this->DBlink );

		    if ( ! $this->Result )

		        return false;

		

		    while($row= mysql_fetch_array( $this->Result )){

		        $back = $row["$required"];

		    }

		    return $back;

		}

		

		function OverloadsGetDistinctRecordByCriteria($table, $required)

		{
		    $this->Result = mysql_query ( "SELECT DISTINCT $required FROM $table " , $this->DBlink );

		    if ( ! $this->Result )
	        return false;
		    while($row= mysql_fetch_array( $this->Result )){

		        $back[] = $row["$required"];
		    }
		    return $back;

		}

		

		//function to insert data into the table

		function InsertRecord($table, $insert, $vals)
		{
				  $sql=" INSERT INTO $table ($insert) VALUES ($vals)";
				 // echo $sql;exit;
			      $this->Result = mysql_query($sql , $this->DBlink);
			       $id = mysql_insert_id( $this->DBlink);			     
		          return $id;//mysql_insert_id( $this->DBlink);
		}
		//function to retrieve a single field
		function GetSingleField($table, $fnm, $fval, $required)
		{
			$this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm='$fval'" , $this->DBlink );

		    if ( ! $this->Result )
				{ 
				return false;
				}

		    while($row= mysql_fetch_array( $this->Result )){
			        $back = $row["$required"];

		    }

		    return $back;

		}

		

		function OverloadsGetSingleField($table, $fnm, $fval, $fnm1, $fval1, $required)

		{

			$this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm='$fval' && $fnm1='$fval1'" , $this->DBlink );

		    if ( ! $this->Result )

		       die( "getRow fatal error: ".mysql_error() );

		    while($row= mysql_fetch_array( $this->Result )){

		        $back = $row["$required"];

		        

		    }

		    return $back;

		

		}

		

		function getSingleFieldCustomQuery($Query_C){

		

			$this->Result = mysql_query ($Query_C , $this->DBlink );

		    if ( ! $this->Result )

				return false;

		

		    while($row= mysql_fetch_array( $this->Result )){

			

		        $back = $row[0];

		    

		    }

		    

		    return $back;

		}

		

		

		//function to get an array of something

		function ArrayOfSingleField($table, $fnm, $fval, $required)

		{

		    $this->Result = mysql_query ( "SELECT * FROM $table WHERE $fnm='$fval'" , $this->DBlink );

		    if ( ! $this->Result )

		       die( "getRow fatal error: ".mysql_error() );

		    while($row= mysql_fetch_array( $this->Result )){

				

		        $RecArray[] = $row["$required"];

		    }

		    return $RecArray;

		

		}

		

		

		//function to modify an existing record

		function ModifyRecord($table, $fnm, $fval, $fnm1, $fval1)

		{

		    $query="UPDATE $table set $fnm='$fval' WHERE $fnm1='$fval1'";

			//echo $query;

		    $this->Result = mysql_query($query, $this->DBlink);

		    

		      //echo mysql_affected_rows($this->DBlink);

		    if( mysql_affected_rows($this->DBlink) > 0)

		    	return true;

			else

			     return false;

		    	

		   // if (! $this->Result)

		    if (! $this->Result)

		       return false;
		       

		    return true;

		

		}

		

		//function to modify fields by passing query

		function CustomModify($Cquery)

		{
			$query=$Cquery;
		    $this->Result = mysql_query($query, $this->DBlink);

		    if (! $this->Result)

		       return false;	

			   if(mysql_affected_rows($this->DBlink) > 0)

			      return true;

			   else

				  return false;

		       return true;

		}

		function CustomModifyExt($Cquery)
		{
			$query=$Cquery;
		    $this->Result = mysql_query($query, $this->DBlink);

		    if ($this->Result)
		       return true;
			else
				return false;
		}


		//fucntion to modify existing field with two where parammeters

		function OverloadsModifyRecord($table, $fnm, $fval, $fnm0, $fval0, $fnm1, $fval1)

		{

		    $query="UPDATE $table set $fnm1='$fval1' WHERE $fnm='$fval'&&$fnm0='$fval0'";

		    $this->Result = mysql_query($query, $this->DBlink);

		    if (! $this->Result)

		       die("updateOrg update error: ".mysql_error() );

		

		}

		

		//function to delete a whole record

		function DeleteSingleRecord($table, $frn, $fval, $frn1, $fval1)

		{

		    $query="DELETE FROM $table WHERE $frn='$fval' && $frn1='$fval1'";

		    $this->Result = mysql_query($query, $this->DBlink);

		    if (! $this->Result)

		       return false;

		       

		     return true;

		

		}

		

		//delete function

		//function to delete a whole record

		function DeleteSetOfRecords($table, $frn, $fval)

		{

		   

			$query = "Delete from $table Where $frn=$fval";

			//echo $query;

		    $this->Result = mysql_query($query, $this->DBlink);

			

		    if (! $this->Result)

		       return false;

			   if(mysql_affected_rows($this->DBlink) > 0)

			      return true;

			   else

				  return false;

		       

		     return true;

		

		}	


		function CustomQuery($Query_C)
		{
			$Return_Result[]=NULL;
		    $Count=0;
		    $Query = "$Query_C";

		    $Show_Query_Reuslt = mysql_query($Query, $this->DBlink) or die(mysql_error());
		    $Query_Result_Final = mysql_fetch_assoc($Show_Query_Reuslt);

		    do
		    {
		        $Return_Result[$Count]=$Query_Result_Final;
		        $Count++;
		    }
		    while($Query_Result_Final = mysql_fetch_assoc($Show_Query_Reuslt));    
			
			$Return_Result = stripslashes_recursive($Return_Result);
			
		    return $Return_Result;
		}

		//funtion to free and close sql result and connection

		function DBDisconnect()
		{

			if(!$this->Result){}else{

		   }

		    mysql_close($this->DBlink);

		

		}

		

}

// Used to remove the maliciouse code of SQL injection of hackers
function validate_input($value)
{
	$db = new DBAccess();
	$db->connectToDB();
	
	if (get_magic_quotes_gpc())
    {
  		$value = stripslashes($value);
  	}
	
	// Quote if not a number
	if (!is_numeric($value))
	{
  		$value = mysql_real_escape_string($value);
    }
    
    $db->DBDisconnect();
	return $value;
}

?>
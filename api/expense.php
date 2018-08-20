<?php


require 'common.php';
 


 $sql="SELECT * FROM tbl_expense ";


$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc())
     {
        //echo"<pre/>";
         echo json_encode($row);
      }
    echo "success";
 } 
else {
       echo "0 results";
      }

       

mysqli_close($con);
?>
<?php

require 'common.php';

 

 $sql="select `fld_id`,`fld_name` from tbl_admin ";

class ArrayValue implements JsonSerializable {
    public function __construct(array $array) {
        $this->array = $array;
    }

    public function jsonSerialize() {
        return $this->array;
    }
}

$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
    $bus = array(
        
        'id' => $row['fld_id'],
        'Name' => $row['fld_name'],
        //'Building' => $row['building_id'],
      
    );
    array_push($json, $bus);
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

    //echo json_encode("[Status:True, Msg:Successfull]");

}
else {
       echo json_encode("No Owner Found");
       echo json_encode("[Status:True, Msg:Successfull]");
}

mysqli_close($con);

?>
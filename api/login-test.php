<?php

require 'common.php';

  $id = $_REQUEST['id'];


 $sql="SELECT * from `tbl_building` WHERE `fld_tanent`=$id AND `fld_approved` != 0";


class ArrayValue implements JsonSerializable {
    public function __construct(array $array) {
        $this->array = $array;
    }

    public function jsonSerialize() {
        return $this->array;
    }
}

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($array = $result->fetch_assoc()) {
      //echo"<pre/>";
        // echo json_encode([$row]);
         //echo json_encode("success");
      echo "<pre/>";
       echo json_encode(new ArrayValue($array, true), JSON_PRETTY_PRINT);

    }
    //echo json_encode(["Status : success"]);
    echo json_encode("[Status:True, Msg:Successfull]");
} 
else {
       echo "0 results";
}

mysqli_close($con);

?>
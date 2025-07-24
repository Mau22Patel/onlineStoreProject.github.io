<?php
//Connect to the productdb
include_once ("conn_db.php");
$query = "SELECT * FROM product";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    //mysqli obj comes from conn_productdb.php
    //prepare dont run a query
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    // print_r($result);
    while($row = $result->fetch_assoc()){
        //fetch->row() you use $row[0] $row[1] for access
        echo $row["productName"]." ".$row["productPrice"]." ".$row["qty"]."".$row["imagePath"]."<br/>";
    }
}catch(Exception $e){
    error_log($e->getMessage());
    exit("Error connecting to the table");
}
$mysqli->close();

?>
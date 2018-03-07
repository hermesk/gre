<?php
require 'check.php';

$location=$_POST['postlocation']; 
$size=$_POST['postsize'];

 $params = array( array($location),array($size)); 
 $callSP = "{call spplotno(?,?)}";   //call stored procedure

/* Execute the query. */  
$stmt = sqlsrv_query( $conn, $callSP, $params);  
if( $stmt === false )  
{  
     echo "Error in executing statement.\n";  
     die( print_r( sqlsrv_errors(), true));  
} 

else {

    while($row = sqlsrv_fetch_array($stmt)){
     
       echo '<option value = ' . $row[0]. '>' . $row[0] . ' </option>';
    }
  } 

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

?>


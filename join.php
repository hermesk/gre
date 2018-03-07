<?php
      

$ref = trim($_POST['name']);
require 'connect.php';

$checkref ="SELECT COUNT(*) as total FROM house_trx WHERE reference='$ref'";
      $stmt = sqlsrv_query( $conn, $checkref );
   
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
           
            if ($row['total']>0) {
            	echo "exist";
            //echo "true" ;
            }
            else{
             //echo "no";

            }
            
        }
  

?>
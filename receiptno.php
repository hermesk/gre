<?php
  require 'connect.php';


   $sql="SELECT TOP 1 rno FROM receipts ORDER BY rno DESC";

   $stmt = sqlsrv_query($conn,$sql);
   while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            $rctno= $row['rno']+1;
     
         echo json_encode( array("rn" => $rctno));
                           
        }

?>
<?php

$ref = trim($_POST['postref']);

require 'connect.php';

             $sql =" SELECT count(*) as total FROM receipts WHERE reference='$ref'";
        
                $stmt =sqlsrv_query($conn,$sql);
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                  

                   if ($row['total']>0) {
                       echo "Reference no: $ref already exist" ;
            }
           

                }
               

?>
<?php


$ref = trim($_POST['postref']);
require 'connect.php';
          
            $sql ="SELECT ( SELECT count(*) FROM house_trx WHERE reference='$ref')
                     + ( SELECT count(*) FROM land_trx WHERE reference='$ref') 
                       as total";
        
                $stmt =sqlsrv_query($conn,$sql);
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                  
                   if ($row['total']>0) {
                       echo "Reference no: $ref already exist" ;
            }
           
                }
               
               

?>
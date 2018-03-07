<?php
require 'check.php';
$idno = trim($_POST['postid']);



           
            $sql =" SELECT count(*) as total FROM investors_details WHERE id='$idno'";
        
                $stmt =sqlsrv_query($conn,$sql);
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                  
                   if ($row['total']>0) {
                       echo "Identification no: $idno already exist" ;
            }
           }
                     sqlsrv_free_stmt( $stmt);
                     sqlsrv_close( $conn );


?>
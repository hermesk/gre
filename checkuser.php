<?php
require 'check.php';
$uname = trim($_POST['postuname']);



           
            $sql =" SELECT count(*) as total FROM users WHERE username='$uname'";
        
                $stmt =sqlsrv_query($conn,$sql);
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                  
                   if ($row['total']>0) {
                       echo "Username: $uname already exist" ;
            }
           }
                     sqlsrv_free_stmt( $stmt);
                     sqlsrv_close( $conn );


?>
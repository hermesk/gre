<?php
//require 'check.php';

function landsize(){
         require 'connect.php';
        $sql = "SELECT EIGHTH FROM YATTA ";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            echo '<option value = "' . $row['EIGHTH']. '">' . $row['EIGHTH'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );
     }  
     
?>
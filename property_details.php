<?php 
     
     function landsize(){
         require 'connect.php';
        $sql = "SELECT land FROM property_sizes WHERE land IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            echo '<option value = "' . $row['land']. '">' . $row['land'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );
     }  

     function housesize(){
        require 'connect.php';
        $sql = "SELECT house FROM property_sizes WHERE house IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              
            echo '<option value = "' . $row['house']. '">' . $row['house'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

     }        
        function location(){
        require 'connect.php';
       $sql = "SELECT location FROM locations";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            
            echo '<option value = "' . $row['location']. '">' . $row['location'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

           }
   ?>
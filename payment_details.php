<?php 
       
       function pmode(){ //payment mode
        require 'connect.php';
        

        $sql = "SELECT pmode FROM trxdetails WHERE pmode IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            echo '<option value = "' . $row['pmode']. '">' . $row['pmode'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt); 
        sqlsrv_close( $conn );

       }

        function ptype(){  //payment type
           require 'connect.php';

           $sql = "SELECT ptype FROM trxdetails WHERE ptype IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            echo '<option value = "' . $row['ptype']. '">' . $row['ptype'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

        }
          
          function trxtype(){  //transaction  type cr/dr
            require 'connect.php';

        $sql = "SELECT trxtype FROM trxdetails WHERE trxtype IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              
             echo '<option value = "' . $row['trxtype']. '">' . $row['trxtype'] . ' </option>"';
              
                    }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );


          }
          
function investtype(){  //payment type
           require 'connect.php';

           $sql = "SELECT investtype FROM trxdetails WHERE investtype IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            echo '<option value = "' . $row['investtype']. '">' . $row['investtype'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

        }
        function charge(){  //charge type
           require 'connect.php';

           $sql = "SELECT charge FROM trxdetails WHERE charge IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
             
            echo '<option value = "' . $row['charge']. '">' . $row['charge'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

        }

        ?>      
       
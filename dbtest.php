<?php
      require 'connect.php';
      //$location = trim($_POST['postloc']);

         // $location = 'CGC'

        $sql = "SELECT JOSKA FROM plotnos WHERE JOSKA IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        $row_count = sqlsrv_num_rows( $stmt);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
           while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
           // $plotno = $row['JOSKA'];
            echo '<option value = "' . $row['JOSKA']. '">' . $row['JOSKA'] . ' </option>"';
            //echo($plotno);
            //echo '<input type="checkbox"  value="'. $row['JOSKA']. '" > ' . $row['JOSKA'] ;
          
           
            
         }

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );
            ?>



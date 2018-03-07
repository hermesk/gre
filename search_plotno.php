<?php
     require 'connect.php';
      //$location = trim($_POST['postloc']);

          $location = 'CGC';

        $sql = "SELECT ".$location." FROM plotnos WHERE ".$location." IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        $row_count = sqlsrv_num_rows( $stmt);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
           if( sqlsrv_fetch( $stmt ) === false) {
                 die( print_r( sqlsrv_errors(), true));
               }
            $name = sqlsrv_get_field( $stmt, 0);
            echo "$name: ";

         /*while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            //$plotno = $row[.$location.];
            //echo '<option value = "' . $row['JOSKA']. '">' . $row['JOSKA'] . ' </option>"';
            echo($row_count);
          
           
            
         }*/
        
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );
            
            /*DECLARE @tableplotnos NVARCHAR(128)
            DECLARE @loc NVARCHAR(50)
            DECLARE @sql NVARCHAR(MAX)
            set @tableplotnos=N'plotnos'
            set @loc ='$location' 
            set @sql = N'SELECT ' +@loc + '  FROM plotnos ' 
            EXEC sp_executesql @sql 
            PRINT @loc*/





        ?>
        
        
    

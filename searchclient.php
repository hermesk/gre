 
<?php 
require 'check.php';
 $idno=  $_POST['postid'];

 
      $sql = "SELECT * FROM client_details WHERE ID = '$idno'";

        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
     
        if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                   
             $name =$row['name'];
             $idno =$row['ID'];
             $phoneno =$row['phoneno'];
             $branch =$row['branch'];

             echo json_encode( array("name" => $name, "no" => $idno, "phoneno" => $phoneno, "branch" => $branch));
             

          
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

   }
         ?>
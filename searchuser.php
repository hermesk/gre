 
<?php 
  require 'check.php';
  $uname=  $_POST['postuname'];



 
 
      $sql = "SELECT * FROM users WHERE username = '$uname'";

        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
     
        if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                   
             $name =$row['name'];
             $uname =$row['username'];
             $password =$row['password'];
             $branch =$row['branch'];
             $level =$row['level'];

            echo json_encode( array("name" => $name, "uname" => $uname, "pass" => $password, "branch" => $branch, "level" => $level));
             

          
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

   }
         ?>
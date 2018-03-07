<?php
require 'check.php';

 /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 
    
    $name = trim($_POST['postname']);
    $username = trim($_POST['postusername']);
    $pass = trim($_POST['postpass']);
    $passpass =stripcslashes($pass);
    $pass =sha1($pass);
    $branch = trim($_POST['postbranch']);
    $level = trim($_POST['postlevel']);
 
    $user = $_SESSION['username'];


      $sqlup = "UPDATE users SET name='$name',password ='$pass',branch='$branch', level='$level', createdby='$user'
                WHERE username= '$username'"; 
                     
       $stmt = sqlsrv_query($conn,$sqlup);
     
         if( $stmt ) {
                sqlsrv_commit( $conn );
           echo " User Updated successfully";
        
              }
              else{
        die( print_r( sqlsrv_errors(), true));
                  sqlsrv_rollback( $conn );
                      echo "Failed";
              }
   
                    sqlsrv_free_stmt( $stmt);
                     sqlsrv_close( $conn );
  
  ?>
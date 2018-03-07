<?php
require 'check.php';

 /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 
    
    $name = trim($_POST['postname']);
    $idno = trim($_POST['postid']);
    $phoneno = trim($_POST['postphone']);
    $branch = trim($_POST['postbranch']);
     
    $user = $_SESSION['username'];


      $sqlup = "UPDATE client_details SET name='$name',phoneno ='$phoneno',branch='$branch', createdby='$user'
                WHERE ID= '$idno'"; 
                     
       $stmt = sqlsrv_query($conn,$sqlup);
     
         if( $stmt === false ) {
           die( print_r( sqlsrv_errors(), true));
              }
              else{
           sqlsrv_commit( $conn );

           echo " client updated successfully";

              }
   
                    sqlsrv_free_stmt( $stmt);
                     sqlsrv_close( $conn );
  
  ?>
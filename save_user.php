<?php
 if(isset($_REQUEST['attempt'])){
  require 'check.php';
  
  /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    }
 
    $name = trim($_POST['name']);
    $uname = trim($_POST['user']);
    $level = trim($_POST['level']);
    $branch = trim($_POST['branch']);
    $pwd = trim($_POST['pass']);
    $pwd =stripcslashes($pwd);
    $pwd =sha1($pwd);
    $name =stripcslashes($name);
    $uname= stripcslashes($uname);
    $user = $_SESSION['username'];

    $sql="INSERT INTO users (name,username,password,level,branch,createdby)  VALUES(?,?,?,?,?,?)";

    $params = array($name,$uname,$pwd,$level,$branch,$user);

     $stmt = sqlsrv_query( $conn, $sql, $params);
   
       if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
      }
   
      else{
        sqlsrv_commit( $conn );
      	  $_SESSION['svMsg'] = "User Saved" ;
      	  header("location:sign.php");
         
       }

                  sqlsrv_free_stmt( $stmt);
                  sqlsrv_free_stmt( $stmtc); 
                  sqlsrv_close( $conn );
  
}
                   


?>
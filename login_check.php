<?php
session_start();
require 'connect.php'; //connect to db

if(isset($_REQUEST['attempt'])){

    //prevent sql injections
     $username = stripcslashes($_POST["username"]);
     $password = stripcslashes($_POST["password"]);
     $username = trim($username);
     $password = trim($password);
     $password = sha1($password);

      $sql = "SELECT username,level,branch FROM users WHERE username = '$username' and password ='$password'";
      $params = array();

      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $stmt = sqlsrv_query( $conn, $sql , $params, $options );
      $row_count = sqlsrv_num_rows( $stmt );

      if($row_count==1){
    if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
         $level =$row['level'];
         $branch =$row['branch'];
         $_SESSION['username']=$username;
         $_SESSION['level']=$level;
         $_SESSION['branch']=$branch;
          header("location:home.php");
          exit();
       }

        
       }
      
      else {
         $_SESSION['errMsg'] = "Invalid username or password";

           header("location:login.php");
}
  }
  sqlsrv_close( $conn );

 

?>
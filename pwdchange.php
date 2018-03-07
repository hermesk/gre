<?php
require 'check.php';

    $opwd = trim($_POST['opass']);
    $pwd = trim($_POST['pass']);
    $pwd =sha1($pwd);
    $opwd =sha1($opwd);
    $user = $_SESSION['username'];

    $sql = "SELECT count(*) as total FROM users WHERE username = '$user' AND password='$opwd'";
 
    $stmt = sqlsrv_query( $conn, $sql );

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                  
        if ($row['total']==1) {
           
            $sqlup = "UPDATE users SET password ='$pwd'  WHERE username= '$user'"; 
                     
            $stmt2 = sqlsrv_query($conn,$sqlup);

          if( $stmt === false ) {
           die( print_r( sqlsrv_errors(), true));
              }
             
              else{

               echo '<script language="javascript">';
               echo 'alert("Password Updated.Logging out");window.location.href = "logout.php"';
               echo '</script>';
              
         }
            }
           else{
           
             $_SESSION['Msg'] = "Wrong Old password " ;
                header("location:changepassword.php");
           }

                }
     
    
  
  ?>
<?php
//$serverName = "IT\GAKUYO"; //serverName//instanceName
//$serverName = "JIM"; //serverName//instanceName
//$serverName = "192.168.0."; //serverName//instanceName
$serverName = "127.0.1.1";

$connectionInfo = array( "Database"=>"gakuyo", "UID"=>"dab", "PWD"=>"3306");
$conn = sqlsrv_connect( $serverName, $connectionInfo) ;
if( !$conn ) {
    //echo "unable to connect to the server<br />";
    $_SESSION['errMsg'] = "Unable to Connect to the Server";
    header("location:login.php");
          exit();
  
}
 

?>
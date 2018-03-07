<?php 

function branches(){

   require 'connect.php';
  
   $sql = "SELECT branchname FROM branches";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
         
       echo '<option value = "' . $row['branchname']. '">' . $row['branchname'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
  }

    function level(){

   require 'connect.php';
  
   $sql = "SELECT level FROM branches WHERE  level IS NOT NULL";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
         
       echo '<option value = "' . $row['level']. '">' . $row['level'] . ' </option>"';
            
        }

        sqlsrv_free_stmt( $stmt);
  }  

  
   function csave(){

   require 'connect.php';
    $clientname = trim($_POST['cname']);
    $clientid = trim($_POST['cid']);
    $phoneno = trim($_POST['phoneno']);
    $clientname =stripcslashes($clientname);
    $clientid = stripcslashes($clientid);
    $phoneno = stripcslashes($phoneno);
    $branch = trim($_POST['branch']);
    $ttle = trim($_POST['ttle']);

     //check whether identification exist.
       
      $sqlc = "SELECT ID FROM client_details WHERE ID ='$clientid'";
      $paramsc = array();

      $optionsc =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $stmtc = sqlsrv_query( $conn, $sqlc , $paramsc, $optionsc );
      $row_count = sqlsrv_num_rows( $stmtc );

      if($row_count==0){
            //insert into db
    $sql="INSERT INTO client_details (ID,title,name,phoneno,branch)  VALUES(?,?,?,?,?)";

    $params = array($clientid,$ttle,$clientname,$phoneno,$branch);

     $stmt = sqlsrv_query( $conn, $sql, $params);
   
       if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
      }

      else{
          ob_start();
         //$_SESSION['savedMsg'] = "Data Saved Successfully";
            //header("dashboard.php");
          echo "<script language='javascript' type='text/javascript'>";
          //echo "alert('Data Saved Successfully')";
          echo 'window.location.href = "dashboard.php";';
          echo "</script>";

      }
      
      }
      else{
          $_SESSION['errMsg'] = "identification already exist";
          header("location:clientmaintainance.php");
         
       }

   
  
}
  



  

?>

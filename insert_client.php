<?php
 if(isset($_REQUEST['attempt'])){
  require 'check.php';
  
 /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    }

    else{
    $clientname = trim($_POST['cname']);
    $clientid = trim($_POST['cid']);
    $phoneno = trim($_POST['phoneno']);
    $clientname =stripcslashes($clientname);
    $clientid = stripcslashes($clientid);
    $phoneno = stripcslashes($phoneno);
    $branch = trim($_POST['branch']);
    $user = $_SESSION['username'];

     //check whether identification exist.
       
      $sqlc = "SELECT ID FROM client_details WHERE ID ='$clientid'";
      $paramsc = array();

      $optionsc =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $stmt = sqlsrv_query( $conn, $sqlc , $paramsc, $optionsc );

        if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
      }
      else{
        $row_count = sqlsrv_num_rows( $stmt );
         if($row_count<1){
            //insert into db
    $sql="INSERT INTO client_details (ID,name,phoneno,branch,createdby)  VALUES(?,?,?,?,?)";

    $params = array($clientid,$clientname,$phoneno,$branch,$user);

     $stmt1 = sqlsrv_query( $conn, $sql, $params);
   
       if( $stmt1 === false ) {
     die( print_r( sqlsrv_errors(), true));
      }

      else{
        sqlsrv_commit( $conn );
       
          echo '<script language="javascript">';
          echo 'alert("Client Saved");window.location.href = "home.php"';
          echo '</script>';
      }
      
      }
      else{
          $_SESSION['errMsg'] = "Identification Already Exist" ;
          header("location:clientmaintainance.php");
         
       }
      }
    }
      
                     sqlsrv_free_stmt( $stmt);
                     sqlsrv_free_stmt( $stmt1); 
                     sqlsrv_close( $conn );

   
  
}
                    


?>
<?php
 if(isset($_REQUEST['attempt'])){
  require 'check.php';

  /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    }
 
     //$user = $_SESSION['username'];

    
		$location=$_POST['loc']; 
		$location= strtoupper($location);
		$params = array( $location); 
		$callSP = "{call proc_newlocation(?)}";   //call stored procedure
         /* Execute the query. */  
        $stmt = sqlsrv_query( $conn, $callSP, $params);  

		     $sql1 ="INSERT INTO locations  values('$location')";
        $stmt1 = sqlsrv_query( $conn, $sql1);
		
 
     if( $stmt1 && $stmt ) {
        sqlsrv_commit( $conn );
      	$_SESSION['svMsg'] = "location Added Successfuly" ;
         header("location:properties.php");
        
      }
   
      else{

        sqlsrv_rollback( $conn );
      	$_SESSION['svMsg'] = "LOCATION ALREADY EXIST" ;
         header("location:properties.php");
       
       }
                  sqlsrv_free_stmt( $stmt);
                  sqlsrv_free_stmt( $stmt1);
                  sqlsrv_close( $conn ); 

}
?>


<?php
if(isset($_REQUEST['attempt'])){
require 'check.php';
/* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    }
		$location=$_POST['location']; 
		$size=  $_POST['size'];
		//$size= '[$size]';
		$start =$_POST['from'];
		$end = $_POST['to'];


		$params = array( $location,$size,$start,$end); 
		$callSP = "{call s_addplotno(?,?,?,?)}";   //call stored procedure

		/* Execute the query. */  
		$stmt = sqlsrv_query( $conn, $callSP, $params);  
		if( $stmt){ 

        sqlsrv_commit($conn );
      	$_SESSION['svMsg'] = "Plot Numbers Added Successfuly" ;
         header("location:addnewplotnos.php");
       } 

		else {
	
		     die( print_r( sqlsrv_errors(), true));  
		    
		  } 
   

        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );
}
?>


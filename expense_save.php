<?php
 if(isset($_REQUEST['attempt'])){
  require 'check.php';
  
  /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 

    $name = trim($_POST['pname']);
    $amount = trim($_POST['num']);
    $amount = str_replace(array(',', ' '), '' , trim($amount));
    $nar = trim($_POST['nrt']);
    $pdate = trim($_POST['pdate']);
    $rctno = trim($_POST['rctno']);
    $ref = trim($_POST['ref']);
    $pmode = trim($_POST['pmode']);

    $sql="INSERT INTO expenses (pdate,payee,amount,description,rctno)  VALUES(?,?,?,?,?)";

    $params = array($pdate,$name,$amount,$nar,$rctno);

     $stmt = sqlsrv_query( $conn, $sql, $params);

        //insert into receipts

                     $rctsql = "INSERT INTO receipts(pdate,idno,pmode,description,amount,reference,rctno)
                                    VALUES(?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$name,$pmode,$nar,$amount,$ref,$rctno);
                     $stmt2 = sqlsrv_query( $conn,$rctsql,$rctparams);
   
       if( !$stmt || !$stmt2 ) {
     die( print_r( sqlsrv_errors(), true));
      }

      else{
        sqlsrv_commit( $conn );
      	 $_SESSION['svMsg'] = "Saved" ;
          header("location:expenses.php");

      }

                     sqlsrv_free_stmt( $stmt);
                     sqlsrv_close( $conn );
   
  
}
                    


?>
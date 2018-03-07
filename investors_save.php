<?php
require 'check.php';
  /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 

 else{
  /* Initialize parameter values. */

   $pdate = trim($_POST['postpdate']);
   $tdate = trim($_POST['posttdate']);
   $idno= trim($_POST['postidno']);
   $trx=trim($_POST['posttrx']);
   $num = trim($_POST['postamnt']);
   $pmode = trim($_POST['postpmode']);
   $ref = trim($_POST['postref']);
   $rate = trim($_POST['postrate']);
   $intr= trim($_POST['postintr']);
   $pmnt= trim($_POST['postpmnt']);
   $tax= trim($_POST['posttax']);
   $rctno = trim($_POST['postrno']);
   $user = $_SESSION['username'];

   $sql = "INSERT INTO investors(pdate,tdate,id,type,amount,pmode,reference,rate,interest,payment,tax,rctno,username)
           	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $params= array($pdate,$tdate,$idno,$trx,$num,$pmode,$ref,$rate,$intr,$pmnt,$tax,$rctno,$user);

    $stmt = sqlsrv_query($conn,$sql,$params);
     //insert into receipts

                     $rctsql = "INSERT INTO receipts(pdate,tdate,idno,pmode,location,size,description,amount,reference,rctno,username)
                                    VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$tdate,$idno,$pmode,$rate,$pmnt,$trx,$num,$ref,$rctno,$user);


                     $stmt1 = sqlsrv_query( $conn,$rctsql,$rctparams);

             if( $stmt && $stmt1) 
                    {
                      sqlsrv_commit( $conn ); 
                      echo "Transaction Saved"; 
                  
                    }

                   else{
                   	die( print_r( sqlsrv_errors(), true));
                      sqlsrv_rollback( $conn );
                      echo "Transaction Rolled back"; 
           }}
                   
                    sqlsrv_free_stmt( $stmt);
                     sqlsrv_free_stmt( $stmt1); 
                     sqlsrv_close( $conn );


?>
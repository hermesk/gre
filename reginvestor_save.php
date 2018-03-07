<?php
     
  require 'check.php';
  /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 
 else{
  /* Initialize parameter values. */
   $pdate = trim($_POST['postpdate']);
   $name = trim($_POST['postname']);
   $idno= trim($_POST['postidno']);
   $acc=trim($_POST['postacc']);
   $bkbr = trim($_POST['postbkbr']);
   $bkname= trim($_POST['postbkname']);
   $phoneno= trim($_POST['postphoneno']);
   $kra= trim($_POST['postkra']);
   $num = trim($_POST['postamnt']);
   $pmode = trim($_POST['postpmode']);
   $ref = trim($_POST['postref']);
   $rctno = trim($_POST['postrno']);
   $user = $_SESSION['username'];
   $nar ="Investors Club Registration";
       //check whether identification exist.
      

        $sql ="INSERT INTO investors_details (pdate,id,name,phone,account,bankbranch,bankname,pmode,regamount,krapin,reference,receiptno,username)
               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

      	$params = array($pdate,$idno,$name,$phoneno,$acc,$bkbr,$bkname,$pmode,$num,$kra,$ref,$rctno,$user);
        $stmt = sqlsrv_query( $conn, $sql, $params);

         
          //insert into receipts

                     $rctsql = "INSERT INTO receipts(pdate,idno,pmode,description,amount,reference,rctno,username)
                                    VALUES(?,?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$idno,$pmode,$nar,$num,$ref,$rctno,$user);


                     $stmt1 = sqlsrv_query( $conn,$rctsql,$rctparams);

      	 if ($stmt && $stmt1) {
      	 	sqlsrv_commit( $conn );
      	 
      	 }
      	 else{
      	 	die( print_r( sqlsrv_errors(), true));
      	 	 sqlsrv_rollback( $conn );
             echo "Transaction Rolled back";
      	 }
      	     

}
                     sqlsrv_free_stmt( $stmt);
                     sqlsrv_free_stmt( $stmt1); 
                     sqlsrv_close( $conn );


?>
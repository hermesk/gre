<?php
require 'check.php';

 /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 
    else{
           $pdate = trim($_POST['postpdate']);
           $name = trim($_POST['postname']);
           $idno= trim($_POST['postidno']);
           $acc=trim($_POST['postacc']);
           $bkbr = trim($_POST['postbkbr']);
           $bkname= trim($_POST['postbkname']);
           $phoneno= trim($_POST['postphoneno']);
           $kra= trim($_POST['postkra']);


          $sqlu = "UPDATE investors_details SET name ='$name',account ='$acc',bankname='$bkname', bankbranch='$bkbr',
                      phone='$phoneno',krapin='$kra'  WHERE id= '$idno'"; 
                     
                      $stmt = sqlsrv_query($conn,$sqlu);
      if ($stmt) {
      	 	sqlsrv_commit( $conn );
      	 	echo " Successfuly Updated";
      	 
      	 }
         else{
          die( print_r( sqlsrv_errors(), true));
         }

    }
 
?>
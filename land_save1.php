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
   $ptype= trim($_POST['postptype']);
   $location=trim($_POST['postlocation']);
   $idno = trim($_POST['postidno']);
   $size= trim($_POST['postsize']);
   $cost= trim($_POST['postcost']);
   $plotno= trim($_POST['postplotno']);
   $trxtype= trim($_POST['posttrxtype']);
   $num = trim($_POST['postamnt']);
   $pmode = trim($_POST['postpmode']);
   $ref = trim($_POST['postref']);
   $nar = trim($_POST['postnrt']);
   $rctno = trim($_POST['postrno']);
   $user = $_SESSION['username'];

    $fpm="Full Payment ";
    $inst = "Installment";
    $bk = "Booking";
    $wd = "Withdrawal";
    $tr = "Transfer";
    $tc = "Credit";
    $td = "Debit";
  

       if ($ptype==$bk || $fpm && $trxtype==$tc ) {
         
              $sql="INSERT INTO land_trx (pdate,tdate,ptype,location,idno,size,cost,plotno,credit,debit,pmode,reference,description,username)
                           VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                     $params = array($pdate,$tdate,$ptype,$location,$idno,$size,$cost,$plotno,$num,$cost,$pmode,$ref,$nar,$user);
                     $stmt = sqlsrv_query( $conn, $sql, $params);

                     //insert into receipts

                     $rctsql = " INSERT INTO receipts (pdate,tdate,idno,location,size,plotno,pmode,description,amount,reference,rctno,username)
                                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$tdate,$idno,$location,$size,$plotno,$pmode,$nar,$num,$ref,$rctno,$user);


                     $stmt1 = sqlsrv_query( $conn,$rctsql,$rctparams);
                      
                      //update plot numbers
                      //$sqlu = "UPDATE plotnos SET ".$location."=NULL  WHERE ".$location."= '$plotno'"; 
                      $sqlu ="DELETE FROM plotnos WHERE ".$location."= '$plotno'";
                     
                      $stmt2 = sqlsrv_query($conn,$sqlu);
                     
                    
                     if( $stmt && $stmt1) {

                        sqlsrv_commit( $conn );
                      
                       }

                   else{
                      sqlsrv_rollback( $conn );
                      echo "Transaction Rolled back";
                   }
       }
      
      else if ($ptype==$inst && $trxtype==$tc) {

         $sql="INSERT INTO land_trx (pdate,tdate,ptype,location,idno,size,cost,plotno,credit,pmode,reference,description,username)
                           VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
                     $params = array($pdate,$tdate,$ptype,$location,$idno,$size,$cost,$plotno,$num,$pmode,$ref,$nar,$user);
                     $stmt = sqlsrv_query( $conn, $sql, $params);

                     //insert into receipts

                     $rctsql = " INSERT INTO receipts (pdate,tdate,idno,location,size,plotno,pmode,description,amount,reference,rctno,username)
                                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$tdate,$idno,$location,$size,$plotno,$pmode,$nar,$num,$ref,$rctno,$user);


                     $stmt1 = sqlsrv_query( $conn,$rctsql,$rctparams);

                     if( $stmt && $stmt1 ) {

                        sqlsrv_commit( $conn );
                      echo "Transaction Saved";
                       }

                   else{
                      sqlsrv_rollback( $conn );
                      echo "Transaction Rolled back";
                   }

      }
        else if ($ptype==$wd || $ptype==$tr ) {

              $sql="INSERT INTO land_trx (pdate,tdate,ptype,location,idno,size,cost,plotno,debit,pmode,reference,description,username)
                           VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
                     $params = array($pdate,$tdate,$ptype,$location,$idno,$size,$cost,$plotno,$num,$pmode,$ref,$nar,$user);
                     $stmt = sqlsrv_query( $conn, $sql, $params);

                      //insert into receipts

                     $rctsql = " INSERT INTO receipts (pdate,tdate,idno,location,size,plotno,pmode,description,amount,reference,rctno,username)
                                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$tdate,$idno,$location,$size,$plotno,$pmode,$nar,$num,$ref,$rctno,$user);


                     $stmt1 = sqlsrv_query( $conn,$rctsql,$rctparams);
                      
                      //update plot numbers
                      $sqlu = "UPDATE plotnos SET ".$location."=NULL  WHERE ".$location."= '$plotno'"; 
                     
                      $stmt2 = sqlsrv_query($conn,$sqlu);
                     
                    
                     if($stmt && $stmt1 && $stmt2) {
                      sqlsrv_commit( $conn ); //commit transaction
                      echo "Transaction Saved";
                       }

                   else{
                      sqlsrv_rollback( $conn );
                      echo "Transaction Rolled back"; //roll back transaction
                   }
          
        }
        else{
           echo "Transaction unsuccessful";
        }

     
  
     sqlsrv_close( $conn );
   
     }




   ?>

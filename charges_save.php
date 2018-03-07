<?php

  require 'check.php';
  
    $pdate = trim($_POST['postpdate']);
    $clientname = trim($_POST['postname']);
    $clientid = trim($_POST['postidno']);
    $phoneno = trim($_POST['postphone']);
    $clientname =stripcslashes($clientname);
    $clientid = stripcslashes($clientid);
    $phoneno = stripcslashes($phoneno);
    $branch = trim($_POST['postbranch']);
    $ptype = trim($_POST['postptype']);
    $amount = trim($_POST['postamnt']);
    $pmode = trim($_POST['postpmode']);
    $ref = trim($_POST['postref']);
    $nrt = trim($_POST['postnrt']);
    $rctno = trim($_POST['postrno']);

     //check whether identification exist.
     $sqlc = "SELECT ID FROM client_details WHERE ID ='$clientid'";
     $paramsc = array();

      $optionsc =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $stmt1= sqlsrv_query( $conn, $sqlc , $paramsc, $optionsc );
      $row_count = sqlsrv_num_rows( $stmt1 );

      if($row_count>1){
                       
         $sql="INSERT INTO payments (pdate,branch,id,type,amount,pmode,reference,description,rctno)
                              VALUES (?,?,?,?,?,?,?,?,?)";
                       $params= array($pdate,$branch,$clientid,$ptype,$amount,$pmode,$ref,$nrt,$rctno);
                       $stmt2 = sqlsrv_query( $conn, $sql, $params);

                       //insert into receipts

                     $rctsql = "INSERT INTO receipts(pdate,idno,pmode,description,amount,reference,rctno)
                                    VALUES(?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$clientid,$pmode,$nrt,$amount,$ref,$rctno);
                     $stmt3 = sqlsrv_query( $conn,$rctsql,$rctparams);

                      if ($stmt2 && $stmt3) {
                        sqlsrv_commit( $conn );
                      sqlsrv_free_stmt( $stmt2); 
                     sqlsrv_free_stmt( $stmt3);
         
                          }
                     else{
                              die( print_r( sqlsrv_errors(), true));
                               sqlsrv_rollback( $conn );
                                 echo "Transaction Rolled back";
                             }
                  }
                else{
                      //maintain client
                  $sql="INSERT INTO client_details (ID,name,phoneno,branch)  VALUES(?,?,?,?)";
                  $cparams = array($clientid,$clientname,$phoneno,$branch);
                  $stmt4 = sqlsrv_query( $conn, $sql, $cparams);
              
                
                  $sql1="INSERT INTO payments (pdate,branch,id,type,amount,pmode,reference,description,rctno)
                              VALUES (?,?,?,?,?,?,?,?,?)";
                  $params= array($pdate,$branch,$clientid,$ptype,$amount,$pmode,$ref,$nrt,$rctno);
                   $stmt5 = sqlsrv_query( $conn, $sql1, $params);

                       //insert into receipts

                     $rctsql = "INSERT INTO receipts(pdate,idno,pmode,description,amount,reference,rctno)
                                    VALUES(?,?,?,?,?,?,?)";
                     $rctparams = array($pdate,$clientid,$pmode,$nrt,$amount,$ref,$rctno);
                     $stmt6 = sqlsrv_query( $conn,$rctsql,$rctparams);

                      if ($stmt4 && $stmt5 && $stmt6 ) {
                        sqlsrv_commit( $conn );
                        sqlsrv_free_stmt( $stmt4);
                     sqlsrv_free_stmt( $stmt5); 
                     sqlsrv_free_stmt( $stmt6);
         
                          }
                     else{
                              die( print_r( sqlsrv_errors(), true));
                               sqlsrv_rollback( $conn );
                                 echo "Transaction Rolled back";
                             }

            }
  
                     
                      
                     sqlsrv_close( $conn );


?>
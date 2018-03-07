<?php
   require 'check.php';
   //$id = trim($_POST['postid']);
   //$loc = trim($_POST['postloc']);
   $id = 123450;
   $loc= 'tyy';

 

   $sql ="SELECT sum(credit) as tc,sum(debit) as td FROM land_trx WHERE idno='$id' AND location='$loc' ";
   $stmt = sqlsrv_query($conn,$sql);
   $row_count = sqlsrv_num_rows( $stmt );

   if ($row_count>1) {
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                
                     $tc= $row['tc'] ;
                     $td= $row['td'] ;
                  $bal=-($td-$tc);
             echo json_encode( array("bal" => $bal));
                   
                  
           }}
     else{
     	$bal = -0;
    echo json_encode( array("bal" => $bal));
              
     }      

   

  
                  
                   
                
            

    


?>
 
<?php 
require 'check.php';
 $idno=  $_POST['postid'];


 
       $sql = "SELECT * FROM investors_details WHERE id = '$idno'";

        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
     
        if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                   
             $name =$row['name'];
             $idno =$row['id'];
             $phoneno =$row['phone'];
             $acc =$row['account'];
             $bkbr =$row['bankbranch'];
             $bkname =$row['bankname'];
             $kra =$row['krapin'];
             $pmode =$row['pmode'];
             $amnt =$row['regamount'];
             $ref =$row['reference'];

             echo json_encode( array("name" => $name, "no" => $idno, "phoneno" => $phoneno,"acc" => $acc,"bkbr" => $bkbr,  "bkname" => $bkname,"kra" => $kra,"pmode" => $pmode,"amnt" => $amnt,"ref" => $ref));
             
   
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

   }
         ?>
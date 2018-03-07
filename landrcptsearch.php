<?php
  require 'check.php';
  $rn = trim($_POST['postrn']);


     $sql = "SELECT  * FROM receipts,client_details WHERE rctno='$rn' AND receipts.idno=client_details.ID";
     $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {

            die( print_r( sqlsrv_errors(), true) );
        }
        else if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
        	# code...

        	 $pdate =$row['pdate'];
             $tdate =$row['tdate'];
             $idno =$row['idno'];
             $loc =$row['location'];
             $size =$row['size'];
             $pltno =$row['plotno'];
             $pmode =$row['pmode'];
             $nrt =$row['description'];
             $amnt =$row['amount'];
             $name =$row['name'];
             $ref =$row['reference'];

 echo json_encode( array("pdate" => $pdate, "no" => $idno, "tdate" => $tdate,"loc" => $loc,  "size" => $size,
 	"ptno" => $pltno,"pmode" => $pmode,"nrt" => $nrt,"amnt" => $amnt,"ref" => $ref,"name" => $name));
             
        }
?>
<?php
  require 'check.php';
  $rn = trim($_POST['postrn']);
 // $rn ="GRE100";


     $sql = "SELECT  * FROM investors,investors_details WHERE rctno='$rn' AND investors.id=investors_details.id";
     $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {

            die( print_r( sqlsrv_errors(), true) );
        }
        else if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
        	# code...
             $tdate =$row['tdate'];
             $idno =$row['id'];
             $type =$row['type'];
             $pmode =$row['pmode'];
             $amnt =$row['amount'];
             $rate =$row['rate'];
             $intrst =$row['interest'];  
             $pmnt =$row['payment'];
             $tax =$row['tax']; 
             $name =$row['name'];
             $ref =$row['reference'];

 echo json_encode( array("tdate" => $tdate, "no" => $idno, "type" => $type,"rate" => $rate,  "intr" => $intrst,
 	"pmnt" => $pmnt,"pmode" => $pmode,"tax" => $tax,"amnt" => $amnt,"ref" => $ref,"name" => $name));
             
        }
?>
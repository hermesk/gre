 
<?php 

 $idno=  $_POST['postname'];
 $location=$_POST['postlocation'];


 //echo $name;
  require 'connect.php';


 
      $sql = "SELECT client_details.name,client_details.ID,house_trx.cost
           FROM house_trx
                  inner join client_details
                  on client_details. ID=house_trx .idno
           WHERE house_trx .idno='$idno' AND house_trx. location='$location'";

     
        $stmt = sqlsrv_query( $conn, $sql );
        $row_count = sqlsrv_num_rows( $stmt );

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
     
        if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                   
             $name =$row['name'];
             $idno =$row['ID'];
             $hcost =$row['cost'];
            

             echo json_encode( array("name" => $name, "no" => $idno, "hcost" => $hcost));
             

          
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $conn );

   }
   elseif ($row_count<1) {

     
        $sql = "SELECT * FROM client_details WHERE ID = '$idno'";

        $stmt = sqlsrv_query( $conn, $sql );
        $row_count1 = sqlsrv_num_rows( $stmt );

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
     
        if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                   
             $name =$row['name'];
             $idno =$row['ID'];
            

             echo json_encode( array("name" => $name, "no" => $idno));
          
            sqlsrv_free_stmt( $stmt);
            sqlsrv_close( $conn );
          }
        
       
   }


         ?>
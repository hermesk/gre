 
<?php 
     require 'connect.php';
 $idno=  $_POST['postid'];
 $location=$_POST['postlocation'];



     
      $sql = "SELECT client_details.name,client_details.ID,land_trx.cost,land_trx.plotno
           FROM land_trx
                  inner join client_details
                  on client_details. ID=land_trx .idno
           WHERE land_trx .idno='$idno' AND land_trx. location='$location'";

     
        $stmt = sqlsrv_query( $conn, $sql );
        $row_count = sqlsrv_num_rows( $stmt );

         if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
      
          if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                   
             $name =$row['name'];
             $idno =$row['ID'];
             $lcost =$row['cost'];
             $plotno =$row['plotno'];
            

             echo json_encode( array("name" => $name, "no" => $idno, "lcost" => $lcost, "plotno" => $plotno));
             
  
                sqlsrv_free_stmt( $stmt);
                sqlsrv_close( $conn );

               }
           
          else if ($row_count<1) {

     
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
          elseif ($row_count<1) {
            
            $sql = "SELECT client_details.name,client_details.ID,land_trx.cost,land_trx.plotno
           FROM land_trx
                  inner join client_details
                  on client_details. ID=land_trx .idno
           WHERE land_trx .plotno='$idno' AND land_trx. location='$location'";
                $stmt = sqlsrv_query( $conn, $sql );
                $row_count = sqlsrv_num_rows( $stmt );

                if( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                             
                       $name =$row['name'];
                       $idno =$row['ID'];
                       $lcost =$row['cost'];
                       $plotno =$row['plotno'];
            
               echo json_encode( array("name" => $name, "no" => $idno, "lcost" => $lcost, "plotno" => $plotno));
                sqlsrv_free_stmt( $stmt);
                sqlsrv_close( $conn );

               }

          }
        
       
   }

   
         ?>
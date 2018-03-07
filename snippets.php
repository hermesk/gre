  
<?php
  // alert(" Do you want to save?");
        /*post data to insert_house page
      $.post('house_save.php',{
        postpdate:pdate,
        posttdate:tdate,
        postptype:ptype,
        postlocation:location,
        postidno:idno,
        postsize:size,
        postcost:cost,
        posttrxtype:trxtype,
        postamnt:amnt,
        postpmode:pmode,
        postref:ref,
        postnrt:nrt,

          },
        function(data)
         {
            var duce = jQuery.parseJSON(data);
            var dt = duce.name;
            var svmsg= "Transaction committed";

            if (dt=svmsg) {
               
                $("#result").html(dt);
                
            }
            
         
         
      
         }

          );

       function getConfirmation(){
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ){
                  document.write ("User wants to continue!");
                  return true;
               }
               else{
                  document.write ("User does not want to continue!");
                  return false;
               }
            }
            $("#btnhsave").click(function(event){
       if(!confirm ("your message")){
         event.preventDefault();
       }

             /*
             function  save(){
   
      //document.write ("User wants to continue!");
      var pdate = $('#pdate').val();
      var tdate = $('#tdate').val();
      var ptype = $('#ptype').val();
      var location = $('#location').val();
      var idno = $('#idno').val();
      var size = $('#size').val();
      var cst = $('#cost').val();
      var cost = cst.replace(/,/g, '');
      var trxtype = $('#trxtype').val();
      var mnt = $('#amnt').val(); 
      var amnt = mnt.replace(/,/g, '');    
      var pmode = $('#pmode').val();
      var ref = $('#ref').val();
      var nrt = $('#nrt').val();
      var ptp = "Select Payment Type";
      var loc = "Select location";
      var sz = "Select Size";
      var trx = "Select Transaction Type";
      var  pmd ="Select Payment Mode";
      
      var cmsg = "Transaction rolled back";
     

      if (ptype===ptp) {

        alert("Select Payment Type");
        event.preventDefault();
      }

      else if (location===loc) {

        alert("Select location");
        event.preventDefault();
      }
      else if (size===sz) {

        alert("Select House Size");
        event.preventDefault();
      }
      else if (trxtype===trx) {

        alert("Select Transaction Type");
        event.preventDefault();
      }
      
      else if (pmode===pmd) {

        alert("Select Payment Mode");
        event.preventDefault();
      }

     /* else if (cost<amnt) {

        alert("Amount Received Cannot be greater than the Cost");
      }

      //check for empty fields
        else if (!idno||!cost||!amnt ||!ref ||!nrt) {
        alert("Fill all the fields");
        event.preventDefault();
      }
      
       else{
        
        if(!confirm ("Do You Want to Save?")){
         event.preventDefault();
        }
        else {
        $.post('house_save.php',{
        postpdate:pdate,
        posttdate:tdate,
        postptype:ptype,
        postlocation:location,
        postidno:idno,
        postsize:size,
        postcost:cost,
        posttrxtype:trxtype,
        postamnt:amnt,
        postpmode:pmode,
        postref:ref,
        postnrt:nrt,
          },
        function(data)
         {
            if (data) {
               alert(data);
              
               $('.success').html(sv); 
$('.success').fadeIn(200).show();
$('.error').fadeOut(200).hide();
            }

            
        /* if (data) {
           // event.preventDefault();
            alert("Saved");
           }
           else{
                alert("cancled");

           }

         
      
         }
          );
        }
        

     
       }

      
      }
     if ($trxtype='Credit') {
       

     }

      //set up and execute query
     $sql="INSERT INTO house_trx (pdate,tdate,ptype,location,idno,size,cost,credit,pmode,reference,description)
                           VALUES(?,?,?,?,?,?,?,?,?,?,?)";

     $params = array($pdate,$tdate,$ptype,$location,$idno,$size,$cost,$num,$pmode,$ref,$nar);

     $stmt = sqlsrv_query( $conn, $sql, $params);

     if( $stmt==true) {

     sqlsrv_commit( $conn );
     $svmsg = "Transaction committed";
     echo json_encode( array("name" => $svmsg));
     /*
      echo "<script language='javascript' type='text/javascript'>";
            echo 'window.location.href = "house_rct.php";';
          echo "</script>";

         }
          else {
     sqlsrv_rollback( $conn );
     $cmsg = "Transaction rolled back";
     echo json_encode( array("name" => $cmsg));
     
            }
            sqlsrv_close( $conn); */
             /* Initialize parameter values. */

   $pdate = trim($_POST['dt']);
   $tdate = trim($_POST['tdate']);
   $ptype= trim($_POST['ptype']);
   $location=trim($_POST['location']);
  // $idno = trim($_POST['idno']);
   $size= trim($_POST['hsize']);
   $cost= trim($_POST['cost']);
   $trxtype= trim($_POST['trxtype']);
   //$num = trim($_POST['amnt']);
   $pmode = trim($_POST['pmode']);
   $ref = trim($_POST['ref']);
   $nar = trim($_POST['nrt']);
 
   
          


  require 'check.php';
  
 
  /* Begin the transaction. 
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
     die( print_r( sqlsrv_errors(), true ));
    } 
  *//* Initialize parameter values. 
   $pdate = trim($_POST['pdate']);
   $tdate = trim($_POST['tdate']);
   $ptype= trim($_POST['ptype']);
   $location=trim($_POST['location']);
   $idno = trim($_POST['idno']);
   $size= trim($_POST['hsize']);
   $cst= trim($_POST['cost']);
   $cost= (int)str_replace(',', '', $cst);
   $trxtype= trim($_POST['trxtype']);
   $nm = trim($_POST['num']);
   $num = (int)str_replace(',', '', $nm);
   $pmode = trim($_POST['pmode']);
   $ref = trim($_POST['ref']);
   $nar = trim($_POST['nrt']);
  
   

 
   
     if ($trxtype='Credit') {
       $sql="INSERT INTO house_trx (pdate,tdate,ptype,location,idno,size,cost,credit,pmode,reference,description)
                           VALUES(?,?,?,?,?,?,?,?,?,?,?)";

     $params = array($pdate,$tdate,$ptype,$location,$idno,$size,$cost,$num,$pmode,$ref,$nar);

     $stmt = sqlsrv_query( $conn, $sql, $params);
     if( $stmt==true) {
      echo $cost;
     }

     }

     /*

      //set up and execute query
     $sql="INSERT INTO house_trx (pdate,tdate,ptype,location,idno,size,cost,credit,pmode,reference,description)
                           VALUES(?,?,?,?,?,?,?,?,?,?,?)";

     $params = array($pdate,$tdate,$ptype,$location,$idno,$size,$cost,$num,$pmode,$ref,$nar);

     $stmt = sqlsrv_query( $conn, $sql, $params);

     if( $stmt==true) {

     sqlsrv_commit( $conn );
     $svmsg = "Transaction committed";
     echo json_encode( array("name" => $svmsg));
     /*
      echo "<script language='javascript' type='text/javascript'>";
            echo 'window.location.href = "house_rct.php";';
          echo "</script>";

         }
          else {
     sqlsrv_rollback( $conn );
     $cmsg = "Transaction rolled back";
     echo json_encode( array("name" => $cmsg));
     
            }
            sqlsrv_close( $conn); */
 
   
          ?><script>
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
 $('#framework_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#framework option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#framework').multiselect('refresh');
    alert(data);
   }
  });
 });
 
 
});
       
   $(document).ready(function(){
 $('#plotnos').multiselect({
  nonSelectedText: 'Select Plotno',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'200px'
 });

$('#plotnos option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#plotnos').multiselect('refresh');


});

    

  //do validation here
      var ptype = $('#ptype').val();

      var location = $('#location').val();
      var idno = $('#idno').val();
      var size = $('#size').val();
      var cst = $('#cost').val();
      var ct = cst.replace(/,/g, '');
      var cost = parseInt(ct);
      var trxtype = $('#trxtype').val();
      var mnt = $('#amnt').val(); 
      var amntp = mnt.replace(/,/g, '');  
      var amnt = parseInt(amntp);  
      var pmode = $('#pmode').val();
      var ref = $('#ref').val();
      var nrt = $('#nrt').val();
      var ptp = "Select Payment type";
      var loc = "Select location";
      var sz = "Select Size";
      var trx = "Select Transaction Type";
      var  pmd ="Select Payment Mode";
      
      var cmsg = "Transaction rolled back";
     //refn();

      if (ptype===ptp) {

        alert("Select Payment Type");
        event.preventDefault();
      }

      else if (location===loc) {

        alert("Select location");
        event.preventDefault();
      }
      else if (size===sz) {

        alert("Select plot Size");
        event.preventDefault();
      }
      else if (trxtype===trx) {

        alert("Select Transaction Type");
        event.preventDefault();
      }
      
      else if (pmode===pmd) {

        alert("Select Payment Mode");
        event.preventDefault();
      }
       else if(!idno){
        alert("Search the client with ID/PP no");
        event.preventDefault();
       }
    /* else if (cost<amnt) {

        alert("Amount Received Cannot be greater than the Cost");
        event.preventDefault();
      }*/

      //check for empty fields
     else if (!idno) {
        alert("Search client by ID/PP");
        event.preventDefault();
      }
       else if(!confirm ("Do You Want to Save?")){
        event.preventDefault();
        }
        
</script>

<?php
require 'check.php';
require 'payment_details.php';
require 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>GRE INVESTORS</title>
    <link rel="stylesheet" type="text/css" href="css/gak.css">   
   <script src="js/jquery.js"></script>  
     
</head>
<?php echo '<div align="center" style="color:#800000" >GAKUYO INVESTORS CLUB</div>'; ?>

<body>
<div class="investors">
 <fieldset style="width: 95%"><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
<table border="0"> 
<form method="POST" action="investors_rct.php">
    
    <td><b>Transaction date</b></td><td>
    <input id="tdate" type="date" style="width: 180px"  name="tdate" value="<?php echo date('Y-m-d'); ?>" /></td>
     <td><b>ID/PP</b></td><td>
    <input type="text" placeholder="ID/PP" name="invid" id="scid"  required 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');"></td><td></td><td>
     <button type="button" id="sbtn" value="Search" name="scid" formnovalidate onclick="searchclient()">Search</button>
    </td>
    </tr>
    <tr>
     <td><b> Name</b></td><td colspan="3">
    <input type="text" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');"
     placeholder="Full name"  id="invname" name="invname" style="width:95%;" readonly>
    </td>
    
      </tr>
       <tr>
       <td><b>Trx Type</b></td><td>
        <select name="trxtype"  id="trxtype" style="width: 180px"><option>Select Deposit Type</option>
        <?php investtype()  ?>
        </select></td>
        <td><b>Amount</b></td><td>
        <input type="text" id="amnt" name="num" placeholder="Amount Received" required /></td>
        <td><b>Pay Mode</b></td><td>
         <select name="pmode"  id="pmode" onclick="autoref()"><option>Select Payment Mode</option>
         <?php  pmode()?>   
         </select></td>
      </tr>
       <tr>
    <td><b>Reference</b></td><td>
    <input type="text" placeholder="reference."  name="ref" id="ref" required 
    onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');">
    </td>
    <td><b> Rate</b></td><td>
    <input type="text" placeholder="rate"  id="rate" name="rate" required 
    onkeyup="this.value=this.value.replace(/[^\d\.]/g,'');">
    </td>
     <td>
      <b>Interest</b></td><td>
    <input type="text"  id="intr" name="intr"  readonly 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');">
    </td>
  </tr>
     <tr>
   <td><b>Payment</b></td><td>
    <input type="text" id="payment" name="payment"  readonly>
    </td><td>
     <b>Govt tax</b></td><td>
    <input type="text"   name="gvtx" id="gvtx" readonly></td>
     <td><b>ID/PP</b></td><td>
    <input type="text" placeholder="ID/PP" name="invid" id="invid"  readonly >
    </td>
    </tr><td>
    <tr>
    <td>
   <input type="hidden" name="rctno" value="autoref()" id="rctno">
   </td>
      <td> <input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>" /></td>
    </tr>
    <tr> <td></td>
      <td><input type="submit" value="Save" id="btnsave" onclick="validate()"></td>
  <td></td>
  <td>  <input type="reset" id="reset"></td>
    </tr>

 <script type="text/javascript">

          var fnf = document.getElementById("amnt");
            fnf.addEventListener('keyup', function(evt){
            var n = parseInt(this.value.replace(/\D/g,''),10);
            fnf.value = n.toLocaleString();

               }, false);

            //calculate  interest
            var rt = document.getElementById("rate");
            rt.addEventListener('keyup', function(evt){
           var mnt = $('#amnt').val();
           var amnt = mnt.replace(/,/g, '');
            var n = mnt.length;
            if (n<1) {
              alert("Enter Amount first");
              var  rate =$('#rate').val(''); 
            }
            else{
               var  rate =$('#rate').val();  
               var intr = rate*0.01*amnt;
               var  gvtx = intr*0.05;
               var  pmnt =intr-gvtx;
                 $('#intr').val(intr);
                 $('#payment').val(pmnt);
                 $('#gvtx').val(gvtx);
            }
            
            

               }, false);
            

  //serach investor

         function searchclient() {

            var invid = $('#scid').val();
            var n = invid.length;
            if (n<6) {
              alert("Enter Valid Indentification ");
              event.preventDefault();
            }
         
          else{
             $.post('searchinvestor.php',{postid:invid},
                function(data)
                 {
                  if (!$.trim(data)) {
                    alert("Client Does not exist");

                  }

                    else{

                   var duce = jQuery.parseJSON(data);
                    var dt1 = duce.name;
                    var dt2 = duce.no;
                  
                  
                    //set the values
                   $('#invname').val(dt1);
                   $('#invname').attr('readonly', true);
                   $('#invid').val(dt2);
                   $('#invid').attr('readonly', true);
                  
                    }

                 }

                );
          }
  }
      //check reference no.
    function refn(){

       var ref = $('#ref').val();

       $.post('checkref.php',{
        
        postref:ref,
       
          },
        function(data)
         {
            if (data) {

             alert(data);
           event.preventDefault(); // Cancel the submit  
           $('#ref').val("");
             return false;
            }
         }
          );
        }

     //generate receipt number
        function rctno(){

       $.post('receiptno.php',
          function(data)
         {
            if (data) {
            var duce = jQuery.parseJSON(data);
            var dt1 ="GRE"+ duce.rn;
           
              $('#rctno').val(dt1);
            }
           } );  
        }

      //auto reference no.
            function autoref(){
          rctno();
          $('#ref').val('');
          $('#ref').attr('readonly', false);
          var pmode = $('#pmode').val();
          var ck = "Cash";

          if (pmode===ck) {

       $.post('receiptno.php',
          function(data)
         {
            if (data) {
            var duce = jQuery.parseJSON(data);
            var dt1 ="GRE"+ duce.rn;
           

             $('#ref').val(dt1);
             $('#ref').attr('readonly', true);
     
            }
           } );
          }
         
        }
 //check dropdown select
    function validate(){
       refn();
      var  pmd ="Select Payment Mode";
      var pmode = $('#pmode').val();
      if (pmode===pmd) {
        alert("Select Payment Mode");
        event.preventDefault();
      }
     else if(!confirm ("Do You Want to Save?")){
        event.preventDefault();
        }
    }
     //submiting form
        $('form').submit( function(ev){

         ev.preventDefault();

        var pdate = $('#pdate').val();
        var tdate = $('#tdate').val();
        var idno = $('#invid').val();
        var trx = $('#trxtype').val();
        var mnt = $('#amnt').val(); 
        var amnt = mnt.replace(/,/g, ''); 
        var pmode = $('#pmode').val();
        var ref = $('#ref').val();
        var rate = $('#rate').val();
        var intr  =$('#intr').val();
        var pmnt  =$('#payment').val();
        var tax = $('#gvtx').val();
        var rno = $('#rctno').val();
        var sv  = "Transaction Saved";
          
       $.post('investors_save.php',{
       
        postpdate:pdate,
        posttdate:tdate,
        postidno:idno,
        posttrx:trx,
        postamnt:amnt,
        postpmode:pmode,
        postref:ref,
        postrate:rate,
        postintr:intr,
        postpmnt:pmnt,
        posttax:tax,
        postrno:rno,
       },
           function(data){ 
          if (data===sv) {
          alert("Data Saved"); 
         }
         
         else{
          window.location.href = "investors.php";
            alert(data);
         }
          }
        
      );
 
 $(this).unbind('submit').submit()

  });
  
  </script>
  </form>
  </table>
  </fieldset>
    </div>
    </body>
</html>

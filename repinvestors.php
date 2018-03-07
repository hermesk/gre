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
<?php echo '<div align="center" style="color:#800000" >REPRINT INVESTORS CLUB RECEIPT</div>'; ?>

<body>
<div class="investors">
 <fieldset style="width: 95%"><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
<table border="0"> 
<form method="POST" action="investors_rctrep.php">
    
    <td><b>Transaction date</b></td><td>
    <input id="tdate" type="date" style="width: 180px"  name="tdate" value="<?php echo date('Y-m-d'); ?>" /></td>
     <td><b>Receiptno</b></td><td>
    <input type="text" placeholder="Receiptno" name="rctno" id="srctno"  required></td><td></td><td>
     <button type="button" id="sbtn" value="Search" name="scid" formnovalidate onclick="searchrctno()">Search</button>
    </td>
    </tr>
    <tr>
     <td><b> Name</b></td><td colspan="3">
    <input type="text" placeholder="Full name"  id="invname" name="invname" style="width:95%;" readonly> </td>
    </tr>
       <tr>
       <td><b>Trx Type</b></td><td>
        <select name="trxtype"  id="trxtype" style="width: 180px" readonly><option>Select Deposit Type</option> </select></td>
        <td><b>Amount</b></td><td>
        <input type="text" id="amnt" name="num" placeholder="Amount Received"  readonly required /></td>
        <td><b>Pay Mode</b></td><td>
         <select name="pmode"  id="pmode" readonly><option>Select Payment Mode</option></select></td> </tr>
       <tr>
    <td><b>Reference</b></td><td>
    <input type="text" placeholder="reference."  name="ref" id="ref" readonly required > </td>
    <td><b> Rate</b></td><td>
    <input type="text" placeholder="rate"  id="rate" name="rate" readonly required ></td>
     <td><b>Interest</b></td><td>
    <input type="text"  id="intr" name="intr"  readonly ></td>
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
   <input type="hidden" name="rctno" id="rctno">
   </td>
      <td> <input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>" /></td>
    </tr>
    <tr> <td></td> <td></td>
      <td><input type="submit" value="Print" id="btnsave" onclick="validate()"></td>
  </tr>

 <script type="text/javascript">

  //serach investor
      function searchrctno() {
   
    var rn = $('#srctno').val();
  
    if (!rn) {
        alert("Enter Receiptno");
       }
       else{
        $.post('investrcptsearch.php',{postrn:rn,},
        function(data)
         {
          if (!$.trim(data)) {

            alert("Receiptno:"+rn+" Does not exist in: ");
            event.preventDefault();
          }

            else{
         
           var duce = jQuery.parseJSON(data);
            var dt1 = duce.type;
            var dt2 = duce.tdate;
            var dt3 = duce.no;
            var dt4 = duce.rate;
            var dt5 = duce.intr;
            var dt6 = duce.pmnt;
            var dt7 = duce.pmode;
            var dt9 = duce.amnt;
            var dt10 = duce.ref;
            var dt11 = duce.name;
            var dt12 = duce.tax;
        
       $('#tdate').val(dt2);
       $('#invid').val(dt3);
       $('#trxtype').html("");
       $('#trxtype').append($('<option></option>').val(dt1).text(dt1)); 
       $('#amnt').val(dt9); 
       $('#rate').val(dt4);
       $('#intr').val(dt5);
       $('#payment').val(dt6);
       $('#gvtx').val(dt12);
       $('#pmode').html("");
       $('#pmode').append($('<option></option>').val(dt7).text(dt7)); 
       $('#ref').val(dt10);
       $('#rctno').val(rn);
       $('#invname').val(dt11);
  
            }
       
         }

        );

       
       }
 
}



 //check dropdown select
    function validate(){
     var name = $('#invname').val();

         if (!name) {
         alert("Search Using receiptno")
             event.preventDefault();
         }
    }

  
  </script>
  </form>
  </table>
  </fieldset>
    </div>
    </body>
</html>

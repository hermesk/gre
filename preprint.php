  <?php
  require 'check.php';
  require 'payment_details.php';
  require 'property_details.php';
  require 'functions.php';
   require 'header.php';
  $name= "";
?>
<!DOCTYPE html>
<html>
<head>
  <title>GRE Land Payment Section</title>
    <link rel="stylesheet" type="text/css" href="css/gak.css">   
   <script src="js/jquery.js"></script>  
     
</head>

<body>
<?php echo '<div align="center" style="color:#800000" >REPRINT LAND/HOUSE RECEIPTS</div>'; ?>
<div class="land">
 <fieldset><legend ><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table border="0">
  <form method="post" action="propertyreprintrct.php">
    <table  >
    <tr>
     <td><b>Location</b></td>
    <td> <select  id="location" name="location" style="width: 180px" readonly="readonly"><option>Select location</option>
  </select></td>
  
    <td><b>Receiptno</b></td>
    <td><input type="text" placeholder="Search by receiptno" name="scid" id="srctno" ></td><td></td>
    <td><button type="button" id="sbtn" value="Search" name="scid" formnovalidate onclick="searchrctno()">Search</button></td>
   </tr>
   <tr>
     <td><b>Transaction date</b></td>
    <td><input id="tdate" type="date" name="tdate" style="width: 180px" value="<?php echo date('Y-m-d'); ?>" /><br /></td>
   

     <td  ><b>Name</b></td>
     <td colspan="3" ><input type="text" placeholder="Client name" style="width:95%;" name="cname" id="cname"
          readonly="readonly"  readonly="readonly"></td>
    </tr>
     <tr>
  
  </tr>
    <tr>
    <td><b>Size</b></td><td>
   <select name="lsize" id="lsize" style="width: 180px" readonly="readonly" required><option>Select Size</option>
  
    </select></td>

     <td><b>Plot No.</b></td>
      <td> <select name="plotn" id="plotn" style="width: 180px" readonly="readonly">
       <option>Select plot no</option>
     </select></td>
   
        <td><b>Amount</b></td><td>
        <input type="text" placeholder="Amount Received"  name="num" id="amnt" readonly="readonly" required></td></tr><tr>
        <td><b>Pay Mode</b></td><td>
         <select name="pmode"  style="width: 180px"  id="pmode" readonly="readonly" ><option>Select Payment mode</option>
         
         </select></td>
        
          <td><b>Reference</b></td><td>
  <input type="text" placeholder="Reference"  name="ref" id="ref" readonly="readonly" required></td>            
     
          <td><b>ID/PP</b></td>
         <td> <input type="text" name="cfid"  id="idno" readonly="readonly"></td>
       </tr> <tr>
     <td><b>Narration</b></td>
   <td colspan="3">  <input type="text" style="width:95%" placeholder="Narration" name="nrt" id="nrt" readonly="readonly" required></td>
      <td><input type="hidden" name="rctno"  id="rctno"></td>
      <td><input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>" /></td>
      
     </tr>
     
     <tr>
     <td></td><td></td>
     <td><button type="submit" id="btnsave" onclick="validate()" value="Print" >Print</button>  </td>
      <td></td>
     
     </tr>
</table>
       <!-- search client--> 
      <script type="text/javascript">

       function validate(){
         var name = $('#cname').val();

         if (!name) {
         alert("Search Using receiptno")
             event.preventDefault();
         }

       }


      function searchrctno() {
   
    var rn = $('#srctno').val();
  
    if (!rn) {
        alert("Enter Receiptno");
       }
       else{
        $.post('landrcptsearch.php',{postrn:rn,},
        function(data)
         {
          if (!$.trim(data)) {

            alert("Receiptno:"+rn+" Does not exist in: ");
            event.preventDefault();
          }

            else{
         
           var duce = jQuery.parseJSON(data);
            var dt1 = duce.pdate;
            var dt2 = duce.tdate;
            var dt3 = duce.no;
            var dt4 = duce.loc;
            var dt5 = duce.size;
            var dt6 = duce.ptno;
            var dt7 = duce.pmode;
            var dt8 = duce.nrt;
            var dt9 = duce.amnt;
            var dt10 = duce.ref;
            var dt11 = duce.name;
        
      // $('#pdate').val(dt1);
       $('#tdate').val(dt2);
       $('#location').html("");
       $('#location').append($('<option></option>').val(dt4).text(dt4));
       $('#lsize').html("");
       $('#lsize').append($('<option></option>').val(dt5).text(dt5));
       $('#plotn').html("");
       $('#plotn').append($('<option></option>').val(dt6).text(dt6));
       $('#amnt').val(dt9);
       $('#pmode').html("");
       $('#pmode').append($('<option></option>').val(dt7).text(dt7)); 
       $('#ref').val(dt10);
       $('#idno').val(dt3);
       $('#nrt').val(dt8);
       $('#rctno').val(rn);
       $('#cname').val(dt11);
  
            }
       
         }

        );

       
       }
 
}
    </script>
     
  </form>
  
 </table>
 </fieldset>     

</div>
 
</body>
</html>

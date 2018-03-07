<?php
 require 'check.php';
 require 'header.php';
 require 'payment_details.php';
?>
<!DOCTYPE html>
<html >
<head>
 
  <title>Payment Voucher</title>

  <link rel="stylesheet" href="css/gak.css">
  <script src="js/jquery.js">
  </script>

</head>

<?php echo '<div align="center" style="color:#800000" >GAKUYO PETTY CASH</div>'; ?>
<body>

<div class="expenses">
 <fieldset ><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table > 
 <form  method="post" action="expense_save.php?attempt">
    <tr>
   <td><b>Payee</b></td><td colspan="3">
    <input type="text" placeholder="payee name"  id="name" name="pname"  onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');"
      style="width: 95%"  required></td>

  </tr>

<tr>
    <td><b>Amount</b></td><td>
     <input type="text" id="amnt"  name="num" placeholder="Amount " required /></td>
</tr>
     <tr>
     <td><b>Mode</b></td>
       <td>
     <select name="pmode" id="pmode" style="width: 180px" onclick="autoref()"><option>Select Payment Mode</option>
     
        <?php  pmode()?> 
    </select></td>
     </tr>
<tr>
      <td><b>Description</b></td><td colspan="3">
     <input type="text" placeholder="Narration" style="width: 95%"  name="nrt" id="nrt"  onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');"  required  ></td><td>
   <input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>"/></td>
   <td><input type="hidden" name="rctno" value="rctno()" id="rctno"></td>
   <td><input type="hidden"  name="ref" id="ref" ></td></tr>
   <tr>
  <td></td><td>
   <button type="submit" id="btnsave" name="btnsave" onclick="validate()" >Save</button></td>
   <td></td>
    <td><input type="reset" id="reset"></td>
 <div id="errMsg">
            <?php if(!empty($_SESSION['svMsg'])) { echo $_SESSION['svMsg']; } ?>
        </div>
        <?php unset($_SESSION['svMsg']); ?>
    </tr>

<script type="text/javascript">

var fnf = document.getElementById("amnt");
            fnf.addEventListener('keyup', function(evt){
            var n = parseInt(this.value.replace(/\D/g,''),10);
            fnf.value = n.toLocaleString();
               }, false);



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
 
</script>

    </form>
    </table>
    </fieldset>
    </div>
    </body>
</html>

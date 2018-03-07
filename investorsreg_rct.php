<?php
session_start();

require 'header.php';
include 'words.php';

   $pdate = trim($_POST['pdate']);
   $rctno = trim($_POST['rctno']);
   $clientname = trim($_POST['invname']);
   $BankAccNo= trim($_POST['BankAccNo']);
   $pmode = trim($_POST['pmode']);
   $num = trim($_POST['num']);
   $bankname = trim($_POST['bankname']);
   $BankBranch= trim($_POST['BankBranch']);
   $nar ="Investors Club Registration";
 

?>

<!DOCTYPE html>
<html>
<head>
  <title>GRE Receipt</title>
 <script src="js/jquery.js"></script>
</head>

<div  class="rct" style="width: 500px;margin-right: auto;margin-left: auto;">
  <table >
  <tr > <td ><?php echo "Date:"; ?></td>
        <td><?php echo "$pdate"; ?></td>
        <td ><?php echo "Receipt no:"; ?></td>
        <td><?php echo "$rctno"; ?></td>
  </tr>

  <tr>
     <td><?php echo "Name:"; ?> </td> 
     <td><?php echo "$clientname"; ?></td>
  </tr>

  <tr> 
   <td><?php echo "BankAccNo:"; ?></td>
   <td><?php echo "$BankAccNo"; ?></td>
  </tr>
   <tr>
      <td><?php echo "Bankname:"; ?></td>
      <td><?php echo "$bankname"; ?></td>
      
  </tr>
  <tr>
      <td ><?php echo "Mode:"; ?></td>
      <td><?php echo "$pmode"; ?></td>
      <td><?php echo "Amount:"; ?></td>
      <td><?php echo "$num"; ?></td>
  </tr>
  <tr >
    <td><?php echo "Description:"; ?></td>
     <td colspan="4"><?php echo "$nar"; ?></td>
   </tr>
  <tr> 
  <td><?php echo "Words:"; ?></td>
 <td colspan="4"><?php echo convertNumberToWord("$num")." Kenya Shillings Only.";?></td>
   </tr>
  <tr> <td ><?php echo "Signature:"; ?></td>
   <td colspan="2"><?php echo ".............................."; ?></td>
  </tr>
  <tr> <td colspan="2"><?php echo "You were served by: ";echo  $_SESSION['username'];?></td>
  <td><?php echo "Branch: ";echo  $_SESSION['branch'];?></td>
  </tr>
  </table>
</div>
<script type="text/javascript">
if(!confirm ("Do You Want to Print Receipt?")){
        //event.preventDefault();
        setTimeout("closePrintView()", 60);
        }
        else{
          window.print();
          setTimeout("closePrintView()", 600);

        }
        
         function closePrintView() {
        document.location.href = 'investorsreg.php';
    }
  </script>

</html>
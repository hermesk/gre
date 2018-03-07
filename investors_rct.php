<?php
session_start();

require 'header.php';
require 'words.php';

   $clientname = trim($_POST['invname']);
   $pdate = trim($_POST['pdate']);
   $tdate = trim($_POST['tdate']);
   $ptype= trim($_POST['trxtype']);
   $rate=trim($_POST['rate']);
   $intrst= trim($_POST['intr']);
   $mp= trim($_POST['payment']);
   $pmode = trim($_POST['pmode']);
   $num = trim($_POST['num']);
   $ref = trim($_POST['ref']);
   $rctno = trim($_POST['rctno']);

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
    <td><?php echo "Amount:"; ?></td>
    <td><?php echo "$num"; ?></td>

   <td><?php echo "Rate:"; ?></td>
   <td><?php echo "$rate"."%"; ?></td>

  </tr>
   <tr>
      <td><?php echo "Interest:"; ?></td>
      <td><?php echo "$mp"; ?></td>

  </tr>
  <tr>
      <td ><?php echo "Mode:"; ?></td>
      <td><?php echo "$pmode"; ?></td>

  </tr>
  <tr >
    <td><?php echo "Description:"; ?></td>
     <td colspan="4"><?php echo "$ptype"; ?></td>
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
        setTimeout("closePrintView()", 60);
        }
        else{
          window.print();
          setTimeout("closePrintView()", 600);

        }
        
         function closePrintView() {
        document.location.href = 'investors.php';
    }
  </script>

</html>

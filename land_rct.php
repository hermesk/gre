<?php
session_start();

require 'header.php';
require 'words.php';
   $clientname = trim($_POST['cname']);
   $pdate = trim($_POST['pdate']);
   $tdate = trim($_POST['tdate']);
   $ptype= trim($_POST['ptype']);
   $location=trim($_POST['location']);
   $size= trim($_POST['lsize']);
   $trxtype= trim($_POST['trxtype']);
   $num = trim($_POST['num']);
   $pmode = trim($_POST['pmode']);
   $plotno =trim($_POST['plotn']);
   $ref = trim($_POST['ref']);
   $nar = trim($_POST['nrt']);
  // $bal = trim($_POST['cbal']);
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
   <td><?php echo "Location:"; ?></td>
  <td><?php echo "$location"; ?></td>
  </tr>
   <tr>
      <td><?php echo "Size:"; ?></td>
      <td><?php echo "$size"; ?></td>
      <td><?php echo "Plotno:"; ?></td>
      <td><?php echo "$plotno"; ?></td>
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
        document.location.href = 'land.php';
    }
  </script>

</html>
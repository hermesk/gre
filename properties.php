<?php
 require 'check.php';
 require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADD NEW PROPERTY</title>
	<link rel="stylesheet" href="css/gak.css">
  <script src="js/jquery.js">
  </script>
</head>
<?php echo '<div align="center" style="color:#800000" >ADD NEW PROPERTY</div>'; ?>
<body>
<div class="properties">
   <fieldset ><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
    <table>
<form  method="POST" action="addproperty.php?attempt">
    <tr>
   	  <td><b>LOCATION</b></td><td>
     <input type="text" id="loc"  name="loc" placeholder="new location "  style="text-transform:uppercase"  required />
    </td></tr>
    <tr>
       <td colspan="2">
    <div id="errMsg">
            <?php if(!empty($_SESSION['svMsg'])) { echo $_SESSION['svMsg']; } ?>
        </div>
        <?php unset($_SESSION['svMsg']); ?></td>

    </tr>
    <tr> <td></td><td>
   <button type="submit" id="btnsave" name="btnsave">Save</button></td>
   
     </tr>
     </form>
    </table>
   </fieldset>
</div>
</body>
</html> 
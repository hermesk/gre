<?php
 require 'check.php';
 require 'header.php';
 require 'property_details.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADD NEW PROPERTY</title>
	<link rel="stylesheet" href="css/gak.css">
  <script src="js/jquery.js">
  </script>
</head>
<?php echo '<div align="center" style="color:#800000" >ADD NEW PLOT NUMBERS</div>'; ?>
<body>
<div class="properties">
   <fieldset ><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
    <table>
<form  method="POST" action="addplotnos.php?attempt">
    <tr>
   	 <td><b>Location</b></td>
    <td> <select  id="location" name="location" style="width: 180px"><option>Select location</option>
    <?php location(); ?> </select></td>
    </tr>
    <tr>
      <td><b>Size</b></td><td>
   <select name="size" id="size" style="width: 180px" ><option>Select Size</option>
    <?php
      landsize();
    ?>
    </select></td>
    </tr>
    <tr> 
   <td><b>From</b></td>
    <td><input type="text" placeholder="start" name="from" id="start" 
     onkeyup="this.value=this.value.replace(/\D/g,'');"></td>
      </tr>
      <tr> 
   <td><b>To</b></td>
    <td><input type="text" placeholder="end" name="to" id="end" 
     onkeyup="this.value=this.value.replace(/\D/g,'');"></td>
     <tr><td colspan="2">
        <div id="errMsg">
            <?php if(!empty($_SESSION['svMsg'])) { echo $_SESSION['svMsg']; } ?>
        </div>
        <?php unset($_SESSION['svMsg']); ?></td>
     </tr>
      </tr>
      <tr>
    <td></td><td>
   <button type="submit" id="btnsave" onclick="validate()" name="btnsave">Save</button></td>
         </tr>
     </form>
    </table>
   </fieldset>
</div>
</body>
<script type="text/javascript">
  
    function validate(){

       var location = $('#location').val();
       var loc = "Select location";
       var size = $('#size').val();
       var sz = "Select Size";
   if (location===loc) {
        alert("Select location");
        event.preventDefault();
      }
       else if (size===sz) {

        alert("Select plot Size");
        event.preventDefault();
      }
    }
</script>
</html> 
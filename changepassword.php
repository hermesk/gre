<?php   require 'check.php';
        require 'functions.php';
        require "header.php";?>

<!DOCTYPE HTML> <html> 
<head> <title>Change password</title> 
<link rel="stylesheet" type="text/css" href="css/gak.css"> 
<script src="js/jquery.js"></script>  
</head> 
<?php echo '<div align="center" style="color:#800000" >CHANGE PASSWORD</div>'; ?>
<body id="body-color"> 
<div id="changepassword">
 <fieldset ><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table> 
 <form method="POST" action="pwdchange.php">
 
   <td><b>UserName<b></td><td> <input type="text" name="user" id="user" value="<?php echo $_SESSION['username']; ?>" readonly></td>
    <td><input id="su" type="button" value="Search" onclick="searchuser();" formnovalidate></td>
     </tr>
    <tr><td><b>Old Password<b></td><td> <input type="password" name="opass" id="opass"  required></td></tr> <tr></tr>
      <tr>
    <td><b>Password<b></td><td> <input type="password" name="pass" id="pass"  required></td></tr> <tr>
    <td><b>Confirm Password<b> </td><td><input type="password" name="cpass" id="cpass"  required></td> </tr>
      <tr> <td colspan="3">
     <div id="errMsg" style="width: 100%">
            <?php if(!empty($_SESSION['Msg'])) { echo $_SESSION['Msg']; } ?>
        </div>
        <?php unset($_SESSION['Msg']); ?></td></tr>
     <tr>
    <td></td>
    <td><input id="reg" type="submit" name="submit"  onclick="validate()" value="Save"></td> 
  
    </tr> 
     

<script type="text/javascript">
  
 function validate(){
      var opass = $('#opass').val();
      var pass = $('#pass').val();
      var cpass = $('#cpass').val();
    
  if (pass!=cpass) {
        alert("New password does not match");
        event.preventDefault();
      }
   else if (opass===pass) {
    alert("New password cannot be similar to old one");
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
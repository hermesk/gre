<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="css/gak.css">
</head>

<body id="lgbd">
<?php
 include("header.php");

?>
 

<div id="frm">
<form method ="post" action="login_check.php? attempt">
 
  <div class="imgcontainer">
    <img src="images/login.png" alt="Avatar" class="avatar">
  </div>
  <div class="container">
  
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required><br></br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required><br></br>
     <div id="errMsg">
            <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?>
        </div>
        <?php unset($_SESSION['errMsg']); ?>
    <button type="submit" id="btnlg" value="Login">Login</button>
    
  </div>
</form>
</div>
</body>



</html>
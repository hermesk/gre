<?php
require 'check.php';

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <title>GAKUYO REAL ESTATE</title>
</head>
<body>
<div class="example">
    <div class="menuholder">
        <ul class="menu slide">

            <li><a href="#" class="green">Clients</a>
                <div class="subs">
                        <dd><a href="clientmaintainance.php" style="text-decoration:none;">Clients</a></dd>
                        <dd><a href="Investorsreg.php" style="text-decoration:none;">Investors</a></dd>              
                </div>
            </li>

             <li><a href="#" class="green">Properties</a>
                <div class="subs">
                        <dd><a href="land.php" style="text-decoration:none;">Land</a></dd>
                        <dd><a href="house.php" style="text-decoration:none;">House</a></dd> 
                        <dd><a href="preprint.php" style="text-decoration:none;">Reprint Receipt</a></dd>              
                </div>
            </li>

            <li><a href="#" class="green">Investors Club</a>
                <div class="subs">
                        <dd><a href="Investors.php" style="text-decoration:none;">Deposits</a></dd>
                        <dd><a href="#" style="text-decoration:none;">Payments</a></dd>    
                        <dd><a href="repinvestors.php" style="text-decoration:none;">Reprint Receipt</a></dd>            
                </div>
            </li>
            <li><a href="#" class="green">Payments</a>
                <div class="subs">
                        <dd><a href="charges.php" style="text-decoration:none;">Charges</a></dd>
                        <dd><a href="expenses.php" style="text-decoration:none;">Expenses</a></dd> 
             
                </div>
            </li>
             <li><a href="#" class="green">New</a>
                     <div class="subs">
                 <?php if($_SESSION['level']==="admin") { ?>
                  <dd><a href="Properties.php" style="text-decoration:none;">Add New Property</a></dd>   
                   <dd><a href="addnewplotnos.php" style="text-decoration:none;">Add Plot Numbers</a></dd> 
                  <?php } 
                  else { ?>
                  <!--<dd><a href="changepassword.php" style="text-decoration:none;">Change Password</a></dd>
                  <dd><a href="logout.php" style="text-decoration:none;">Logout</a></dd> -->
                  <?php } ?>
                                                      
                </div>
                <li><a href="#" style="text-decoration:none;" class="blue"><?php echo $_SESSION['username']; ?></a>
                  <div class="subs">
                 <?php if($_SESSION['level']==="admin") { ?>
                   <dd><a href="sign.php" style="text-decoration:none;">Signup</a></dd> 
                   <dd><a href="changepassword.php" style="text-decoration:none;">Change Password</a></dd>
                   <dd><a href="logout.php" style="text-decoration:none;">Logout</a></dd>
                  <?php } 
                  else { ?>
                  <dd><a href="changepassword.php" style="text-decoration:none;">Change Password</a></dd>
                  <dd><a href="logout.php" style="text-decoration:none;">Logout</a></dd>
                  <?php } ?>
                                                      
                </div>
            </li>
        

        </ul>
        <div class="back"></div>
        <div class="shadow"></div>
    </div>
    <div style="clear:both"></div>
</div>
</body>
</html>


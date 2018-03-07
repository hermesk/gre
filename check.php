<?php
require  'connect.php';
    session_start();
    
  if (!isset($_SESSION['username'])) {
  	
  	header("location:login.php");
  }
  else if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 480)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
     ?>
        <script type="text/javascript">
        alert("Your Session has Expired")
        window.location.href = "login.php";
        </script>
   <?php
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
   
?>
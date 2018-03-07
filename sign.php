<?php   require 'check.php';
        require 'functions.php';
        require "header.php";?>

<!DOCTYPE HTML> <html> 
<head> <title>Register User</title> 
<link rel="stylesheet" type="text/css" href="css/gak.css"> 
<script src="js/jquery.js"></script>  
</head> 
<?php echo '<div align="center" style="color:#800000" >REGISTER USER</div>'; ?>
<body id="body-color"> 
<div id="Sign-Up">
 <fieldset ><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table> 
 <form method="POST" action="save_user.php?attempt">
  <tr> <td><b>Name<b></td><td> <input type="text" name="name" id="name" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required></td>  
   <td><b>UserName<b></td><td> <input type="text" name="user" id="user" required></td>
    <td><input id="su" type="button" value="Search" onclick="searchuser();" formnovalidate></td>
     </tr> <tr>
     <td><b>Branch</b></td><td><select style="width: 180px" id="branch" name="branch"><option>Select Branch</option>
     <?php   branches(); ?></select> </td>
    <td><b>Level</b></td><td><select style="width: 180px" id="level" name="level"><option>Select level</option>
    <?php   level(); ?></select> </td> </tr> <tr>
    <td><b>Password<b></td><td> <input type="password" name="pass" id="pass" onclick="checkuser();" required></td>
    <td><b>Confirm Password<b> </td><td><input type="password" name="cpass" id="cpass"  required></td> </tr>
   <tr>
     <td colspan="3">
         <div id="errMsg" style="width: 90%">
            <?php if(!empty($_SESSION['svMsg'])) { echo $_SESSION['svMsg']; } ?>
        </div>
        <?php unset($_SESSION['svMsg']); ?>
     </td>
   </tr>
     <tr>
    <td></td>
    <td><input type="submit" id="reg"  name="save" onclick="validate()" value="Save"></td> 
    <td><input id="updateu" type="button" name="update" onclick="updateuser()" value="Update" ></td>
   
    </tr> 
     

<script type="text/javascript">
   
    function searchuser() {
 
            var uname = $('#user').val();
             if (!uname) {
              alert("Enter username");
             }
             else{
             $.post('searchuser.php',{postuname:uname},
                function(data)
                 {
                  if (!$.trim(data)) {
                    alert("Client Does not exist");

                  }
                    else{
            
                   var duce = jQuery.parseJSON(data);
                    var dt1 = duce.name;
                    var dt2 = duce.uname;
                    var dt3 = duce.pass;
                    var dt4 = duce.branch;
                    var dt5 = duce.level;
                           
                    //set the values
                   $('#name').val(dt1);
                   $('#name').attr('readonly', true);
                   $('#user').val(dt2);
                   $('#user').attr('readonly', true);
                   $('#pass').val(dt3);
                   $('#cpass').val(dt3);
                   $('#branch').val(dt4).attr("selected", "selected");
                   $('#level').val(dt5).attr("selected", "selected");
                    }

                 }

                );}
          
  }

    function checkuser(){
    
      var uname = $('#user').val();
      $.post('checkuser.php',{
        
        postuname:uname,
       
          },
        function(data)
         {
            if (data) {

             alert(data);
           //fillinvestor();
             return false;
            }

            

         }
          );
    }

    function validate(){
      checkuser();
   //event.preventDefault();
     var name = $('#name').val();
     var username = $('#user').val();
     var pass = $('#pass').val();
     var cpass = $('#cpass').val();
      var branch = $('#branch').val();
      var level = $('#level').val();
      var  br ="Select Branch";
      var  lv ="Select level";
    
     if (!pass || !name || !username) {
        alert("Fill all the fields");
        event.preventDefault();
      }
    else  if (branch===br) {
        alert(br);
        event.preventDefault();
      }
      else if (level===lv) {
        alert(lv);
        event.preventDefault();
      }
      else if (pass!=cpass) {
        alert("password mismatch");
        event.preventDefault();
      }

    }

    function updateuser(){
             
       var name = $('#name').val();
       var username = $('#user').val();
       var pass = $('#pass').val();
       var cpass = $('#cpass').val();
       var branch = $('#branch').val();
       var level = $('#level').val();
        var  br ="Select Branch";
        var  lv ="Select level";

      if (branch===br) {
        alert(br);
        event.preventDefault();
      }
      else if (level===lv) {
        alert(lv);
        event.preventDefault();
      }
      else if (pass!=cpass) {
        alert("password mismatch");
        event.preventDefault();
      }
      else if (!name || !username || !pass || !cpass) {
        alert("search user using username")
      }
      else{
        $.post('updateuser.php',{
        
        postname:name,
        postusername:username,
        postpass:pass,
        postbranch:branch,
        postlevel:level, 

          },
        function(data)
         {
            if (data) {
            
             alert(data);
             setTimeout("closeView()", 300);
           
             return false;
            }
           

         }
          );
      }
        
    }
      function closeView() {
        document.location.href = 'sign.php';
    }

</script>
  </form> 
       </table>
        </fieldset>
        </div> 
        </body>
         </html>
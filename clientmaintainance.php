
<?php   require 'check.php';
        require 'functions.php';
        require  'header.php';
        $name = "";
        $idno = "";

?>

<!DOCTYPE >
<html>
<head>
  <title>Maintain Client</title>
  <link rel="stylesheet" type="text/css" href="css/gak.css">
  <script src="js/jquery.js"></script>
</head>
<body>
<?php echo '<div align="center" style="color:#800000" >CLIENT REGISTRATION</div>'; ?>
  <div class="cm">
   <fieldset><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table border="0" >
 <form method="post" action=" insert_client.php?attempt">
  <tr>
    <td><b>Branch</b></td><td><select style="width: 180px" id="branch" name="branch"><?php   branches(); ?></select> </td>
    <td><b>ID/PP</b></td><td><input type="text" placeholder="Enter Client ID/PP" name="scid" id="scid" ></td>
    <td><button type="button" id="sbtn" onclick="searchclient()" value="Search" name="sbtn" formnovalidate>Search</button></td>
  </tr>
  <tr>
    <td><b>Name</b></td>
    <td colspan="3"><input type="text" placeholder="Client name" id="name" name="cname" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" value="<?php  echo $name;?>" style="width:95%;" required></td>
  </tr>
  <tr>
    <td> <b>ID/PP No.</b></td>
    <td><input type="text" placeholder="Enter Indentification" name="cid" id="idno" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');" value="<?php  echo $idno;?>"  required></td>
    <td><b>Phone No.</b></td>
    <td> <input type="text" placeholder="Phone No." id="phoneno" name="phoneno" onclick="checkclient()" onkeyup="this.value=this.value.replace(/[^\d\+]/g,'');" required></td>
  </tr>
  <tr>
    <td colspan="3"> <div id="errMsg" style="width: 90%">
            <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?>
        </div>
        <?php unset($_SESSION['errMsg']); ?></td>
  </tr>
   <tr><td></td>
   <td><button type="submit" id="btnsave" name="csave" onclick="checkid()" >Save</button></td> 
       <td><button type="button" id="btnsave" name="updateu" onclick="updateclient()">Update</button></td>
   </tr>
   
   <script type="text/javascript">

    function searchclient() {

    var cid = $('#scid').val();
    var n = cid.length;
    if (n<6) {
      alert("Enter Valid Indentification ");
      event.preventDefault();
    }
  else if (cid=='') {
        alert("Enter Client ID/PP");
       }
  else{
    $.post('searchclient.php',{postid:cid},
        function(data)
         {
          if (!$.trim(data)) {
            alert("Client Does not exist");

          }

            else{
           var duce = jQuery.parseJSON(data);
            var dt1 = duce.name;
            var dt2 = duce.no;
            var dt3 = duce.phoneno;
            var  dt4 = duce.branch;
           $('#name').val(dt1);
           $('#idno').val(dt2);
           $('#idno').attr('readonly', true);
           $('#phoneno').val(dt3);
           $('#branch').val(dt4).attr("selected", "selected"); 
            }
         }

        );
  }
  }

     //save client
        function checkid(){

       var cid = $('#idno').val();
        var n = cid.length;
    if (n<6) {
      alert("Enter Valid Indentification ID/PP");
      event.preventDefault();
    }

     }
      function checkclient(){

           var id = $('#idno').val();
            var n = id.length;
            if (n<6) {
              alert("Enter Valid Indentification ");
             
            }

       $.post('check_client.php',{postid:id, },
        function(data)
         {
            if (data) {

             alert(data);
          fillclient();
             return false;
            }

         }
          );
        }
//autofill existing client
function fillclient() {

    var cid = $('#idno').val();  
    $.post('searchclient.php',{postid:cid},
        function(data)
         {
           var duce = jQuery.parseJSON(data);
            var dt1 = duce.name;
            var dt2 = duce.no;
            var dt3 = duce.phoneno;
            var dt4 = duce.branch;

           $('#name').val(dt1);
           $('#idno').val(dt2);
           $('#idno').attr('readonly', true);
           $('#phoneno').val(dt3);
           $('#branch').val(dt4).attr("selected", "selected"); 
         }

        );
  
  }

  function updateclient(){

 var id = $('#idno').val();
 var name = $('#name').val();
 var branch = $('#branch').val();
 var phoneno = $('#phoneno').val();

 if (!id || !name || !branch || !phoneno) {
  alert("Search Client using ID NO");
 }
else{
  $.post('updateclient.php',{
       postid:id,
       postname:name,
       postbranch:branch,
       postphone:phoneno,
   },
        function(data)
         {
            if (data) {

          alert(data);
       setTimeout("closeView()", 300);
            }

         }
          );
}
  }
  function closeView() {
        document.location.href = 'home.php';
    }

  </script>
 </form>
 </table>
 </fieldset>
</div> 
</body>
</html>
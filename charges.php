
<?php   require 'check.php';
        require 'functions.php';
        require 'payment_details.php';
        require  'header.php';
        $name = "";
        $idno = "";

?>

 <!DOCTYPE html>
<html>
<head>
  <title>GAKUYO PAYMENTS</title>
  
  <link rel="stylesheet" type="text/css" href="css/gak.css">
  <script src="js/jquery.js"></script>
</head>
<?php echo '<div align="center" style="color:#800000" >GAKUYO CHARGES PAYMENT</div>'; ?>
<body>
<div class="charges">
 <fieldset ><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table border="0"> 
<form id="frm" method="post" action="charges_rct.php">
  <tr>
      <td ><b>Branch</b></td><td>
       <select name="branch" style="width: 180px "  id="branch">

      <?php   branches(); ?>

         </select> </td>

   <td><b>Search</b></td><td>
    <input type="text" placeholder="Enter Client ID/PP" name="scid" id="scid" ></td><td></td><td>
    <button type="button" id="sbtn" onclick="searchclient()" value="Search" name="sbtn" formnovalidate>Search</button>
   </td>
  </tr>
  
  <tr>
   <td><b>Name</b></td><td colspan="3">
    <input type="text" placeholder="Client name"  id="name" name="cname" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');"
      style="width: 95%" value="<?php  echo $name;?>" required></td>

  </tr>

  <tr>
    <td><b>ID/PP No.</b></td><td>
    <input type="text" placeholder="Enter Indentification" name="cid"  id="idno" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');" 
    value="<?php  echo $idno;?>" required></td>
    <td><b>Phone No.</b></td><td>
    <input type="text" placeholder="Phone No." id="phoneno"  name="phoneno" onclick="checkclient()" onkeyup="this.value=this.value.replace(/[^\d\+]/g,'');" required></td>
    <td><b>Type</b></td><td>
    <select id="ptype" name="ptype" style="width:180px" ><option>Select Charge Type</option>
    <?php charge(); ?>
    </select></td></tr><tr>
    <td><b>Amount</b></td><td>
     <input type="text" id="amnt"  name="num" placeholder="Amount Received" required /></td>
     <td><b>Mode</b></td><td>
     <select name="pmode" id="pmode" style="width: 180px" onclick="autoref()"><option>Select Payment Mode</option>
     
        <?php  pmode()?> 
    </select></td>
    <td><b>Ref.</b></td><td>
    <input type="text" placeholder="Reference"  name="ref" id="ref"    onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');" required></td></tr><tr>
      <td><b>Narration</b></td><td colspan="3">
     <input type="text" placeholder="Narration" style="width: 95%" name="nrt" id="nrt" onclick="refn()"  onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d\/]/g,'');" required ></td><td>
   <input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>"/>
   <input type="hidden" name="rctno" value="rctno()" id="rctno"></td>
     </tr>
   
 </tr>
  <td></td><td>
   <button type="submit" id="btnsave" name="btnsave" onclick="validate()" >Save</button></td>
   <td></td>
    <td><input type="reset" id="reset"></td>


 <script type="text/javascript">

     var fnf = document.getElementById("amnt");
            fnf.addEventListener('keyup', function(evt){
            var n = parseInt(this.value.replace(/\D/g,''),10);
            fnf.value = n.toLocaleString();
               }, false);


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

           $('#name').val(dt1);
           $('#idno').val(dt2);
           $('#idno').attr('readonly', true);
           $('#phoneno').val(dt3);
            }
         }

        );
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

           $('#name').val(dt1);
           $('#idno').val(dt2);
           $('#idno').attr('readonly', true);
           $('#phoneno').val(dt3);
            
         }

        );
  
  }
       //check reference no.
    function refn(){
        cbal();
       var ref = $('#ref').val();

       $.post('checkref.php',{
        
        postref:ref,
       
          },
        function(data)
         {
            if (data) {

             alert(data);
           event.preventDefault(); // Cancel the submit  
           $('#ref').val("");
             return false;
            }
         }
          );
        }

     //generate receipt number
        function rctno(){

       $.post('receiptno.php',
          function(data)
         {
            if (data) {
            var duce = jQuery.parseJSON(data);
            var dt1 ="GRE"+ duce.rn;
           
              $('#rctno').val(dt1);
            }
           } );  
        }

        function autoref(){
          rctno();
          $('#ref').val('');
          $('#ref').attr('readonly', false);
          var pmode = $('#pmode').val();
          var ck = "Cash";

          if (pmode===ck) {

       $.post('receiptno.php',
          function(data)
         {
            if (data) {
            var duce = jQuery.parseJSON(data);
            var dt1 ="GRE"+ duce.rn;
           

             $('#ref').val(dt1);
             $('#ref').attr('readonly', true);
     
            }
           } );
          }
         
        }



      //auto reference no.
            function autoref(){
          rctno();
          $('#ref').val('');
          $('#ref').attr('readonly', false);
          var pmode = $('#pmode').val();
          var ck = "Cash";

          if (pmode===ck) {

       $.post('receiptno.php',
          function(data)
         {
            if (data) {
            var duce = jQuery.parseJSON(data);
            var dt1 ="GRE"+ duce.rn;
           

             $('#ref').val(dt1);
             $('#ref').attr('readonly', true);
     
            }
           } );
          }
         
        }
        //check dropdown select
    function validate(){
      var  pmd ="Select Payment Mode";
      var pmode = $('#pmode').val();
      var ptp = "Select Payment Type";
      var ptype = $('#ptype').val();
       if (ptype===ptp) {

        alert("Select Charge Type");
        event.preventDefault();
      }
      else if (pmode===pmd) {
        alert("Select Payment Mode");
        event.preventDefault();
      }
      else if(!confirm ("Do You Want to Save?")){
        event.preventDefault();
        }
    }

          //submiting form
        $('form').submit( function(ev){

         ev.preventDefault();

        var pdate = $('#pdate').val();
        var branch = $('#branch').val();
        var idno = $('#idno').val();
        var ptype = $('#ptype').val();
        var mnt = $('#amnt').val(); 
        var amnt = mnt.replace(/,/g, '');
        var pmode = $('#pmode').val();
        var ref = $('#ref').val();
        var nrt = $('#nrt').val();
        var rno = $('#rctno').val();
        var phoneno = $('#phoneno').val();
        var name = $('#name').val();

           $.post('charges_save.php',{
       
        postpdate:pdate,
        postbranch:branch,
        postidno:idno,
        postptype:ptype,
        postamnt:amnt,
        postpmode:pmode,
        postref:ref,
        postnrt:nrt,
        postrno:rno,
        postphone:phoneno,
        postname:name,
         },
         
           function(data){
   
          
          if (!$.trim(data)) {

          alert("Data Saved");
          
         }
         else{
          window.location.href = "payments.php";
            alert(data);
         }
        
         
        }
        
      );
 
 $(this).unbind('submit').submit()

         

  });

  </script>
 </form>
   </table>
   </fieldset>
   </div>
   </body>
   </html>
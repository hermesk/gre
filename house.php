<?php
  require 'check.php';
  require 'payment_details.php';
  require 'property_details.php';
  require 'functions.php';
 require 'header.php';
?>

<DOCTYPE html>
<html>
<head>
  <title>GRE House Payment Section</title>
    <link rel="stylesheet" type="text/css" href="css/gak.css">
        <script src="js/jquery.js"></script>
</head>
<?php echo '<div align="center" style="color:#800000" >GAKUYO HOUSE PAYMENTS</div>'; ?>
<body >

<div class="house">
<fieldset style="width: 50%" ><legend ><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table border="0">

  <form name="hs" id="hfm" method="post" action="house_rct.php" >
  <tr>
  <td><b>Transaction date</b></td>
   <td> <input id="tdate" name="tdate" type="date" style="width: 180px"  value="<?php echo date('Y-m-d'); ?>" /></td>
  
  <td><b>Location</b></td>
    <td><select name="location" id="location" style="width: 180px" ><option>Select location</option>

      <?php location() ?>
    </select></td>
    <td><b>ID/PP</b></td>
   <td> <input type="text" placeholder="ID/PP"  name="scid" id="scid" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');">
  </td>
   <td> <button type="button" name="sbtn" value="Search" onclick="searchclient()" formnovalidate>Search</button></td>
   </tr>
    
   <tr>

    <td><b>Pay Type</b></td>
    <td><select id="ptype" name="ptype" style="width: 180px"  ><option>Select Payment Type</option>
    <?php ptype(); ?>
    </select></td>
     
     <td><b>Name</b></td>
   <td colspan="3"> <input type="text" placeholder="Client name" style="width:95%" name="cname" id="cname" readonly="readonly"></td>
   </tr>    
    <tr>
     <td><b>ID/PP</b></td>
    <td><input type="text" name="idno" id="idno" readonly="readonly" ></td>
    
    <td><b>Size</b></td>
    <td><select name="hsize" id="size" style="width: 180px" ><option>Select Size</option>
    <?php housesize()    ?>

    </select>
    </td>
   
    <td><b>Cost</b></td>
   <td> <input type="text"  name="cost" id="cost"  placeholder="House Cost" required ></td>
  </tr>
    <tr>
      <td><b>Trx Type</b></td>
    <td> <select name="trxtype" id="trxtype" style="width: 180px" required><option>Select Transaction Type</option>

         <?php trxtype()  ?>
    </select></td> 
  
     <td><b>Amount</b></td>
    <td > <input type="text" id="amnt"  name="num" placeholder="Amount Received" required /></td>
     
    <script type="text/javascript">
    
            var fnf = document.getElementById("amnt");
            fnf.addEventListener('keyup', function(evt){
            var n = parseInt(this.value.replace(/\D/g,''),10);
            fnf.value = n.toLocaleString();
               }, false);
  
    
            var ct = document.getElementById("cost");
            ct.addEventListener('keyup', function(evt){
            var b = parseInt(this.value.replace(/\D/g,''),10);
            ct.value = b.toLocaleString();
               }, false);
  </script>

   
    
    <td><b>Mode</b></td>
    <td> <select name="pmode" id="pmode" style="width: 180px" onclick="autoref()"><option>Select Payment Mode</option>
     
        <?php  pmode()?> 
    </select></td>
 </tr>
  <tr>
    <td><b>Reference</b></td>
   <td> <input type="text" placeholder="Reference"  name="ref" id="ref"    onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');" required></td>
     <td><b>Narration</b></td>
     <td colspan="3"><input type="text" placeholder="Narration"  style="width:95%" name="nrt" id="nrt" onclick="refn()"  onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d\/]/g,'');" required ></td>
  <td> <input type="hidden" name="rctno" value="autoref()" id="rctno"></td>
      <td> <input id="pdate" name="pdate" type="hidden"  value="<?php echo date('Y-m-d'); ?>" readonly="readonly" /></td>
     </tr>
     
     <tr>
          <div id="result" align="center"></div>
       <td></td>
      <td><button type="submit"  name="btnsave" id="btnsave" value="Save" onclick="validate()" required>Save</button></td>
   <td></td>
    <td><input type="reset" id="reset"></td>
        
     </tr>

       <script type="text/javascript">
       //search client
     function searchclient() {

          var cid = $('#scid').val();
          var lc = $('#location').val();
          if (cid=='') {
              alert("Enter Client ID/PP");
             }
             else{
              $.post('house_search.php',{postname:cid,postlocation:lc},
              function(data)
               {
                if (!$.trim(data)) {


                  alert("Client with ID no:"+cid+" Does not exist, Please Register them");
                }

                  else{
                 var duce = jQuery.parseJSON(data);
                  var dt1 = duce.name;
                  var dt2 = duce.no;
                  var dt3 = duce.hcost;

                 $('#cname').val(dt1);
                 $('#idno').val(dt2);
                 $('#cost').val(dt3);

                 
                  }
               }

              );
             }

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

//check dropdown select
    function validate(){
        //do validation here
      var pdate = $('#pdate').val();
      var tdate = $('#tdate').val();
      var ptype = $('#ptype').val();
      var location = $('#location').val();
      var idno = $('#idno').val();
      var size = $('#size').val();
      var cst = $('#cost').val();
      var ct = cst.replace(/,/g, '');
      var cost = parseInt(ct);
      var trxtype = $('#trxtype').val();
      var mnt = $('#amnt').val(); 
      var amntp = mnt.replace(/,/g, '');  
      var amnt = parseInt(amntp);  
      var pmode = $('#pmode').val();
      var ref = $('#ref').val();
      var nrt = $('#nrt').val();
      var ptp = "Select Payment Type";
      var loc = "Select location";
      var sz = "Select Size";
      var trx = "Select Transaction Type";
      var  pmd ="Select Payment Mode";
      
      var cmsg = "Transaction rolled back";
     //refn();

      if (ptype===ptp) {

        alert("Select Payment Type");
        event.preventDefault();
      }

      else if (location===loc) {

        alert("Select location");
        event.preventDefault();
      }
      else if (size===sz) {

        alert("Select House Size");
        event.preventDefault();
      }
      else if (trxtype===trx) {

        alert("Select Transaction Type");
        event.preventDefault();
      }
      
      else if (pmode===pmd) {

        alert("Select Payment Mode");
        event.preventDefault();
      }
       else if(!idno){
        alert("Search the client with ID/PP no");
        event.preventDefault();
       }
     else if (cost<amnt) {

        alert("Amount Received Cannot be greater than the Cost");
        event.preventDefault();
      }

      //check for empty fields
     else if (!idno) {
        alert("Search client by ID/PP");
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
        var tdate = $('#tdate').val();
        var ptype = $('#ptype').val();
        var location = $('#location').val();
        var idno = $('#idno').val();
        var size = $('#size').val();
        var cst = $('#cost').val();
        var cost = cst.replace(/,/g, '');
        var trxtype = $('#trxtype').val();
        var mnt = $('#amnt').val(); 
        var amnt = mnt.replace(/,/g, '');    
        var pmode = $('#pmode').val();
        var ref = $('#ref').val();
        var nrt = $('#nrt').val();
        var rno = $('#rctno').val();
    
           //save in table house
           $.post('house_save.php',{
       
        postpdate:pdate,
        posttdate:tdate,
        postptype:ptype,
        postlocation:location,
        postidno:idno,
        postsize:size,
        postcost:cost,
        posttrxtype:trxtype,
        postamnt:amnt,
        postpmode:pmode,
        postref:ref,
        postnrt:nrt,
        postrno:rno,
          },
         
           function(data){
   
          
          if (!$.trim(data)) {

          alert("Data Saved");
          
         }
         else{
          window.location.href = "house.php";
            alert(data);
         }
        
         
        }
        
      );
 
 $(this).unbind('submit').submit()

         

  });


     
        function refn(){

          
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

      </script>
      </form>
     </table>
      </fieldset>  

</div>
</body>
</html>

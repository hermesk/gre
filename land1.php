  <?php
  require 'check.php';
  require 'payment_details.php';
  require 'property_details.php';
  require 'functions.php';
   require 'header.php';
  $name= "";
?>
<!DOCTYPE html>
<html>
<head>
  <title>GRE Land Payment Section</title>
    <link rel="stylesheet" type="text/css" href="css/gak.css">   
   <script src="js/jquery.js"></script>  
     
</head>

<body>
<?php echo '<div align="center" style="color:#800000" >GAKUYO LAND PAYMENTS</div>'; ?>
<div class="land">
 <fieldset><legend ><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table border="0">
  <form method="post" action="land_rct.php">
    <table  >
    <tr>
     <td><b>Location</b></td>
    <td> <select  id="location" name="location" style="width: 180px"><option>Select location</option>
    <?php location(); ?> </select></td>

     <td><b>Size</b></td><td>
     <select name="lsize" id="lsize" style="width: 180px" ><option>Select Size</option>
    <?php
      landsize();
    ?>
    </select></td>
  
   </tr>
   <tr>
     <td><b>ID/PP</b></td>
    <td><input type="text" placeholder="Search by ID/plotno" name="scid" id="scid" onclick="plotno()" 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');"></td>
    <td><button type="button" id="sbtn" value="Search" name="scid" formnovalidate onclick="searchclient()">Search</button></td>


     <td colspan="3" ><input type="text" placeholder="Client name" style="width:95%;" name="cname" id="cname"  readonly="readonly"></td>
    </tr>
     <tr>
  
  </tr>
    <tr>
       <td><b>Trx Date</b></td>
    <td><input id="tdate" type="date" name="tdate" style="width: 180px" value="<?php echo date('Y-m-d'); ?>" /><br /></td>

     <td><b>Cost</b></td>
    <td><input type="text"  name="cost" id="cost"  placeholder="Plot Cost" required ></td>
     <td><b>Plot No.</b></td>
      <td> <select name="plotn" id="plotn" style="width: 180px">
       <option>Select plot no</option>
     </select></td></tr>
     <tr>
         <td><b>Pay Type</b></td><td>
         <select name="ptype"  style="width: 180px" id="ptype"><option>Select Payment type</option>
         <?php  ptype();?>
         </select></td>
        <td><b>Trx Type</b></td><td>
        <select name="trxtype" id="trxtype"><option>Select transaction type</option>
        <?php trxtype()  ?>
        </select> </td>
        <td><b>Amount</b></td><td>
        <input type="text" placeholder="Amount Received"  name="num" id="amnt"  required></td>            
       </tr>

    <tr> 
         <td><b>Pay Mode</b></td><td>
         <select name="pmode"  style="width: 180px"  id="pmode" onclick="autoref()"><option>Select Payment mode</option>
         <?php  pmode()?>   
         </select></td>
        
          <td><b>Reference</b></td><td>
  <input type="text" placeholder="Reference"  name="ref" id="ref" 
            onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');" required></td>
       
          <td><b>ID/PP</b></td>
         <td> <input type="text" name="cfid"  id="idno" readonly="readonly"></td>
        </tr>
    <tr>
     <td><b>Narration</b></td>
   <td colspan="4">  <input type="text" style="width:95%" placeholder="Narration" name="nrt" id="nrt" onclick="refn()" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d\/]/g,'');" required></td>
      <td><input type="hidden" name="rctno" value="autoref()" id="rctno"></td>
      <td><input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>" /></td>
      
     </tr>
     
     <tr>
     <td></td>
     <td><button type="submit" id="btnsave" value="Save" onclick="validate()">Save</button>  </td>
      <td></td>
      <td><input type="reset" id="reset"></td>
     </tr>
</table>
       <!-- search client--> 
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


      function searchclient() {
   
    var cid = $('#scid').val();
    var lc = $('#location').val();
    
    if (cid=='') {
        alert("Enter Client ID/PP");
       }
       else{
        $.post('land_search.php',{postid:cid,postlocation:lc,},
        function(data)
         {
          if (!$.trim(data)) {

            alert("Client with ID/plotno:"+cid+" Does not exist in: "+lc);
          }

            else{

           var duce = jQuery.parseJSON(data);
            var dt1 = duce.name;
            var dt2 = duce.no;
            var dt3 = duce.lcost;
            var dt4 = duce.plotno;
           $('#cname').val(dt1);
           $('#idno').val(dt2);
           $('#cost').val(dt3);

           if($.trim(dt4)){
            //$('#plotn').html("");
            $('#plotn').append($('<option></option>').val(dt4).text(dt4));
            $('#plotn').val(dt4).prop('selected', true);
    
        
           }
           


            }
       
         }

        );
        //check balance
       
       }
 
}
 

    function plotno(){
      
  
      var loc = $("#location").val();
      var s = "Select location";
      var size = $('#lsize').val();
      var sz = "Select Size";

      if (loc===s) {
         alert("Select location")
      }
      else if (size===sz) {

        alert("Select plot Size");
        event.preventDefault();
      }
    else{
      $.post('plots.php',{postlocation:loc,postsize:size},
       
        function(data)
         {
          $('#plotn').html("");

         if (!$.trim(data)) {
            var n="Nil ";
         $('#plotn').append($('<option></option>').val(n).text(n));
       
          
         }
          else if (data) {
          
          var a="Nil";
    
           
           $('#plotn').append($('<option></option>').val(a).text(a));
          $('#plotn').append(data);
            
            
          }
         
         }

        );
    }
    }

    //check reference no.
    function refn(){
      
        var ref = $('#ref').val();
       if (ref) {
          

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
       else{
        alert("Enter reference")
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

       var ptype = $('#ptype').val();
       var location = $('#location').val();
       var size = $('#lsize').val();
       var trxtype = $('#trxtype').val();
       var pmode = $('#pmode').val();
       var tdate = $('#tdate').val();
       var cb = $('#cbal').val();
       var nb = $('#nbal').val();
       //alert(cb);
      // alert(nb);
       var  ptp ="Select Payment type";
       var loc = "Select location";
       var sz = "Select Size";
       var trx = "Select transaction type";
       var  pmd ="Select Payment mode";
       var ck  ="Cash";

        if (location===loc) {

        alert("Select location");
        event.preventDefault();
      }
      else if (size===sz) {

        alert("Select plot Size");
        event.preventDefault();
      }
      
      else if (ptype===ptp) {

        alert("Select Payment Type");
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
      else if (pmode===ck) {

        
      }
      else if (tdate===td) {

        alert("Select transaction date");
        event.preventDefault();
      }
      else if (!idno) {
        alert("Search client by ID/PP");
        event.preventDefault();
      }
       
        }

         //submiting form
        $('form').submit( function(ev){

        if(!confirm ("Do You Want to Save?")){
        event.preventDefault();
        }
      else{
         ev.preventDefault();

        var pdate = $('#pdate').val();
        var tdate = $('#tdate').val();
        var location = $('#location').val();
        var size = $('#lsize').val();
        var cst = $('#cost').val();
        var cost = cst.replace(/,/g, '');
        var plotno = $('#plotn').val();
        var ptype = $('#ptype').val();
        var trxtype = $('#trxtype').val();
        var mnt = $('#amnt').val(); 
        var amnt = mnt.replace(/,/g, '');    
        var pmode = $('#pmode').val();
        var ref = $('#ref').val();
        var idno = $('#idno').val();
        var nrt = $('#nrt').val();
        var rno = $('#rctno').val();
        var sv  = "Transaction Saved";
           //save in table house
       $.post('land_save.php',{
       
        postpdate:pdate,
        posttdate:tdate,
        postlocation:location,
        postsize:size,
        postcost:cost,
        postplotno:plotno,
        postptype:ptype,
        posttrxtype:trxtype,
        postamnt:amnt,
        postpmode:pmode,
        postref:ref,
        postidno:idno,
        postnrt:nrt,
        postrno:rno,

          },
         
           function(data){
   
          
          if (!$.trim(data)) {

          alert("Data Saved");
          
         }
         else{
            window.location.href = "land.php";
            alert(" Transaction Error.Data not saved");
            alert(data);
         }
        
         
        }
        
      );
 
 $(this).unbind('submit').submit()
    }
         

  });
 

    </script>
     
  </form>
  
 </table>
 </fieldset>     

</div>
 
</body>
</html>

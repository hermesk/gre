<?php
require 'payment_details.php';
require 'header.php';
require 'check.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>GRE INVESTORS CLUB REGISTRATION</title>
    <link rel="stylesheet" type="text/css" href="css/gak.css">   
   <script src="js/jquery.js"></script>  
     
</head>
<?php echo '<div align="center" style="color:#800000" >GAKUYO INVESTORS CLUB REGISTRATION</div>'; ?>
<body>
<div class="investorsr">
 <fieldset><legend><label id="home"><a href="home.php" style="text-decoration:none;"><b>HOME</b></a></label></legend> 
 <table border="0" >
<form method="POST" action="investorsreg_rct.php">
    
 <tr>
    <td><b> Name</b></td>
    <td colspan="2"><input type="text" style="width:100%;" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');"
     placeholder="Full name" id="invname" name="invname" required>
    </td>
    <td padding-right: 10px;><input type="text" placeholder="Search by ID/PP" name="invid" id="sinvidno" 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');"></td>
   <td>  <button type="button" id="sbtn" value="Search" name="scid" formnovalidate onclick="searchinvestor()">Search</button></td>
     </tr>
     <tr>
    <td><b>ID/PP</b></td>
    <td><input type="text" placeholder="ID/PP" name="invid" id="invidno"  required 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');"></td>
    <td><b>BankAccNo</b></td><td>
    <input type="text" placeholder="AC/no."  name="BankAccNo" id="BankAccNo" onclick="checkinvestor()" required 
    onkeyup="this.value=this.value.replace(/[^a-zA-Z\s\d]/g,'');">
    </td>
    <td><b> BankBranch</b></td><td>
    <input type="text" placeholder="nrb"  id="BankBranch" name="BankBranch" required 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');">
    </td>
    </tr>
  <tr>
     <td> <b>Name</b></td><td>
    <input type="text" placeholder="bank name"  id="bankname" name="bankname" required 
     onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');">
    </td>
  
   <td><b>Phone No.</b></td><td>
    <input type="text" placeholder="Phone No." id="phoneno" name="phoneno"  required 
     onkeyup="this.value=this.value.replace(/[^\d\+]/g,'');" required></td>
    <td><b> KRAPIN</b></td>
    <td><input type="text" placeholder="A001555555"  name="kpin" id="kpin"></td>
    </tr>
  <tr>
    <td><b>Reg. Fee</b></td><td>
    <input type="text" placeholder="1234"  name="num" id="amnt" required> </td>

    <td> <b>Pay Mode</b></td><td>
         <select name="pmode"   id="pmode" style="width: 180px" onclick="autoref()"><option>Select Payment Mode</option>
         <?php  pmode()?>   
         </select></td>
    <td> <b>Reference</b></td><td>
    <input type="text" placeholder="reference"  name="ref" id="ref">
    </td> 
  
     </tr>
       <input type="hidden" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>"/>
       <input type="hidden" name="rctno" value="autoref()" id="rctno">
       <td></td>
<td><input type="submit" value="Save" id="btnsave" onclick="validate();"> </td>
<td><input type="button" value="Update" id="btnsave" onclick="update();"></td><td></td>
<td><input type="reset" id="reset"></td>
    


 <script type="text/javascript">
    
            var fnf = document.getElementById("amnt");
            fnf.addEventListener('keyup', function(evt){
            var n = parseInt(this.value.replace(/\D/g,''),10);
            fnf.value = n.toLocaleString();
               }, false);

         function searchinvestor() {

            var invid = $('#sinvidno').val();
            var n = invid.length;
            if (n<6) {
              alert("Enter Valid Indentification ");
              event.preventDefault();
            }
         
          else{
             $.post('searchinvestor.php',{postid:invid},
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
                    var dt4 = duce.acc;
                    var dt5 = duce.bkbr;
                    var dt6 = duce.bkname;
                    var dt7 = duce.kra;
                    var dt8 = duce.pmode;
                    var dt9 = duce.amnt;
                    var dt10 = duce.ref;
                  
                    //set the values
                   $('#invname').val(dt1);
                   $('#invname').attr('readonly', true);
                   $('#invidno').val(dt2);
                   $('#invidno').attr('readonly', true);
                   $('#phoneno').val(dt3);
                   $('#BankAccNo').val(dt4);
                   $('#BankBranch').val(dt5);
                   $('#bankname').val(dt6);
                   $('#kpin').val(dt7);
                   $('#pmode').html("");
                   $('#pmode').append($('<option></option>').val(dt8).text(dt8));
                   $('#amnt').val(dt9);
                   $('#amnt').attr('readonly', true);
                   $('#ref').val(dt10);
                   $('#ref').attr('readonly', true);
                    }

                 }

                );
          }
  }


        //check reference no.
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
         function checkinvestor(){

           var id = $('#invidno').val();
            var n = id.length;
            if (n<6) {
              alert("Enter Valid Indentification ");
             
            }
      

       $.post('check_investor.php',{
        
        postid:id,
       
          },
        function(data)
         {
            if (data) {

             alert(data);
           fillinvestor();
             return false;
            }

            

         }
          );
        }
        //autofill investor

         function fillinvestor() {

            var invid = $('#invidno').val();
          
             $.post('searchinvestor.php',{postid:invid},
                function(data)
                 {
                
                   var duce = jQuery.parseJSON(data);
                    var dt1 = duce.name;
                    var dt2 = duce.no;
                    var dt3 = duce.phoneno;
                    var dt4 = duce.acc;
                    var dt5 = duce.bkbr;
                    var dt6 = duce.bkname;
                    var dt7 = duce.kra;
                    var dt8 = duce.pmode;
                    var dt9 = duce.amnt;
                    var dt10 = duce.ref;
                  
                    //set the values
                   $('#invname').val(dt1);
                   $('#invname').attr('readonly', true);
                   $('#invidno').val(dt2);
                   $('#invidno').attr('readonly', true);
                   $('#phoneno').val(dt3);
                   $('#BankAccNo').val(dt4);
                   $('#BankBranch').val(dt5);
                   $('#bankname').val(dt6);
                   $('#kpin').val(dt7);
                   $('#pmode').html("");
                   $('#pmode').append($('<option></option>').val(dt8).text(dt8));
                   $('#amnt').val(dt9);
                   $('#amnt').attr('readonly', true);
                   $('#ref').val(dt10);
                   $('#ref').attr('readonly', true);
                    

                 }

                );
          
  }


  //update investors details
   function update(){

        var idno = $('#invidno').val();
        var pdate = $('#pdate').val();
        var name = $('#invname').val();
        var accno = $('#BankAccNo').val();
        var bkbr  =$('#BankBranch').val();
        var bkname  =$('#bankname').val();

        var phoneno = $('#phoneno').val();
        var kra = $('#kpin').val();

        if (!idno ||!name || !accno || !bkbr || !bkname || !phoneno ||  !kra) {
          alert("search investor using ID");
        }
  else{
       $.post('updateinvestors.php',{
        postidno:idno,
        postpdate:pdate,
        postname:name,
        postacc:accno,
        postbkbr:bkbr,
        postbkname:bkname,
        postphoneno:phoneno,
        postkra:kra,
          },
         
      function(data){
         alert(data);
         window.location.href = "investorsreg.php";
          }
        
      );

}
   }



     //check dropdown select
    function validate(){
      refn();
      checkinvestor();
      var  pmd ="Select Payment Mode";
      var pmode = $('#pmode').val();
      if (pmode===pmd) {
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
        
        var name = $('#invname').val();
        var idno = $('#invidno').val();

        var accno = $('#BankAccNo').val();
        var bkbr  =$('#BankBranch').val();
        var bkname  =$('#bankname').val();

        var phoneno = $('#phoneno').val();
        var kra = $('#kpin').val();

        var mnt = $('#amnt').val(); 
        var amnt = mnt.replace(/,/g, '');    
        var pmode = $('#pmode').val();
        var ref = $('#ref').val();
        
      
        var rno = $('#rctno').val();
           //save in table house
       $.post('reginvestor_save.php',{
       
        postpdate:pdate,
        postname:name,
        postidno:idno,
        postacc:accno,
        postbkbr:bkbr,
        postbkname:bkname,
        postphoneno:phoneno,
        postkra:kra,
        postpmode:pmode,
        postamnt:amnt,   
        postref:ref,
        postrno:rno,

          },
         
           function(data){
  
          if (!$.trim(data)) {

          alert("Data Saved");
          
         }
         else{
          window.location.href = "investorsreg.php";
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

<html/>


<?php
  require 'mt.php';
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP</title>
  <script src="m/js/jquery.min.js"></script>
  <script src="m/js/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="m/css/bootstrap.min.css" />
  <script src="m/js/bootstrap.min.js"></script>
  <script src="m/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="m/css/bootstrap-multiselect.css" />
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:600px;">
   <h2 align="center">Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP</h2>
   <br /><br />
   <form method="post" id="plotn_form">
    <div class="form-group">
     <label>Select  plotno </label><br>
    <td> <select id="plotn" name="plotn[]" multiple class="form-control" >
    
     </select></td>
     <td><b>Plot No.</b></td>
      <td> <select name="plotn" id="plotn" style="width: 180px">
       <option>Select plot no</option>
        <?php
     landsize();
    ?>
     </select></td>
    </div>
    <div class="form-group">
     <input type="button"  name="submit" value="Show" onclick="plotno()" />
    </div>
   </form>
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('#plotn').multiselect({
  nonSelectedText: 'Select plotn',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'150px'
 });
 
 /*$('#plotn_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#plotn option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#plotn').multiselect('refresh');
    alert(data);
   }
  });
 });


 */
 
   function plotno(){
      
  
      var loc = 'YATTA';//$("#location").val();
      //var s = "Select location";
      var size = 'EIGHTH';//$('#lsize').val();
     // var sz = "Select Size";

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
 
});
</script>
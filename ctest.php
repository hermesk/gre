

<HTML> 
<HEAD> 
<TITLE>Automation Server Demo>/TITLE> 
<SCRIPT LANGUAGE="JAVASCRIPT"> 
function OpenReport() 
{ 
var RptName = document.DispRep.RptList.options[document.DispRep.RptList.selectedIndex].value; 
DispRep.METHOD = "POST"; 
DispRep.ACTION = RptName; 
DispRep.submit(); 
} 
</SCRIPT> 
</HEAD> 
<BODY> 
<FORM NAME="DispRep" METHOD="POST" ACTION="DispRpt.asp"> 
<SELECT NAME="RptList"> 
<OPTION VALUE="Report1.rpt" > Report1.rpt </OPTION> 
<OPTION VALUE="Report2.rpt" > Report2.rpt </OPTION> 
<OPTION VALUE="Report3.rpt" > Report3.rpt </OPTION> 
<OPTION VALUE="Report4.rpt" > Report4.rpt </OPTION> 
<OPTION VALUE="Report5.rpt" > Report5.rpt </OPTION> 
</SELECT> 
<INPUT TYPE="HIDDEN" NAME=rf VALUE=1> 
<INPUT TYPE="HIDDEN" NAME=user0 VALUE=yourusername> 
<INPUT TYPE="HIDDEN" NAME=password0 VALUE=yourpassword> 
<input type="BUTTON" value="Get Report" onclick="OpenReport();"> 
</FORM> 
</BODY> 
</HTML> 
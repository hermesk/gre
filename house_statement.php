<?php
//Import the PhpJasperLibrary
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
//include "includes/functions.php";
//database connection details
$server="localhost";
$db="gakuyo";
$user="dab";
$pass="3306";
$pchartfolder="./class/pchart2";

//display errors should be off in the php.ini file
ini_set('display_errors', 0);
//setting the path to the created jrxml file
$xml =  simplexml_load_file('reports/house_report.jrxml');
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
//$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
//$PHPJasperXML->odbc_connect("Driver={SQL Server Native Client 10.0};Server=localhost;Database=gakuyo;", "dab", "3306");
//$PHPJasperXML->transferDBtoArray($server,"dab","3306","phpjasperxml","odbc");
$PHPJasperXML->transferDBtoArray($PHPJasperXML);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
?>
<?php session_start(); ?>
<?php
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
ob_start ();
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$xml =simplexml_load_file("teste.jrxml");
$P=$_GET["id"];
$PHPJasperXML->arrayParameter=array("id"=>$P);
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->xml_dismantle($xml);
//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); //* use this line if you want to connect with mysql
$PHPJasperXML->transferDBtoArray($server,"sa","123","dbq","odbc");
//if you want to use universal odbc connection, please create a dsn connection in odbc first
//$PHPJasperXML->transferDBtoArray($server,"odbcuser","odbcpass","phpjasperxml","odbc"); //odbc = connect to odbc
//$PHPJasperXML->transferDBtoArray($server,"psqluser","psqlpass","phpjasperxml","psql"); //odbc = connect to potgresql
$PHPJasperXML->outpage("I"); //page output method I:standard output D:Download file
?>
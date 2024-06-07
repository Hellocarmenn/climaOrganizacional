<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
$con = mysql_connect("mundoprogresivocom.powwebmysql.com","ce_clima","Asdfg@12345");
mysql_select_db ("climaorganizacional", $con) OR die ("No se puede conectar");

$fecha=substr(strftime("%Y-%m-%d %H:%M:%S",time()),0,10);
$hora=substr(strftime("%Y-%m-%d %H:%M:%S",time()),11,8);

$query = "SELECT correoCorporativo FROM baseclima WHERE correoCorporativo='".$_POST["usuario"]."' and password='".$_POST["password"]."'";
$result = mysql_query($query) or die('Intentar más tarde..');
if(mysql_num_rows($result)>0)
	{
	$_SESSION['u']=$_POST["usuario"];

	$query = "insert into termometro values('".$_POST["usuario"]."','".$fecha."','".$hora."','".basename(__FILE__, '.php')."')";
	mysql_query($query);

	$query = "select cuestionario,correoCorporativo from baseclima where correoCorporativo ='".$_POST["usuario"]."'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	 	{
		if($row['cuestionario']=="clima")
			$pagina="bienvenidaCEL.php";
		if($row['cuestionario']=="nom")
			$pagina="bienvenidaNOM.php";
		}
	header("location:$pagina");
	}
else
	header("location:loginc.php?acceso=denegado");
?>

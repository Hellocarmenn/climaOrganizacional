<?php
session_start();

$con = mysql_connect("mundoprogresivocom.powwebmysql.com","ce_clima","Asdfg@12345");
mysql_select_db ("climaorganizacional", $con) OR die ("No se puede conectar");

$folio=$_POST["folio"];
$fecha=substr(strftime("%Y-%m-%d %H:%M:%S",time()),0,10);
$hora=substr(strftime("%Y-%m-%d %H:%M:%S",time()),11,8);

$query = "select * from baseclima where correoCorporativo ='".$_SESSION["u"]."'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	$departamento=$row["departamento"];	
	$area=$row["area"];	
	}

$factores="";
$query = "select concat('r',id) as p from clima2 order by id";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	$factores[]=$row["p"];

$sql="insert into respuestasclima(folio,fecha,hora,departamento,area,";

foreach($factores as $factor)
	$sql=$sql.$factor.",";

$sql=$sql."
a1,
a2,
a3,
e1,
e2,
e3,
genero,
edad,
estadocivil,
antiguedad,
grado,
discapacidad,
igualdad,
codigoetica,
comite)
";

$factores="";
$query = "select concat('r',id) as p from clima2 order by id";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	$factores[]=$row["p"];

$sql=$sql." values('".$folio."','".$fecha."','".$hora."','".$departamento."','".$area."',";

foreach($factores as $factor)
	$sql=$sql."'".$_POST[$factor]."',";

$sql=$sql."
'".$_POST["a1"]."',
'".$_POST["a2"]."',
'".$_POST["a3"]."',
'".$_POST["e1"]."',
'".$_POST["e2"]."',
'".$_POST["e3"]."',
'".$_POST["genero"]."',
'".$_POST["edad"]."',
'".$_POST["estadocivil"]."',
'".$_POST["antiguedad"]."',
'".$_POST["grado"]."',
'".$_POST["discapacidad"]."',
'".$_POST["igualdad"]."',
'".$_POST["codigoetica"]."',
'".$_POST["comite"]."')

";

//echo $sql;
mysql_query($sql) or die("Favor de contactar al administrador del sistema.");
?>
<script>document.location.href="gracias.php"</script>


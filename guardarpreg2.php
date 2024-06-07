<?php
$con = mysql_connect("mundoprogresivocom.powwebmysql.com","ce_clima","Asdfg@12345");
mysql_select_db ("climaorganizacional", $con) OR die ("No se puede conectar");


$someSwitchOptionPrimary1=$_POST["someSwitchOptionPrimary1"];
foreach($someSwitchOptionPrimary1 as $valor)
	{
	mysql_query("insert into clima2 select * from clima where id='$valor'");
	}


?>
<script language="javascript">window.location.href = 'factores.php';</script>
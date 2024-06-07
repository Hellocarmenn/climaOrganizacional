<?php
session_start();
ini_set('memory_limit', '4192M');
set_time_limit(0);
require_once 'PHPExcel/IOFactory.php';

$con = mysql_connect("mundoprogresivocom.powwebmysql.com","ce_clima","Asdfg@12345");
mysql_select_db ("climaorganizacional", $con) OR die ("No se puede conectar");

if($_FILES["filed1"]["tmp_name"]<>""){
$time=substr(time(),7,3);
$rand=rand(100,999);
$id2=$time.$rand;
move_uploaded_file($_FILES["filed1"]["tmp_name"],"fotos/".$id2.".".substr($_FILES["filed1"]["name"], strrpos($_FILES["filed1"]["name"], ".") + 1));
}

$filed="fotos/".$id2.".xlsx";

$objPHPExcel = PHPExcel_IOFactory::load("$filed");
$worksheet = $objPHPExcel->getSheet(0); 
$highestRow = $worksheet->getHighestRow();

mysql_query("set names utf8");

$sql="delete from baseclima";
mysql_query($sql);

for ($row = 13; $row <= $highestRow; ++ $row)
	{
	$query="insert into baseclima(nombre,apellidoPaterno,apellidoMaterno,noColaborador,departamento,area,correoCorporativo,correoPersonal,password,cuestionario) values(";
	for ($col = 0; $col <= 7; ++ $col)
		{
		$cell = $worksheet->getCellByColumnAndRow($col, $row);
		$val = $cell->getFormattedValue();
		$query=$query."'$val',";
		}
	$pass=substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ12345678901234567890123456789') , 0 , 17 );
	$query=$query."'$pass','clima')";
	mysql_query($query);
	//echo $query."<br><br><br>";
	}

mysql_query("delete from baseclima where nombre=''");

$query = "select count(*) as cont from baseclima";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	$cont=$row["cont"];

?>
<script language="javascript">alert("<?php echo $cont ?> registros cargados");</script>
<script language="javascript">window.location.href = 'evaluacionClima.php';</script>

<?php
$con = mysql_connect("mundoprogresivocom.powwebmysql.com","ce_clima","Asdfg@12345");
mysql_select_db ("climaorganizacional", $con) OR die ("No se puede conectar");

$cont=0;
$query = "select * from baseclima where cuestionario='clima' limit 8";
$result = mysql_query($query);

if(mysql_num_rows($result)==0){
?>
<script language="javascript">alert('Correos enviados.')</script>
<script language="javascript">window.location.href="evaluacionClima.php"</script>
<?php
}

while($row = mysql_fetch_array($result)){

$email0=$row['correoCorporativo'];
$usuario=$email0;
$password=$row['password'];
$nombre=$row['nombre'];

include_once('class.phpmailer.php');
$mail = new PHPMailer();

$body = "<html><body>";
$body = $body . "Estimado $nombre,<br><br>Recibe un cordial saludo.<br><br>Esperando te encuentres bien, te comentamos que a partir del día de hoy, la encuesta de clima laboral estará a tu disposición para que la contestes desde cualquier dispositivo cuente con internet (computadora, celular, tableta).<br><br>";
$body = $body . "Si ya realizaste la <strong>Encuesta de Clima</strong>, te agradecemos mucho tu participación. En caso de que aún no la completes, te invitamos a que accedas y nos des tu opinión.<br><br>";
$body = $body . "<strong>Link para ingresar: </strong><a href='https://mundoprogresivo.com/climaOrganizacional/loginc.php'>https://mundoprogresivo.com/climaorganizacional/loginc.php</a><br>";
$body = $body . "<strong>Usuario: </strong>$usuario<br>";
$body = $body . "<strong>Contraseña: </strong>$password<br><br>";
$body = $body . "Te invitamos a responder con total sinceridad.<br><br>¡Reflexiona y tómate tu tiempo!<br><br>Lograr el ambiente de trabajo ideal, ¡Está en tus manos!<br><br>";

$mail->Mailer = "smtp";
$mail->Host = "smtp.powweb.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "encuestadeclima@mundoprogresivo.com";
$mail->Password = "Zxcvb@12345";
$mail->From     = "encuestadeclima@mundoprogresivo.com";

$mail->FromName = "Encuesta de Clima";
$mail->Subject  = "Encuesta de Clima 2023";
$mail->MsgHTML($body);
$mail->AltBody = strip_tags($mail->Body);

$mail->AddAddress($email0);

if($mail->Send())
	{
	echo $email0." - OK<br>";
	$cont++;
	mysql_query("update baseclima set cuestionario='clima' where correoCorporativo='$email0'");
	}
else
	{
	echo $email0." - ".$mail->ErrorInfo;
	//return(0);
	}
}
?>
<script language="javascript">window.location.href="mail.php"</script>

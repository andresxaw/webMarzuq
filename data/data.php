<?php
function ObtenerIP()
	{
	   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
	           $ip = getenv("HTTP_CLIENT_IP");
	   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	           $ip = getenv("HTTP_X_FORWARDED_FOR");
	   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	           $ip = getenv("REMOTE_ADDR");
	   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	           $ip = $_SERVER['REMOTE_ADDR'];
	   else
	           $ip = "IP desconocida";
	   return($ip);
	}

if (isset($_POST) && sizeof($_POST) > 0) {
	
	$email = "ginnasandoval@marzuq.co, eventosmarzuq@gmail.com, matallanamaria01@gmail.com, andresxaw@gmail.com";
	
	if (isset($_POST['formtype'])) {
		unset($_POST['formtype']);
	}
	
	$primer = array_values($_POST);
	$asunto = "Contacto [Marzuq - Bodas]: " . $primer[0];
	$mensaje    = "Hemos recibido un nuevo contacto<br/><br/>".
				  	 "Datos de contacto: <br/><br/>";
				  	 foreach ($_POST as $campo => $valor) {
				  	 	$mensaje .= "<strong>" . $campo . ": </strong> " . $valor . "<br/>";
				  	 }
				  	 $mensaje .= "<strong>IP: </strong> " . ObtenerIP() . "<br/>";

	$headers = "From:cliente@marzuq.co\n";
	$headers.= "Content-Type:text/html; charset=UTF-8";
	if($email != "") {
		$envio = mail($email,$asunto,$mensaje,$headers);
		if($envio){
			header('location: ../gracias.html');
		}
	}else{
		echo "no se pudo enviar";
	}
}
?>
<?php
    $msjSendEmail = "";
    if(isset($_POST['sendEmail'])){
    	require_once 'controller/email/class.smtp.php';
    	require_once 'controller/email/PHPMailerAutoload.php';
    	require_once 'controller/email/class.phpmailer.php';
    	$name = $_POST['name'];
		$email = $_POST['email'];
		$msjEmail = $_POST['message'];
		
		$correo = new PHPMailer();
		$correo->IsSMTP();
		$correo->SMTPAuth = true;
		$correo->SMTPSecure = 'tls';
		$correo->Host = "smtp.gmail.com";
		$correo->Port = 587;
		$correo->Username = "soportesyslife@gmail.com";
		$correo->Password = "equipo_syslife";
		$correo->setFrom("soportesyslife@gmail.com");
		$correo->addAddress('migmosquera2303@gmail.com');
		$correo->Subject = "correo enviado por '.$name.'";
		$correo->MsgHTML("<strong>Mensaje enviado por el usuario:</strong> $name </br> <strong>Email:</strong> $email  </br> <strong>Mensaje:</strong> $msjEmail  ");
		if(!$correo->Send()) {
		  $msjSendEmail = "Hubo un error: " . $correo->ErrorInfo;
		} else {
		  $msjSendEmail = "Mensaje enviado con exito.";
		}
    }
?>
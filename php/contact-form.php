<?php
if(isset($_POST["action"])) {
	$name = $_POST['name'];        // Sender's name
	$email = $_POST['email'];      // Sender's email address
	$phone  = $_POST['phone'];     // Sender's phone number
	$message = $_POST['message'];  // Sender's message
	$headers = "From: Sprotic <contacto@sprotic.com>\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
	$to = 'contacto@sprotic.com';     // Recipient's email address
	$subject = 'Mensaje de '. $name; // Message title
	$body = " De: $name \n Correo: $email \n Telefono : $phone \n Mensaje : $message";
	// init error message
	$errmsg='';
	// Check if name has been entered
	if (isset($_POST['name']) && $_POST['name'] == '') {
		$errmsg .= '<p>Por favor ingresa tu nombre.</p>';
	}
	// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errmsg .= '<p>Por favor ingresa tu correo.</p>';
	}
	//Check if phone number has been entered
	if ( isset($_POST['phone']) && $_POST['phone'] == '') {
		$errmsg .= '<p>Por favor ingrese su telefono.</p>';
	}
	
	//Check if message has been entered
	if ( isset($_POST['message']) && $_POST['message'] == '') {
		$errmsg .= '<p>Escriba su mensaje.</p>';
	}

	/* Check Google captch validation */
	if( isset( $_POST['g-recaptcha-response'] ) ){
		$error_message = validation_google_captcha( $_POST['g-recaptcha-response'] );
		if($error_message!=''){
			$errmsg .= $error_message;
		}
	}	
	
	$result='';
	// If there are no errors, send the email
	if (!$errmsg) {
		if (mail($to, $subject, $body, $headers)) {
			$result='<div class="alert alert-success">Gracias por contactarnos. Su mensaje ha sido enviado con éxito. ¡Nos pondremos en contacto contigo muy pronto!</div>';
		}
		else {
		  $result='<div class="alert alert-danger">Lo siento, hubo un error al enviar tu mensaje. Por favor, inténtelo de nuevo más tarde.</div>';
		}
	}
	else{
		$result='<div class="alert alert-danger">'.$errmsg.'</div>';
	}
	echo $result;
 }

/*
 * Validate google captch
 */
function validation_google_captcha( $captch_response){

	/* Replace google captcha secret key*/
	$captch_secret_key = '6LfPE5smAAAAALw9qIDtrg7M3p8mNqT4szmaPI-P';
	
	$data = array(
            'secret'   => $captch_secret_key,
            'response' => $captch_response,
			'remoteip' => $_SERVER['REMOTE_ADDR']
        );
	$verify = curl_init();
	curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($verify, CURLOPT_POST, true);
	curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($verify);
	$response = json_decode( $response, true );
	$error_message='';
	if( isset($response['error-codes']) && !empty($response['error-codes'])){
		if( $response['error-codes'][0] == 'missing-input-secret' ){
			
			$error_message = '<p>Falta el parámetro secreto de recaptcha.</p>';
			
		}elseif( $response['error-codes'][0] == 'invalid-input-secret' ){
			
			$error_message = '<p>El parámetro secreto de recaptcha no es válido o tiene un formato incorrecto.</p>';
			
		}elseif( $response['error-codes'][0] == 'missing-input-response' ){
			
			$error_message = '<p>Falta el parámetro de respuesta recaptcha.</p>';
			
		}elseif( $response['error-codes'][0] == 'invalid-input-response' ){
			
			$error_message = '<p>El parámetro de respuesta de recaptcha no es válido o tiene un formato incorrecto.</p>';
			
		}elseif( $response['error-codes'][0] == 'bad-request' ){
			
			$error_message = '<p>La solicitud de recaptcha no es válida o tiene un formato incorrecto.</p>';
		}
	}	
	if( $error_message !=''){
		return $error_message;
	}else{
		return '';
	}
  }
  ?>
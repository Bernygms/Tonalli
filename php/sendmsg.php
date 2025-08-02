<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["action"])) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $message = $_POST['message'];

    $errmsg = '';

    if (empty($name)) {
        $errmsg .= '<p>Por favor ingresa tu nombre.</p>';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errmsg .= '<p>Por favor ingresa tu correo.</p>';
    }

    if (empty($phone)) {
        $errmsg .= '<p>Por favor ingrese su teléfono.</p>';
    }

    if (empty($message)) {
        $errmsg .= '<p>Escriba su mensaje.</p>';
    }

    if (isset($_POST['g-recaptcha-response'])) {
        $error_message = validation_google_captcha($_POST['g-recaptcha-response']);
        if ($error_message != '') {
            $errmsg .= $error_message;
        }
    }

    $result = '';

    if (!$errmsg) {
        $mail = new PHPMailer(true);
        try {
            // Configura tu servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'mail.sprotic.com'; // Cambia esto
            $mail->SMTPAuth   = true;
            $mail->Username   = 'contacto@sprotic.com'; // Cambia esto
            $mail->Password   = '';        // Cambia esto
            $mail->SMTPSecure = 'tls';                  // 'tls' o 'ssl'
            $mail->Port       = 587;                    // 587 (tls) o 465 (ssl)

            // Encabezados
            $mail->setFrom('contacto@sprotic.com', 'Sprotic');
            $mail->addAddress('contacto@sprotic.com'); // Receptor

            $mail->addReplyTo($email, $name);

            $mail->isHTML(false);
            $mail->Subject = 'Mensaje de ' . $name;
            $mail->Body    = "De: $name\nCorreo: $email\nTeléfono: $phone\nMensaje:\n$message";

            $mail->send();
            $result = '<div class="alert alert-success">Gracias por contactarnos. Su mensaje ha sido enviado con éxito. ¡Nos pondremos en contacto contigo muy pronto!</div>';
        } catch (Exception $e) {
            $result = '<div class="alert alert-danger">Error al enviar el mensaje. Error: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        $result = '<div class="alert alert-danger">'.$errmsg.'</div>';
    }

    echo $result;
}

// Validación del captcha
function validation_google_captcha($captch_response){
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
    $response = json_decode($response, true);
    $error_message = '';

    if (isset($response['error-codes']) && !empty($response['error-codes'])) {
        switch ($response['error-codes'][0]) {
            case 'missing-input-secret':
                $error_message = '<p>Falta el parámetro secreto de recaptcha.</p>'; break;
            case 'invalid-input-secret':
                $error_message = '<p>El parámetro secreto de recaptcha no es válido o tiene un formato incorrecto.</p>'; break;
            case 'missing-input-response':
                $error_message = '<p>Falta el parámetro de respuesta recaptcha.</p>'; break;
            case 'invalid-input-response':
                $error_message = '<p>El parámetro de respuesta de recaptcha no es válido o tiene un formato incorrecto.</p>'; break;
            case 'bad-request':
                $error_message = '<p>La solicitud de recaptcha no es válida o tiene un formato incorrecto.</p>'; break;
        }
    }
    return $error_message;
}
?>

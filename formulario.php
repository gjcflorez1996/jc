<?php

if (empty($_POST["nombre"])) {
    exit("Falta el nombre");
}

if (empty($_POST["correo"])) {
    exit("Falta el correo");
}

if (empty($_POST["celular"])) {
    exit("Falta el celular");
}

if (empty($_POST["mensaje"])) {
    exit("Falta el mensaje");
}

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$celular = $_POST["celular"];
$mensaje = $_POST["mensaje"];

$correo = filter_var($correo, FILTER_VALIDATE_EMAIL);
if (!$correo) {
    echo "Correo inválido. Intenta con otro correo.";
    exit;
}

$asunto = "Nuevo mensaje de sitio web";

$datos = "De: $nombre\nCorreo: $correo\nCelular: $celular\nMensaje: $mensaje";
$mensaje = "Has recibido un mensaje desde el formulario de contacto de tu sitio web. Aquí están los detalles:\n$datos";
$destinatario = "jcflorez1996@gmail.com"; # aquí la persona que recibirá los mensajes
$encabezados = "Sender: correo@dominio.com\r\n"; # El remitente, debe ser un correo de tu dominio de servidor
$encabezados .= "From: $nombre <" . $correo . ">\r\n";
$encabezados .= "Reply-To: $nombre <$correo>\r\n";
$resultado = mail($destinatario, $asunto, $mensaje, $encabezados);
if ($resultado) {
    header('Location: gracias.html');

} else {
    echo "Tu mensaje no se ha enviado. Intenta de nuevo.";
}
exit;
<?php

require('./mailService.php');

$to = 'j.velazquez1985@gmail.com';

$subject = 'Prueba de mail desde Herlam digital';

$mensaje = '<h1>Esto es un titulo</h1>';

$mensaje .= '<p>Este es el cuerpo del mensage. Es un texto largo para probar que pasa si no se controla el largo. Asi que esto es algo algo algo algo.</p>';
$mensaje .= '<br><p>Muchas gracias</p>';

enviarMail($to, $subject, $mensaje);

echo 'El mail se envio';
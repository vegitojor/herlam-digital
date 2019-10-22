<?php
function enviarMail($destinatario, $subject, $mensaje){
    // Create the email and send the message
    // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $to = $destinatario; 
    $email_subject = $subject;

    $email_body = '<html><body>';
    $email_body .= '<div style="width:100%; padding:10px 10px;"><img src="../img/logo.png" style="height:20px; width:auto;" /></div>';
    $email_body .= '<div style="padding:10px 10px">';
    $email_body .= $mensaje;
    $email_body .= '</div>';
    $email_body .= '</body></html>';

    $headers = "From: ventas@herlam.com.ar\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: ventas@herlam.com.ar\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=ISO-8859-1\n";   
    mail($to,$email_subject,$email_body,$headers);
}
        
?>
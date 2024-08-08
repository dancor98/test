<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;


    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> <br> <br> Se ha creado tu cuenta exitosamente, Tu contrasena temporal es: 1234567CCM ,Recuerda cambiarla una vez ingresado al sistema; pero es necesario confirmarla.</p>";
        $contenido .= "<p><br>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";
        $contenido .= "<p><br><br>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //Envio Correo al nuevo colaborador para que confirme la cuenta

    public function enviarInstrucciones()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> <br><br> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p><br>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";
        $contenido .= "<p><br><br>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //Envia las instrucciones para cambiar la contrasena en caso de olvido de la misma

    public function enviarConfirmacionBoleta()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Ya se genero tu boleta de pago';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  " <br> <br> </strong> Ya esta generada tu boleta de pago, la cual viene adjunta a este correo. Recuerda que puedes ver el historico de boletas de pago en la plataforma.</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $rutaPDF = $this->token;
        $mail->addAttachment($rutaPDF);

        //Enviar el mail
        $mail->send();
    } //Notifica al colaborador que ya se genero la boleta de pago del mes

    public function enviarEstadoPostulacion()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Actualizacion de estado en solicitud';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  " <br> <br> </strong> El encargado de Recursos Humanos marco tu postulacion como: $this->token . <br> </p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //Notifica al colaborador que ya se actualizo el estado de la solicitud de vacaciones
    public function enviarEstadoVacaciones()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Actualizacion de estado en solicitud';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  " <br> <br> </strong> El estado de tu solicitud de vacaciones paso a: $this->token . <br> Podes ingresar al sistema y revisar tu solicitud </p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //Notifica al colaborador que ya se actualizo el estado de la solicitud de vacaciones

    public function enviarIncapacidad()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress('bot@specialized.co.cr', $this->nombre);
        $mail->Subject = 'Nueva Incapacidad Registrada';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola, <br> <br> </strong> El colaborador $this->nombre, ha ingresado una incapacidad. <br> </p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //Notifica al administrador que se genero una nueva incapacidad
    public function enviarEstadoIncapacidad()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Actualizacion de estado en Incapacidad';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  " <br> <br> </strong> El estado de tu incapacidad paso a: $this->token . <br> </p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //Notifica al colaborador que ya se actualizo el estado de la incapacidad


    public function enviarSolicitud()
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('bot@specialized.co.cr', 'Bot');
        $mail->addAddress('bot@specialized.co.cr', 'Admin');
        $mail->Subject = 'Nueva Solicitud de Vacaciones';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<head>';
        $contenido .= '<title></title>';
        $contenido .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $contenido .= '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
        $contenido .= '</head>';
        $contenido .= '<body style="word-spacing:normal;background-color:#f7f7f7;">';
        $contenido .= '<div class="root-container" style="background-color:#f7f7f7; margin:0 auto; max-width:600px;">';
        $contenido .= '<div class="root-container-spacing" style="padding-top:50px; padding-bottom:20px; font-size:0;">';
        $contenido .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="kl-section" role="presentation" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td>';
        $contenido .= '<div style="background:#ffffff; margin:0 auto; border-radius:0px; max-width:600px;">';
        $contenido .= '<table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#ffffff; width:100%; border-radius:0px;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td style="direction:ltr; font-size:0px; padding:20px 0; text-align:center;">';
        $contenido .= '<div class="content-padding first" style="padding-left:0; padding-right:0;">';
        $contenido .= '<div class="kl-row colstack" style="display:table; table-layout:fixed; width:100%;">';
        $contenido .= '<div class="kl-column" style="display:table-cell; vertical-align:top; width:100%;">';
        $contenido .= '<div class="mj-column-per-100 mj-outlook-group-fix component-wrapper hlb-wrapper" style="font-size:0; text-align:left; direction:ltr; vertical-align:top; width:100%;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td class="hlb-block-settings-content" style="background-color:#1E293B; vertical-align:top; padding-top:32px; padding-right:20px; padding-bottom:8px; padding-left:20px;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td align="top" class="kl-header-link-bar" style="font-size:0; padding:0;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="color:#000000; font-family:Ubuntu, Helvetica, Arial, sans-serif; font-size:13px; line-height:22px; table-layout:auto; width:100%; border:0;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td align="center" class="hlb-logo" style="display:table-cell; width:100%; padding-bottom:10px;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td style="width:92px;">';
        $contenido .= '<img src="https://d3k81ch9hvuctc.cloudfront.net/company/WNM9HD/images/d8f43a23-fb42-4fe4-8697-3267c169710b.png" style="display:block; outline:none; text-decoration:none; height:auto; width:100%; background-color:transparent;" width="92"/>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="kl-section" role="presentation" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td>';
        $contenido .= '<div style="background:#ffffff; margin:0 auto; border-radius:0px; max-width:600px;">';
        $contenido .= '<table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#ffffff; width:100%; border-radius:0px;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td style="direction:ltr; font-size:0px; padding:20px 0; text-align:center;">';
        $contenido .= '<div class="content-padding last" style="padding-left:0; padding-right:0;">';
        $contenido .= '<div class="kl-row colstack" style="display:table; table-layout:fixed; width:100%;">';
        $contenido .= '<div class="kl-column" style="display:table-cell; vertical-align:top; width:100%;">';
        $contenido .= '<div class="mj-column-per-100 mj-outlook-group-fix component-wrapper" style="font-size:0; text-align:left; direction:ltr; vertical-align:top; width:100%;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td style="vertical-align:top; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td align="center" class="kl-image" style="font-size:0; word-break:break-word;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0px;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td class="kl-img-base-auto-width" style="border:0; padding:0; width:600px;" valign="top">';
        $contenido .= '<img src="https://d3k81ch9hvuctc.cloudfront.net/company/WNM9HD/images/6d86d0da-b264-47e9-81d5-7d7153b30a92.jpeg" style="display:block; outline:none; text-decoration:none; height:auto; font-size:13px; width:100%;" width="600"/>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '<div class="mj-column-per-100 mj-outlook-group-fix component-wrapper" style="font-size:0; text-align:left; direction:ltr; vertical-align:top; width:100%;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td style="vertical-align:top; padding-top:20px; padding-right:30px; padding-bottom:20px; padding-left:30px;">';
        $contenido .= '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">';
        $contenido .= '<tbody>';
        $contenido .= '<tr>';
        $contenido .= '<td align="left" class="kl-text" style="font-size:0; padding:0;">';
        $contenido .= '<div style="font-family:\'Helvetica Neue\', Arial; font-size:14px; font-style:normal; font-weight:400; letter-spacing:0px; line-height:1.3; text-align:left; color:#282828;">';
        $contenido .= '<p><strong>Hola Administrador,</strong><br><br>El Colaborador ' . $this->nombre . ', acaba de realizar una solicitud de vacaciones. Ya puedes ingresar y ver la solicitud.</p>';
        $contenido .= '</div>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '</td>';
        $contenido .= '</tr>';
        $contenido .= '</tbody>';
        $contenido .= '</table>';
        $contenido .= '</div>';
        $contenido .= '</body>';
        $contenido .= '</html>';

        $mail->IsHTML(true);
        $mail->Body = $contenido;


        //Enviar el mail
        $mail->send();
    } // Notifica al administrador que un colaborador solicito vacaciones


}

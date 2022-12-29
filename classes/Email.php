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
        // crear el objeto
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '71672b2db2596d';
        $mail->Password = '1ca75c8179ff3a';

        $mail->setFrom('Elisban.com');
        $mail->addAddress('cuentas@barbersop.com', 'Barbersop King');
        $mail->Subject = 'Confirmacion de tu Cuenta';

        //    set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>
        Has creado tu cuenta en BarberShop, precione el siguiente boton 
        para confirmar</p>";
        $contenido .= "<p>Presiona aqui: 
        <a href='http://localhost:3000/public/confirmar-cuenta?token="
        . $this->token . "'>Confirmar Cuenta</a> </p>";

        $contenido .= "<p> Si no fuiste tu ignora este correo";
        $contenido .= "<p><small>Gracias Por formar parte de <strong>Barbersop</stong></small></p>";
        $contenido .= "</html>";


        $mail->Body = $contenido;
        
        $mail->send();
    }

    public function enviarInstrucciones(){
        // crear el objeto
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '71672b2db2596d';
        $mail->Password = '1ca75c8179ff3a';

        $mail->setFrom('Elisban.com');
        $mail->addAddress('cuentas@barbersop.com', 'Barbersop King');
        $mail->Subject = 'restablecer Contraseña';

        //    set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>
        Solicitaste restablecer tu contraseña
        </p>";
        $contenido .= "<p>Presiona aqui: 
        <a href='http://localhost:3000/public/recuperar?token="
        . $this->token . "'>Restablecer contraseña</a> </p>";

        $contenido .= "<p> Si no fuiste tu ignora este correo";
        $contenido .= "<p><small>Gracias Por formar parte de <strong>Barbersop</stong></small></p>";
        $contenido .= "</html>";


        $mail->Body = $contenido;
        
        $mail->send();
    }
}

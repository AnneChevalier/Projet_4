<?php

require("./Web/PHPMailer-master/src/PHPMailer.php");
require("./Web/PHPMailer-master/src/SMTP.php");

use JFFram\Controller;
use JFFram\Session;
use JFFram\Str;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends Controller{
    
    /* Gestion de l'envoi du mail */
    public function contactForm() {

        $pseudo = Str::secured($_POST['pseudo']);
        $content = Str::secured($_POST['content']);
        $content = "Vous avez recu un message de " . $pseudo . "(" . $_POST['email'] . ") " . $content;
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; /* erreur et message */
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'linheb04.ikoula.com';
        $mail->Port = 465; /* ou 587 */
        $mail->IsHTML(true);
        $mail->Username = "contact@annechevalier.fr";
        $mail->Password = "Raja6010";
        $mail->SetFrom("contact@annechevalier.fr");
        $mail->Subject = "Envoi depuis la page Contact";
        $mail->Body = $content;
        $mail->AddAddress("contact@annechevalier.fr");
        
        if(!$mail->Send()){
            
            Session::getInstance()->setFlash('danger', "Echec de l'envoi.");
            
        } else {
            
            Session::getInstance()->setFlash('success', "Votre message a bien été envoyé.");
            
        }
        
        header('Location: ./index.php');
    }
}
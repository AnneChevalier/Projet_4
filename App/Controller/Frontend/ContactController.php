<?php

use JFFram\Controller;
use JFFram\Session;

class ContactController extends Controller{
	
	public function contactForm() {

        $pseudo = Str::secured($_POST['pseudo']);
        $content = Str::secured($_POST['content']);

		$email = 'Message de ' . $pseudo . '(' . $_POST['email'] . ')<br/>' . $content;

		$retour = mail('anne.chevalier@iso.fr', 'Envoi depuis la page Contact', $email);

    	if ($retour) {

    		Session::getInstance()->setFlash('success', "Votre message a bien été envoyé.");

    	} else {

    		Session::getInstance()->setFlash('danger', "Echec de l'envoi.");
    	}

    	header('Location: ./index.php');
	}
}
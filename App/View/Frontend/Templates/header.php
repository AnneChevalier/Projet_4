<?php

use JFFram\Session;

?>

<header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="logo">
                        <img class="navbar-brand d-none d-sm-block" src="./Web/images/logo_simple_jf_website.png" id="logo" alt="logo"/>
                </div>  
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="nav navbar-nav mr-auto">
                                <li class="nav-item"><a class="nav-link" href="./index.php">Accueil</a></li>
                                <li class="nav-item"><a class="nav-link" href="">Lecture</a></li>
                                <li class="nav-item"><a class="nav-link" href="">Auteur</a></li>
                        </ul>   
                </div>

                <i class="fas fa-user-circle navbar-right d-block d-sm-none"></i>

                <ul class="nav navbar-nav navbar-right">


                        <?php if(Session::getInstance()->read('auth')) { ?>

                                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./index.php?controller=account">Mon Compte</a></li>
                                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./index.php?controller=logout&action=logout">Se Déconnecter</a></li>

                        <?php } else {  ?>

                                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./index.php?controller=login">Se Connecter</a></li>
                                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./index.php?controller=register">S'inscrire</a></li>

                        <?php } ?>
                </ul>
        </nav>
</header>
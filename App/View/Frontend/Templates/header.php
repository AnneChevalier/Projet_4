<?php

use JFFram\Session;

?>

<header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                </button>

                <div class="logo">
                        <img class="navbar-brand" src="./Web/images/logo_simple_jf_website.png" id="logo" alt="logo"/>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent2" aria-controls="navbarContent2" aria-expanded="false">
                        <i class="fas fa-user-circle navbar-right"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="nav navbar-nav mr-auto menu">
                                <li class="nav-item"><a class="nav-link" href="./index.php">Accueil</a></li>
                                <li class="nav-item"><a class="nav-link" href="./index.php#lastBook">Lecture</a></li>
                                <li class="nav-item"><a class="nav-link" href="./index.php#author">Auteur</a></li>
                        </ul>   
                </div>
                
                
                
                <div class="collapse navbar-collapse navbar-right" id="navbarContent2">
                       <ul class="nav navbar-nav ml-auto">

                        <?php if(Session::getInstance()->read('auth')) { ?>

                                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./index.php?controller=account">Mon Compte</a></li>
                                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./index.php?controller=logout&action=logout">Se Déconnecter</a></li>

                        <?php } else {  ?>

                                <li class="nav-item d-sm-inline"><a class="nav-link" href="./index.php?controller=login">Se Connecter</a></li>
                                <li class="nav-item d-sm-inline"><a class="nav-link" href="./index.php?controller=register">S'inscrire</a></li>

                        <?php } ?>
                </ul> 
                </div>
                

        </nav>
</header>
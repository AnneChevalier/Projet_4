<?php

require_once './lib/JFFram/Autoloader.php';

use JFFram\Autoloader;

Autoloader::register();

use JFFram\Session;

?>

<!DOCTYPE html>
<html lang="fr">

	<head>

		<title>
      		<?= isset($title) ? $title : 'Jean Forteroche Website Administration' ?>
    	</title>

		<meta charset="utf-8"/>
		<!-- permet de s'assurer qu'IE utilise la dernière version du moteur de rendu -->
		<!-- cette ligne ne passe pas la validation W3C -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- concerne les mobiles : l'affichage doit occuper tout l'espace disponible sans zoom -->
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		
		<!-- favicon -->
		<link rel="shortcut icon" href="./Web/images/logo_simple_jf_website.png"/>
		<!-- Fontawesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="./Web/bootstrap_4.4.1/css/bootstrap.min.css"/>
		<!-- Mon CSS -->
		<link rel="stylesheet" href="./Web/css/style.css"/>

		<!-- permet aux navigateurs ne prenant pas en charge HTML5 et les Medias Queries CSS3 de la faire -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
    		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    		<script src="https://oss.maxcdn.com/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
		
	</head>

	<body>

		<?php 
        
        if (Session::getInstance()->read('auth')) {
        	
			if (Session::getInstance()->read('auth')->admin) {

				require 'header.php';
				?>

				<div class="container-fluid">
        			<div class="row main">

			        	<?php
			        	require 'aside.php';
			        	?>

			        	

						<div class="container col-md-10">

							<?php if (Session::getInstance()->hasFlashes()) {

                foreach (Session::getInstance()->getFlashes() as $type => $message) { ?>
                                                
                    <div class="alert alert-<?= $type; ?>">
                        <?= $message; ?>
                    </div>
                <?php }
            }?>

							<?= $content ?>

						</div>
					</div>
				</div>
			<?php
			require 'footer.php';

			} else { ?>

				<h3 class="text-center">Oups... Vous n'avez pas accès à cette partie du site...</h3>

			<?php }
        	
        } else {

        	require './App/View/Backend/login.php';
        }
        ?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./Web/bootstrap_4.4.1/js/bootstrap.min.js"></script>
	</body>

</html>
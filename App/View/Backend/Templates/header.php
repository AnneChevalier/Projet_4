<header>

	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menudashboard" aria-controls="menudashboard" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="logo">
            <img class="navbar-brand" src="./Web/images/logo_simple_jf_website.png" id="logo" alt="logo"/>
        </div>

        <div class="navbar-header dbtitle">
            <a href="./backindex.php?controller=dashboard" class="navbar-brand">Tableau de bord</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuadmin" aria-controls="menuadmin" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-user-circle navbar-right"></i>
        </button>

        <div class="collapse navbar-collapse navbar-right" id="menuadmin">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./backindex.php?controller=setting">Paramètres</a></li>
                <li class="nav-item d-none d-sm-inline"><a class="nav-link" href="./backindex.php?controller=logout&action=logout">Se Déconnecter</a></li>
            </ul>
        </div>
        
    </nav>
	
</header>
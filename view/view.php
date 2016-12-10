<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
        <link rel='stylesheet' type='text/css' href='style/main.css' />
    </head>
    <body>
        <header>
            <a class='menu-logo' href="index.php">
                <img class='menu-logo-img' src='res/logo.png' alt='logo'>
                <div class='menu-logo-content'>
                    Neo-nouveau développeurs
                </div>
            </a>
            <div class="menu-search">
                <form class="input-search" action="index.php" method="GET">
                    <input type="hidden" name="action" value="research">
                    <input type="hidden" name="controller" value="product">
                    <input class="input-field" type="text" name="search" placeholder="Recherche...">
                    <input class="input-item" type="submit" value="Envoyer">
                </form> 
            </div>
            <div class='menu-buttons'>
                <div class="menu-item basket">
                    <span><?php Session::get_nbItems()?></span>
                    <a href="index.php?controller=product&action=viewPanier">Panier</a>
                </div>
                <div class='menu-dropdown'>
                    <a href='index.php?controller=user&action=displaySelf'>Compte</a>
                    <?php
                    if (!Session::is_connected()) {
                        echo <<< EOT
                    <div class='menu-dropdown-content'>
                        <a href='index.php?action=connect&controller=user'>Se connecter</a>
                        <a href='index.php?action=register&controller=user'>S'inscrire</a>
                    </div>
EOT;
                    } else {
                        echo <<< EOT
                     <div class='menu-dropdown-content'>
                        <a href='index.php?action=update&controller=user'>Paramètres</a>
EOT;
                        if(Session::is_admin()){
                            echo "<a href='index.php?action=create&controller=product'>Ajouter un Produit</a>";
                        }
                        echo <<< EOT
                        <a href='index.php?action=disconnect&controller=user'>Se déconnecter</a>
                    </div>
EOT;
                    }
                    ?>
                </div>
            </div>
        </header>
        <main>
            <article>
                <?php
				if(isset($error)){
					echo $error;
				}
                $filepath = File::build_path(array('view', $controller, $view . ".php"));
                require $filepath;
                ?>
            </article>
        </main>
        <footer>
            <p> Team requêtes © <a href='index.php?action=about'>Notre équipe</a></p>
        </footer>
    </body>
</html>

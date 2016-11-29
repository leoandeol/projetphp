<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
        <link rel='stylesheet' type='text/css' href='style/main.css' />
    </head>
    <body>
        <header>
            <div class='menu-item'>
                <a href='index.php'>Accueil</a>
            </div>

            <div class="menu-item">
                <a href="index.php?controller=product&action=readAll">Liste article</a>
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
                        <a href='index.php?action=disconnect&controller=user'>Se déconnecter</a>
                    </div>
EOT;
                }
                ?>
            </div>

            <div class='menu-item'>
                <a href='index.php?action=about'>A propos</a>
            </div>
        </header>
        <main>
            <article>
                <?php
                $filepath = File::build_path(array('view', $controller, $view . ".php"));
                require $filepath;
                ?>
            </article>
        </main>
        <footer>
            <p> Team requêtes INC.</p>  
        </footer>
    </body>
</html>
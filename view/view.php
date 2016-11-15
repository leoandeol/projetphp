<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
        <link rel='stylesheet' type='text/css' href='style/main.css' />
    </head>
    <body>
        <header>
            <nav>
                <div class='menu-item'>
                    <a href='index.php?action=register&controller=user'>S'inscrire</a>
                </div>
                <div class='menu-item'>
                    <a href='index.php?action=connect&controller=user'>Se connecter</a>
                </div>
                <div class='menu-item'>
                    <a href='index.php?action=connect&controller=user'>Se connecter</a>
                </div>
                <div class='menu-item'>
                    <a href='index.php?action=connect&controller=user'>Se connecter</a>
                </div>
                <div class="menu-item">
                    <a href='index.php?action=readAll&controller=product'>Liste des produits</a>
                </div>
            </nav>
        </header>
        <main>
            <?php
            $filepath = File::build_path(array('view', $controller, $view . ".php"));
            require $filepath;
            ?>
        </main>
        <footer>
            <p> Team requêtes INC.</p>  
        </footer>
    </body>
</html>
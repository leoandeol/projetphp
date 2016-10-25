<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
    </head>
    <body>
    <?php
        $filepath = File::build_path(array('view',$controller,$view.".php"));
        require $filepath;
    ?>
    <footer>
        <p> Team requêtes INC.</p>  
    </footer>
    </body>
</html>
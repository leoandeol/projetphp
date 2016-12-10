<?php

/**
 * Description of ControllerProduct
 *
 * @author andeol
 */
class ControllerDefault {
    
    public static function welcome() {
        $view = 'welcome';
        $controller = 'default';
        $pagetitle = 'Accueil';
        require File::build_path(array('view', 'view.php'));
    }
    
    public static function about() {
        $view = 'about';
        $controller = 'default';
        $pagetitle = 'A propos';
        require File::build_path(array('view', 'view.php'));
    }

    public static function error($e) {
        $error = $e;
        $view = 'error';
        $controller = 'default';
        $pagetitle = 'Erreur';
        require File::build_path(array('view', 'view.php'));
    }

}

?>
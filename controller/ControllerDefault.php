<?php

/**
 * Description of ControllerProduct
 *
 * @author andeol
 */
class ControllerDefault {
    
    public function welcome() {
        $view = 'welcome';
        $controller = 'default';
        $pagetitle = 'Accueil';
        require File::build_path(array('view', 'view.php'));
    }
    
    public function about() {
        $view = 'about';
        $controller = 'default';
        $pagetitle = 'A propos';
        require File::build_path(array('view', 'view.php'));
    }

    public function error($e) {
        $error = $e;
        $view = 'error';
        $controller = 'default';
        $pagetitle = 'Erreur';
        require File::build_path(array('view', 'view.php'));
    }

}

?>
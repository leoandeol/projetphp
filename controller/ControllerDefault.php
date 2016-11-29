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

}

?>
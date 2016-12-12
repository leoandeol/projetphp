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

    public static function error($data) {
        $error = $data['error'];
        $view = $data['view'];
        $controller = $data['controller'];
        $pagetitle = 'Erreur';
        require File::build_path(array('view', 'view.php'));
    }

}

?>
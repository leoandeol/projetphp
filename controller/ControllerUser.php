<?php

require_once File::build_path(array('model','ModelUser.php'));

class ControllerUser{
    
    public function read(){        
        $id = $_POST['idUser'];
        $tab_user = ModelUser::getUserById($id);
        $view = 'displayUser';
        $controller = 'user';
        $pagetitle = 'Description';
        require File::build_path(array('view','view.php'));
    }
    
    public function readAll(){
        $tab_user = ModelUser::getAllUser();
        $view = 'displayUser';
        $controller = 'user';
        $pagetitle = 'Description';
        require File::build_path(array('view','view.php'));
    }
    
    public function error(){
        $view = 'error';
        $controller = 'user';
        $pagetitle = 'Error';
        require File::build_path(array('view','view.php'));
    }
}

?>


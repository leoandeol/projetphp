<?php

require_once File::build_path(array('model','Model.php'));

class ControllerUser{
    
    public function read(){        
        $id = $_POST['idUser'];
        $tab_user = ModelUser::getUserById($id);
        $view = 'displayUser.php';
        $controller = 'user';
        $pagetitle = 'Description';
        File::build_path(array('view','view.php'));
    }
    
    public function readAll(){
        $tab_user = ModelUser::getAllUser();
        $view = 'displayUser.php';
        $controller = 'user';
        $pagetitle = 'Description';
        File::build_path(array('view','view.php'));
    }
    
}

?>


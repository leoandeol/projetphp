<?php

require_once File::build_path(array('model','ModelUser.php'));

class ControllerUser{
    
    public function read(){        
        $id = $_GET['idUser'];
        $user = ModelUser::getUserById($id);
        $view = 'displayUser';
        $controller = 'user';
        $pagetitle = 'Description';
        require File::build_path(array('view','view.php'));
    }
    
    public function readAll(){
        $tab_user = ModelUser::getAllUser();
        $view = 'displayAllUser';
        $controller = 'user';
        $pagetitle = 'Description';
        require File::build_path(array('view','view.php'));
    }
    
    public function error(){
        $view = 'error';
        $controller = 'user';
        $pagetitle = 'Erreur';
        require File::build_path(array('view','view.php'));
    }
    
    public function create(){
        $view = 'register';
        $controller = 'user';
        $pagetitle = 'Création de compte';
        require File::build_path(array('view','view.php'));
    }
    
    public function created(){
        $user = new ModelUser(NULL, $_POST['nickname'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthdate'], 0);
        $user->save();
        $view = 'registered';
        $controller = 'user';
        $pagetitle = 'Compte créé';
        require File::build_path(array('view','view.php'));
    }
}

?>


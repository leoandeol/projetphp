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
    
    public function register(){
        $view = 'register';
        $controller = 'user';
        $pagetitle = 'Création de compte';
        require File::build_path(array('view','view.php'));
    }
    
    public function registered(){
        $hashpass = hash('sha512',$_POST['password'].ModelUser::getSeed());
        $user = new ModelUser(NULL, $_POST['nickname'], $hashpass, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthdate'], 0);
        $user->save();
        $view = 'registered';
        $controller = 'user';
        $pagetitle = 'Compte créé';
        require File::build_path(array('view','view.php'));
    }
    
    public function connect(){
        $view = 'connect';
        $controller = 'user';
        $pagetitle = 'Connexion';
        require File::build_path(array('view','view.php'));
    }
    
    public function connected(){
        // TODO cookies
        $hashpass = hash('sha512',$_POST['password'].ModelUser::getSeed());
        $user = new ModelUser();
        $user->connect($_POST['nickname'],hashpass);
        if($user==false){
            $view = 'error';
        } else {
            $view = 'connected';
        }
        $controller = 'user';
        $pagetitle = 'Connecté';
        require File::build_path(array('view','view.php'));
    }
}

?>


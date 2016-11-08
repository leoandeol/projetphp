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
<<<<<<< HEAD
        $hashpass = hash('sha512',$_POST['password'].ModelUser::getSeed());
=======
<<<<<<< HEAD
        $hashpass = hash('sha512',$_POST['password']);
        $user = new ModelUser(-1, $_POST['nickname'], $hashpass, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthdate'], 0);
=======
        $hashpass = hash('sha512',$_POST['password']+ModelUser::getSeed());
>>>>>>> a65e37c0a08b8677c6d81ecd531354c08739b0bf
        $user = new ModelUser(NULL, $_POST['nickname'], $hashpass, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthdate'], 0);
>>>>>>> 3f773996decf7d7e9a36b96317cafc8ede2479ce
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


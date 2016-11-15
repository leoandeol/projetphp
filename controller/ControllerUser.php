<?php

require_once File::build_path(array('model', 'ModelUser.php'));
require_once FIle::build_path(array('lib', 'Security.php'));

class ControllerUser {

    public function read() {
        $id = $_GET['idUser'];
        $user = ModelUser::getUserById($id);
        $view = 'displayUser';
        $controller = 'user';
        $pagetitle = 'Description';
        require File::build_path(array('view', 'view.php'));
    }

    public function readAll() {
        $tab_user = ModelUser::getAllUser();
        $view = 'displayAllUser';
        $controller = 'user';
        $pagetitle = 'Description';
        require File::build_path(array('view', 'view.php'));
    }

    public function error() {
        $view = 'error';
        $controller = 'user';
        $pagetitle = 'Erreur';
        require File::build_path(array('view', 'view.php'));
    }

    public function register() {
        $view = 'register';
        $controller = 'user';
        $pagetitle = 'Création de compte';
        require File::build_path(array('view', 'view.php'));
    }

    public function registered() {
        //TODO comparer les 2 mots de passes + verifier si utilisateur existe deja
        $hashpass = Security::encrypt($_POST['password']);
        $user = new ModelUser(-1, $_POST['nickname'], $hashpass, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthdate'], 0);
        $user->save();
        $view = 'registered';
        $controller = 'user';
        $pagetitle = 'Compte créé';
        require File::build_path(array('view', 'view.php'));
    }

    public function connect() {
        $view = 'connect';
        $controller = 'user';
        $pagetitle = 'Connexion';
        require File::build_path(array('view', 'view.php'));
    }

    public function connected() {
        // TODO cookies
        $hashpass = Security::encrypt($_POST['password']);
        $user = new ModelUser();
        $user->connect($_POST['nickname'], $hashpass);
        if ($user == false) {
            $view = 'error';
        } else {
            $view = 'connected';
        }
        $controller = 'user';
        $pagetitle = 'Connecté';
        require File::build_path(array('view','view.php'));
    } 

    public function deconnect() {
        session_destroy();
        $user = null;
        $pagetitle = 'Accueil';
        $view = 'displayAllUser';
        $controller = 'user';
        require File::build_path(array('view', 'view.php'));
    }

    public function update() {
        $view = 'update';
        $controller = 'user';
        $pagetitle = 'Update';
        require File::build_path(array('view','view.php'));        
    }
    
    public function updated() {
        $data = array (
            'lastName' => $_POST['lastName'],
            'firstName'=> $_POST['firstName'],
            'nickName' => $_POST['nickName'],
            'password' => $_POST['newPassword'],
            'oldPass'  => $_POST['oldPassword'],
            'mail'     => $_POST['mail'],
            'birthDate'=> $_POST['birthDate']            
        );
        
    }
    
}
?>


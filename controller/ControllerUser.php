<?php

require_once File::build_path(array('model', 'ModelUser.php'));
require_once FIle::build_path(array('lib', 'Security.php'));
require_once FIle::build_path(array('lib', 'Session.php'));

class ControllerUser {

    if(Session::is_admin() && Session::is_connected()){
    private $checkBoxAdmin = '<p>
                                 <label for="isAd">isAdmin</label>
                                 <input type="checkbox" name="isAdmin" for="isAd"/>
                              </p>';
    
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
        // TODO cookies And view connected
        $hashpass = Security::encrypt($_POST['password']);
        $user = new ModelUser();
        $user->connect($_POST['nickname'], $hashpass);
        if ($user == false) {
            $this->error();
        } else {
            $view = 'connected';
            $_SESSION['login'] = $_POST['nickname'];
            $_SESSION['admin'] = Session::is_admin();
        }
        $controller = 'user';
        $pagetitle = 'Connecté';
        require File::build_path(array('view', 'view.php'));
    }

    public function disconnect() {
        session_destroy();
        $user = null;
        $pagetitle = 'Accueil';
        $view = 'displayAllUser';
        $controller = 'user';
        require File::build_path(array('view', 'view.php'));
    }

    public function update() {
        if (Session::is_connected()) {
            $view = 'update';
            $pagetitle = 'Update';

            $controller = 'user';
            require File::build_path(array('view', 'view.php'));
        } else {
            $this->error();
        }
    }

    public function updated() {
        if (Session::is_connected()) {
            if (!isset($_POST['isAdmin'])) {
                $_POST['isAdmin'] = 'false';
            } else {
                $_POST['isAdmin'] = 'true';
            }
            $data = array(
                'lastName' => $_POST['lastName'],
                'firstName' => $_POST['firstName'],
                'nickName' => $_POST['nickName'],
                'password' => $_POST['newPassword'],
                'oldPass' => $_POST['oldPassword'],
                'confPass' => $_POST['confPassword'],
                'mail' => $_POST['mail'],
                'birthDate' => $_POST['birthDate'],
                'isAdmin' => $_POST['isAdmin']
            );
        } else {
            $this->error();
        }
    }

}
?>


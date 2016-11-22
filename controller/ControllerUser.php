<?php

require_once File::build_path(array('model', 'ModelUser.php'));

class ControllerUser {

    private $checkBoxAdmin;

    public function setCheckBox() {
        if (Session::is_admin() && Session::is_connected()) {
            $checkBoxAdmin = '<p>
                         <label for="isAd">isAdmin</label>
                         <input type="checkbox" name="isAdmin" for="isAd"/>
                         </p>';
        } else {
            $checkBox = '';
        }
    }

    public function read() {
        if(Session::is_admin() && Session::is_connected()){
            $id = $_GET['nickName'];
            $user = ModelUser::getUserById($id);
            $view = 'displayUser';
            $controller = 'user';
            $pagetitle = 'Description';
            require File::build_path(array('view', 'view.php'));
        }else{
            ControllerUser::error();
        }
    }

    public function readAll() {
        if(Session::is_admin() && Session::is_connected()){
            $tab_user = ModelUser::getAllUser();
            $view = 'displayAllUser';
            $controller = 'user';
            $pagetitle = 'Description';
            require File::build_path(array('view', 'view.php'));
        }else{
            ControllerUser::error();
        }
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
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//do smthing if bad mail
        }
        $hashpass = Security::encrypt($_POST['password']);
        $nonce = Security::generateRandomHex();
        $user = new ModelUser($_POST['nickname'], $hashpass, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['birthdate'], 0, $nonce);
        $user->save();
        
        //MAIL
        $mail="<!DOCTYPE html><body><a href=\"http://infolimon.iutmontp.univ-montp2.fr/~andeoll/projetphp/index.php?action=validate&controller=user&login=".$_POST['nickname']."&nonce=$nonce\">pls click link</a></body>";
        mail($_POST['email'], "Please confirm your email", $mail);
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
            ControllerUser::error();
        } else {
            $view = 'connected';
            $_SESSION['login'] = $_POST['nickname'];
            $_SESSION['admin'] = Session::is_admin();
            Session::connect();
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
            ControllerUser::error();
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
            ControllerUser::error();
        }
    }

    function validate() {
        $login = $_GET['login'];
        $nonce = $_GET['nonce'];
    }
}
?>

    

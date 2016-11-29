<?php

require_once File::build_path(array('model', 'ModelUser.php'));

class ControllerUser {

    public function setCheckBox() {
        if (Session::is_admin() && Session::is_connected()) {
            return '<p>
                    <label for="isAd">isAdmin</label>
                    <input type="checkbox" name="isAdmin" for="isAd"/>
                    </p>';
        } else {
            return '';
        }
    }

    public function read() {
        if (Session::is_admin()) {
            $id = $_GET['nickName'];
            $user = ModelUser::select($id);
            $view = 'displayUser';
            $controller = 'user';
            $pagetitle = 'Description';
            require File::build_path(array('view', 'view.php'));
        } else {
            ControllerDefault::error("Vous n'avez pas la permission pour accéder à ce contenu.");
        }
    }

    public function readAll() {
        if (Session::is_admin() && Session::is_connected()) {
            $tab_user = ModelUser::selectAll();
            $view = 'displayAllUser';
            $controller = 'user';
            $pagetitle = 'Description';
            require File::build_path(array('view', 'view.php'));
        } else {
            ControllerDefault::error("Vous n'avez pas la permission pour accéder à ce contenu.");
        }
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
        $data = array('nickName' => $_POST['nickname'],
                      'password' => $hashpass, 
                      'firstName'=> $_POST['firstname'],
                      'lastName' => $_POST['lastname'],
                      'mail'     => $_POST['email'], 
                      'birthDate'=> $_POST['birthdate'],
                      'isAdmin'  => 0,
                      'nonce'    => $nonce
                );
        $user->save($data);

        //MAIL
        $mail = "<!DOCTYPE html><body><a href=\"http://infolimon.iutmontp.univ-montp2.fr/~andeoll/projetphp/index.php?action=validate&controller=user&login=" . $_POST['nickname'] . "&nonce=$nonce\">pls click link</a></body>";
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
        $user = ModelUser::connect($_POST['nickname'], $hashpass);
        if ($user != NULL) {
            $view = 'connected';
            $controller = 'user';
            $pagetitle = 'Connecté';
            $_SESSION['login'] = $user->getNickName();
            if ($user->getIsAdmin() == 1) {
                $_SESSION['admin'] = 1;
            } else {
                $_SESSION['admin'] = 0;
            }
            $name = $user->getFirstName();
            Session::connect();
            require File::build_path(array('view', 'view.php'));
        } else {
            ControllerDefault::error("FATAL ERROR");
        }
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
            $checkBoxAdmin = ControllerUser::setCheckBox();
            $view = 'update';
            $pagetitle = 'Update';
            $controller = 'user';
            require File::build_path(array('view', 'view.php'));
        } else {
            ControllerDefault::error("Veuillez vous connecter.");
        }
    }

    public function updated() {
        if (Session::is_connected()) {
            if (!isset($_POST['isAdmin'])) {
                $_POST['isAdmin'] = 0;
            } else {
                $_POST['isAdmin'] = 1;
            }
            $dataNotOk = array(
                'lastName' => $_POST['lastName'],
                'firstName' => $_POST['firstName'],
                'password' => $_POST['newPassword'],
                'oldPass' => $_POST['oldPassword'],
                'confPass' => $_POST['confPassword'],
                'mail' => $_POST['mail'],
                'birthDate' => $_POST['birthDate'],
                'isAdmin' => $_POST['isAdmin']
            );
            $hashpass = Security::encrypt($dataNotOk['oldPass']);
            if (ModelUser::checkPassword($_SESSION['login'], $hashpass)) {
                if ($dataNotOk['password'] == $dataNotOk['confPass']) {
                    $hashpassOk = Security::encrypt($dataNotOk['password']);
                    $dataOk = array(
                        'lastName' => $_POST['lastName'],
                        'firstName' => $_POST['firstName'], 
                        'password' => $hashpassOk,
                        'mail' => $_POST['mail'],
                        'birthDate' => $_POST['birthDate'],
                        'isAdmin' => $_POST['isAdmin'],
                        'nickName' => $_SESSION['login']
                    );
                    $res = ModelUser::update($dataOk);
                    var_dump($dataOk);
                    if ($res == TRUE) {
                        $view = 'updated';
                        $pagetitle = 'Updated';
                        $controller = 'user';
                        require File::build_path(array('view', 'view.php'));
                    } else {
                        ControllerDefault::error("FATAL ERROR");
                    }
                } else {
                    ControllerDefault::error("Les nouveaux mots de passe ne coïncident pas");
                }
            } else {
                ControllerDefault::error("Mot de passe actuel invalide");
            }
        } else {
            ControllerDefault::error("Veuillez vous connecter.");
        }
    }

    function validate() {
        $login = $_GET['login'];
        $nonce = $_GET['nonce'];
    }

}
?>



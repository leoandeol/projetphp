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

    public function displaySelf() {
        if (Session::is_connected()) {
            $id = $_SESSION['login'];
            $user = ModelUser::select($id);
            $view = 'displaySelf';
            $controller = 'user';
            $pagetitle = 'Compte';
            require File::build_path(array('view', 'view.php'));
        } else {
            ControllerUser::connect();
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
            ControllerDefault::error("Problème avec le mail.");
        }
        $hashpass = Security::encrypt($_POST['password']);
        $nonce = Security::generateRandomHex();
        $bDate = $_POST['birthdate'];
        $format = "d/m/Y";
        $date_parsed = date_parse_from_format($format, $bDate);
        $goodFormatDate = $date_parsed["year"]."/".$date_parsed["month"]."/".$date_parsed["day"];
        $data = array('nickName' => $_POST['nickname'],
                      'nonce'    => $nonce,
                      'lastName' => $_POST['lastname'],
                      'firstName'=> $_POST['firstname'],
                      'password' => $hashpass,
                      'mail'     => $_POST['email'],
                      'birthDate'=> $goodFormatDate,
                      'isAdmin'  => 0,
                );
        
        // REGISTERING INFO INTO $_SESSION AND CONNECTING
        Session::connect($data['firstName'], $data['lastName'], $data['birthDate'], $data['mail']);
        
        if(ModelUser::save($data)){
            $nickNameSecure = rawurlencode($_POST['nickname']);
            $mail = "<!DOCTYPE html><body><a href=http://infolimon.iutmontp.univ-montp2.fr/~andeoll/projetphp/index.php?action=validate&controller=user&login={$nickNameSecure}&nonce=$nonce>pls click link to finalise your registeration.</a></body>";
            mail($_POST['email'], "Please confirm your email", $mail);
            $view = 'registered';
            $controller = 'user';
            $pagetitle = 'Compte créé';
            require File::build_path(array('view', 'view.php'));
        }else{
            ControllerDefault::error("FATAL ERROR");
        }
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
        if ($user !=-1 && $user != -2 && $user != -3) {
            $view = 'connected';
            $controller = 'user';
            $pagetitle = 'Connecté';
            Session::setLogin($user->getNickName());
            if ($user->getIsAdmin() == 1) {
                $_SESSION['admin'] = 1;
            } else {
                $_SESSION['admin'] = 0;
            }
            $name = $user->getFirstName();
            $lname = $user->getLastName();
            $birthDate = $user->getBirthDate();
            $format = "Y/m/d";
            $date_parsed = date_parse_from_format($format, $birthDate);
            $goodFormatDate = $date_parsed["day"]."/".$date_parsed["month"]."/".$date_parsed["year"];
            $mail = $user->getMail();
            Session::connect($name,$lname,$goodFormatDate,$mail);
            if(isset($orderCommand) && $orderCommand){
                ControllerProduct::orderCommand();
            }else
                require File::build_path(array('view', 'view.php'));
        } else {
            if($user == -1){
                ControllerDefault::error("FATAL ERROR");
            }else if ($user == -2){
                ControllerDefault::error("FATAL ERROR");
            }else if ($user == -3){
                ControllerDefault::error("Veuillez confirmer votre mail");
            }
        }
    }

    public function disconnect() {
        session_unset();
        session_destroy();
        $user = null;
        $pagetitle = 'Accueil';
        $view = 'welcome';
        $controller = 'default';
        require File::build_path(array('view', 'view.php'));
    }

    public function update() {
        if (Session::is_connected()) {
            $checkBoxAdmin = ControllerUser::setCheckBox();
            $view = 'update';
            $pagetitle = 'Update';
            $controller = 'user';
            $nName = htmlspecialchars($_SESSION['login']);
            $fName = htmlspecialchars($_SESSION['firstName']);
            $lName = htmlspecialchars($_SESSION['lastName']);
            $mail  = htmlspecialchars($_SESSION['mail']);
            $bDate = htmlspecialchars($_SESSION['birthDate']);
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
                'newPassword' => $_POST['newPassword'],
                'confPass' => $_POST['confPassword'],
                'mail' => $_POST['mail'],
                'birthDate' => $_POST['birthDate'],
                'isAdmin' => $_POST['isAdmin'],
                'oldPass' => $_POST['oldPassword']
            );
            
            if($_POST['lastName']==NULL){
                if($_POST['firstName']==NULL){
                    if($_POST['newPassword']==NULL){
                        if($_POST['confPassword']==NULL){
                            if($_POST['mail']==NULL){
                                if($_POST['birthDate']==NULL){
                                    array_splice($dataNotOk,0,6);
                                }else{
                                    array_splice($dataNotOk,0,5);
                                }
                            }else{
                                if($_POST['birthDate']==NULL){
                                    array_splice($dataNotOk,0,4);
                                    array_splice($dataNotOk,1);
                                }else{
                                    array_splice($dataNotOk,0,4);
                                }
                            }
                        }else{
                            ControllerDefault::error("Veuillez d'abord entrer un nouveau mot de passe");
                        }
                    }else{
                        if($_POST['confPassword']==NULL){
                            ControllerDefault::error("Veuillez confirmer le mot nouveau mot de passe");
                        }else{
                            if($_POST['mail']==NULL){
                                if($_POST['birthDate']==NULL){
                                    array_splice($dataNotOk,0,2);
                                    array_splice($dataNotOk,2,2);
                                }else{
                                    array_splice($dataNotOk,0,2);
                                    array_splice($dataNotOk,2);
                                }
                            }else{
                                if($_POST['birthDate']==NULL){
                                    array_splice($dataNotOk,0,2);
                                    array_splice($dataNotOk,3);
                                }else{
                                    array_splice($dataNotOk,0,2);
                                }
                            }
                        }
                    }
                }
            }
                    
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

    public function validate() {
        $login = $_GET['login'];
        $nonce = $_GET['nonce'];
        if($user != false){
            if($user->getNonce() == $nonce){
                $data = array();
                $data['nonce']=NULL;
                ModelUser::update($data);
                var_dump($data);
                $view = 'validated';
                $controller = 'user';
                $pagetitle = 'Bienvenue';
                File::build_path(array('view','view.php'));
            }else{
                ControllerDefault::error("Problème de confirmation.");
            }
        }else{
            ControllerDefault::error("FATAL ERROR.");
        }
    }

}
?>



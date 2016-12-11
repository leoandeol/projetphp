<?php

require_once File::build_path(array('model', 'ModelUser.php'));

class ControllerUser {

    public static function setCheckBox() {
        if (Session::is_admin() && Session::is_connected()) {
            return '<p>
                    <label class="input-item" for="isAd">isAdmin</label>
                    <input class="input-field" type="checkbox" name="isAdmin" for="isAd"/>
                    </p>';
        } else {
            return '';
        }
    }
    public static function displaySelf() {
        if (Session::is_connected()) {
            $id = $_SESSION['nickName'];
            $user = ModelUser::select($id);
            $view = 'displaySelf';
            $controller = 'user';
            $pagetitle = 'Compte';
            require File::build_path(array('view', 'view.php'));
        } else {
            ControllerUser::connect();
        }
    }

    public static function read() {
        if (Session::is_admin()) {
            $id = $_GET['nickName'];
            $user = ModelUser::select($id);
            $view = 'displayUser';
            $controller = 'user';
            $pagetitle = 'Description';
            require File::build_path(array('view', 'view.php'));
        } else {
			$data = array();
			$data['error'] = "Vous n'avez pas la permission pour accéder à ce contenu";
			$data['view'] = 'error';
			$data['controller'] = 'default';
            ControllerDefault::error($data);
        }
    }

    public static function readAll() {
        if (Session::is_admin() && Session::is_connected()) {
            $tab_user = ModelUser::selectAll();
            $view = 'displayAllUser';
            $controller = 'user';
            $pagetitle = 'Description';
            require File::build_path(array('view', 'view.php'));
        } else {
			$data = array();
            $data['error'] = "Vous n'avez pas la permission pour accéder à ce contenu";
			$data['view'] = 'error';
			$data['controller'] = 'default';
            ControllerDefault::error($data);
        }
    }

    public static function register() {
        $view = 'register';
        $controller = 'user';
        $pagetitle = 'Création de compte';
        require File::build_path(array('view', 'view.php'));
    }

    public static function registered() {
//TODO comparer les 2 mots de passes + verifier si utilisateur existe deja
		$dataErr = array();
		$dataErr['nName'] = $_POST['nickname'];
		$dataErr['lName'] = $_POST['lastname'];
		$dataErr['fName'] = $_POST['firstname'];
		$dataErr['mail'] = $_POST['email'];
		$dataErr['bDate'] = $_POST['birthdate'];
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$dataErr['error'] = "Email invalide";
			$dataErr['view'] = 'register';
			$dataErr['controller'] = 'user';
            ControllerDefault::error($dataErr);
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
                      'isAdmin'  => 0
                );
        
        if(ModelUser::save($data)){
			// REGISTERING INFO INTO $_SESSION
			$_SESSION['nickName'] = $data['nickName'];
			$_SESSION['lastName'] = $data['lastName'];
			$_SESSION['firstName']= $data['firstName'];
			$_SESSION['mail']     = $data['mail'];
			$_SESSION['birthDate']= $data['birthDate'];

			// REGISTERING INFO INTO $_SESSION AND CONNECTING
			Session::connect($data['nickName'],$data['firstName'], $data['lastName'], $data['birthDate'], $data['mail']);
			
            $nickNameSecure = rawurlencode($_POST['nickname']);
                $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
            $mail = "<!DOCTYPE html><body><a href={$actual_link}?action=validate&controller=user&nickName={$nickNameSecure}&nonce=$nonce>pls click link to active just do it</a></body>";
            mail($_POST['email'], "Please confirm your email", $mail);
            $view = 'registered';
            $controller = 'user';
            $pagetitle = 'Compte créé';
            require File::build_path(array('view', 'view.php'));
        }else{
			$dataErr['error'] = "Problème de création de compte";
			$dataErr['view'] = 'register';
			$dataErr['controller'] = 'user';
            ControllerDefault::error($dataErr);			
        }
    }

    public static function connect() {
        $view = 'connect';
        $controller = 'user';
        $pagetitle = 'Connexion';
        require File::build_path(array('view', 'view.php'));
    }

    public static function connected() {
        $hashpass = Security::encrypt($_POST['password']);
        $user = ModelUser::connect($_POST['nickname'], $hashpass);
        if ($user != NULL) {
            $view = 'connected';
            $controller = 'user';
            $pagetitle = 'Connecté';
            if ($user->getIsAdmin() == 1) {
                $_SESSION['admin'] = 1;
            } else {
                $_SESSION['admin'] = 0;
            }
            $nickName = $user->getNickName();
            $name = $user->getFirstName();
            $lname = $user->getLastName();
            $birthDate = $user->getBirthDate();
            $format = "Y/m/d";
            $date_parsed = date_parse_from_format($format, $birthDate);
            $goodFormatDate = $date_parsed["day"]."/".$date_parsed["month"]."/".$date_parsed["year"];
            $mail = $user->getMail();
            Session::connect($nickName,$name,$lname,$goodFormatDate,$mail);
            if(isset($_SESSION['orderCommand']) && $_SESSION['orderCommand']){
                unset($_SESSION['orderCommand']);
                ControllerOrder::create();
            }else
                require File::build_path(array('view', 'view.php'));
        } else {
			$data = array();
			$data['error'] = "Problème de connexion";
			$data['view'] = 'connect';
			$data['controller'] = 'user';
			$data['login'] = $_POST['nickname'];
            ControllerDefault::error($data);	
        }
    }

    public static function disconnect() {
        session_unset();
        session_destroy();
        $user = null;
        $pagetitle = 'Accueil';
        $view = 'welcome';
        $controller = 'default';
        require File::build_path(array('view', 'view.php'));
    }

    public static function update() {
        if (Session::is_connected()) {
            $checkBoxAdmin = ControllerUser::setCheckBox();
            $view = 'update';
            $pagetitle = 'Update';
            $controller = 'user';
            $nName = htmlspecialchars($_SESSION['nickName']);
            $fName = htmlspecialchars($_SESSION['firstName']);
            $lName = htmlspecialchars($_SESSION['lastName']);
            $mail  = htmlspecialchars($_SESSION['mail']);
            $bDate = htmlspecialchars($_SESSION['birthDate']);
            require File::build_path(array('view', 'view.php'));
        } else {
			$data = array();
			$data['error'] = "Veuillez vous connecter";
			$data['view'] = 'connect';
			$data['controller'] = 'user';
            ControllerDefault::error($data);
        }
    }

    public static function updated() {
		$dataError = array();
		$dataError['nName'] = htmlspecialchars($_SESSION['nickName']);
		$dataError['fName'] = htmlspecialchars($_SESSION['firstName']);
		$dataError['lName']= htmlspecialchars($_SESSION['lastName']);
		$dataError['mail']  = htmlspecialchars($_SESSION['mail']);
		$dataError['bDate'] = htmlspecialchars($_SESSION['birthDate']);		
		$dataError['checkBoxAdmin'] = ControllerUser::setCheckBox();
		
        if (Session::is_connected()) {
            if (!isset($_POST['isAdmin'])) {
                $_POST['isAdmin'] = 0;
            } else {
                $_POST['isAdmin'] = 1;
            }
            $dataNotOk = array(
                'lastName' => $_POST['lastname'],
                'firstName' => $_POST['firstname'],
                'newPassword' => $_POST['password'],
                'confPass' => $_POST['password2'],
                'mail' => $_POST['email'],
                'birthDate' => $_POST['birthdate'],
                'isAdmin' => $_POST['isAdmin'],
                'oldPass' => $_POST['old_password']
            );
                    
            $hashpass = Security::encrypt($dataNotOk['oldPass']);
            if (ModelUser::checkPassword($_SESSION['nickName'], $hashpass)) {
                if ($dataNotOk['newPassword'] == $dataNotOk['confPass']) {
                    $hashpassOk = Security::encrypt($dataNotOk['newPassword']);
                    $dataOk = array(
                        'lastName' => $_POST['lastname'],
                        'firstName' => $_POST['firstname'],
                        'password' => $hashpassOk,
                        'mail' => $_POST['email'],
                        'birthDate' => $_POST['birthdate'],
                        'isAdmin' => $_POST['isAdmin'],
                        'nickName' => $_SESSION['nickName']
                    );
                    $res = ModelUser::update($dataOk);
                    if ($res == TRUE) {
                        $view = 'updated';
                        $pagetitle = 'Updated';
                        $controller = 'user';
                        require File::build_path(array('view', 'view.php'));
                    } else {						
						$dataError['error'] = "Problème de mofications des données";
						$dataError['view'] = 'update';
						$dataError['controller'] = 'user';
						ControllerDefault::error($dataError);
                    }
                } else {					
					$dataError['error'] = "Les nouveaux mots de passes ne coïncident pas";
					$dataError['view'] = 'update';
					$dataError['controller'] = 'user';
					ControllerDefault::error($dataError);
                }
            } else {
				$dataError['error'] = "Mot de passe actuel invalide";
				$dataError['view'] = 'update';
				$dataError['controller'] = 'user';
				ControllerDefault::error($dataError);
            }
        } else {
            $dataError['error'] = "Veuillez vous connecter";
			$dataError['view'] = 'connect';
			$dataError['controller'] = 'user';
			ControllerDefault::error($dataError);
        }
    }

    public static function validate() {
        $login = $_GET['nickName'];
        $nonce = $_GET['nonce'];
        $user = ModelUser::select($login);
        if($user != false){
            if($user->getNonce() == $nonce){
                $data = array();
                $data['nonce']="";
                $data['nickName']=$login;
                ModelUser::update($data);
                $view = 'validated';
                $controller = 'user';
                $pagetitle = 'Bienvenue';
                require_once(File::build_path(array('view','view.php')));
            }else{
				$data = array();
				$data['error'] = "Problème de confirmation du mail";
				$data['view'] = 'error';
				$data['controller'] = 'default';
				ControllerDefault::error($data);
            }
        }else{
			$data = array();
			$data['error'] = "FATAL ERROR";
			$data['view'] = 'error';
			$data['controller'] = 'default';
			ControllerDefault::error($data);
        }
    }

}
?>
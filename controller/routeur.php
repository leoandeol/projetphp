<?php

require_once File::build_path(array('controller','ControllerUser.php'));
require_once File::build_path(array('controller','ControllerProduct.php'));
require_once File::build_path(array('controller','ControllerDefault.php'));
require_once File::build_path(array('controller','ControllerOrder.php'));

require_once FIle::build_path(array('lib', 'Security.php'));
require_once FIle::build_path(array('lib', 'Session.php'));
require_once FIle::build_path(array('lib', 'Panier.php'));

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else if(isset($_POST['action'])){
    $action = $_POST['action'];
} else {
    $action = 'welcome';
}
if(isset($_GET['controller'])){
    $controller = $_GET['controller'];
} else if(isset($_POST['controller'])){
    $controller = $_POST['controller'];
} else{
    $controller = 'default';
}

$controllerClass = 'Controller' . ucfirst($controller);
if(!(class_exists($controllerClass))){
	$data = array();
	$data['error'] = "Le controller indiqué n'existe pas";
	$data['view'] = 'error';
	$data['controller'] = 'default';
    ControllerDefault::error($data);
    
}else{
    
    if(!(in_array($action,  get_class_methods($controllerClass)))){
        
       $data = array();
		$data['error'] = "L'action indiquée n'existe pas";
		$data['view'] = 'error';
		$data['controller'] = 'default';
		ControllerDefault::error($data);
        

    }else{
        $controllerClass::$action();
    }    
}
?>


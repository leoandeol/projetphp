<?php

require_once File::build_path(array('controller','ControllerUser.php'));
require_once File::build_path(array('controller','ControllerProduct.php'));
require_once FIle::build_path(array('lib', 'Security.php'));
require_once FIle::build_path(array('lib', 'Session.php'));

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else if(isset($_POST['action'])){
    $action = $_POST['action'];
} else {
    $action = 'readAll';
}
if(isset($_GET['controller'])){
    $controller = $_GET['controller'];
} else if(isset($_POST['controller'])){
    $controller = $_POST['controller'];
} else{
    $controller = 'user';
}

$controllerClass = 'Controller' . ucfirst($controller);


if(!(class_exists($controllerClass))){
    ControllerUser::error();
}else{
    if(!(in_array($action,  get_class_methods($controllerClass)))){
        ControllerUser::error();
    }else{
        $controllerClass::$action();
    }    
}
?>


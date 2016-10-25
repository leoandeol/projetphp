<?php

require_once File::build_path(array('controller','ControllerUser.php'));
require_once File::build_path(array('controller','ControllerProduct.php'));

if(!isset($_GET['action'])){
    $action = 'readAll';
}else{
    $action = $_GET['action'];
}
if(!isset($_GET['controller'])){
    $controller = 'user';
}else{
    $controller = $_GET['controller'];
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


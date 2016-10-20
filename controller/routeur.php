<?php

if(!isset($_GET['action'])){
    $action = 'readAllUser';
}else{
    $action = $_GET['action'];
}
if(!isset($_GET['controller'])){
    $controller = 'Utilisateur';
}else{
    $controller = $_GET['controller'];
}

$controllerClass = 'Controller' . ucfirst($controller);

if(!(class_exists($controllerClass))){
    ControllerUser::error(); // error() to do
}else{
    if(!(in_array($action,  get_class_methods($controllerClass)))){
        ControllerUser::error();
    }else{
        $controllerClass::$action;
    }    
}
?>


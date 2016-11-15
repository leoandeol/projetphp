<?php

class Session{
    
    public static function is_user($login){
        return (!empty($_SESSION['login'] && $_SESSION['login']==$login));
    }
    
    public static function is_admin() {
        return (!empty($_SESSION['admin']) && $_SESSION['admin']);
    }
    
    public static function connect() {
        $_SESSION['connected'] = true;
    }
    
    public static function is_connected() {
        return (!empty($_SESSION['connected']) && $_SESSION['connected']);
    }
    
}
<?php

class Session{
    
    public static function is_user($login){
        return (!empty($_SESSION['login'] && $_SESSION['login']==$login));
    }
    
    public static function is_admin() {
        return (!empty($_SESSION['admin']) && $_SESSION['admin']==1);
    }
    
    public static function setLogin($login){
        $_SESSION['login'] = $login;
    }
    
<<<<<<< HEAD
    public static function connect($nickName,$firstName,$lastName,$birthDate,$mail) {
        $_SESSION['connected'] = true;
        $_SESSION['nickName'] = $nickName;
=======
    public static function connect($nickname, $firstName,$lastName,$birthDate,$mail) {
        $_SESSION['connected'] = true;
        $_SESSION['nickName'] = $nickname;
>>>>>>> be3c135733c94e4f45332d000c02b88831af9fdf
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName']  = $lastName;
        $_SESSION['birthDate'] = $birthDate;
        $_SESSION['mail']      = $mail;
    }
    
    public static function is_connected() {
        return (!empty($_SESSION['connected']) && $_SESSION['connected']);
    }
    public static function get_nbItems(){
        return Panier::countArticles();
    }
    
}
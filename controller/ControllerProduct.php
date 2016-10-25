<?php

require_once File::build_path(array('model','ModelUser.php'));
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerProduct
 *
 * @author govinc
 */
class ControllerProduct {
    
    public function read(){
        $id = $_GET['id'];
        $p = ModelProduct::getProductByName(1);
        $view = 'displayProduct';
        $controller = 'product';
        $pagetitle = 'Description produit ' . $_GET['id'];
        require File::build_path(array('view', 'view.php'));
    }
    
    public function create(){
        $view = 'createProduct';
        $controller = 'product';
        $pagetitle = 'Création de produit';      
        require File::build_path(array('view', 'view.php'));
    }
    
}
?>
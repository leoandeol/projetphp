<?php

require_once File::build_path(array('model','ModelProduct.php'));
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
        $name = $_GET['name'];
        $p = ModelProduct::getProductByName($name);
        $view = 'displayProduct';
        $controller = 'product';
        $pagetitle = 'Description produit ' . $name;
        require File::build_path(array('view', 'view.php'));
    }
        public function readAll(){
        $tab_p = ModelProduct::getAllProduct();
        $view = 'displayAllProduct';
        $controller = 'product';
        $pagetitle = 'Description des produits';
        require File::build_path(array('view','view.php'));
    }
  
    public function create(){
        $view = 'createProduct';
        $controller = 'product';
        $pagetitle = 'Création de produit';
       
        require File::build_path(array('view', 'view.php'));
    }
    
    public function created(){
        
        $pId = $_POST['idP'];
        $pName = $_POST['name'];
        $pPrice = $_POST['price'];
       
            
        $p = new ModelProduct($pId, $pName, $pPrice);
        
        var_dump($p);
        $p->save();
        
        $view = 'createdProduct';
        $controller = 'product';
        $pagetitle = 'Produit créé';
       
        require File::build_path(array('view', 'view.php'));
    }
}
?>
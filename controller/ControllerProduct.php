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
        $label = $_GET['label'];
        $p = ModelProduct::getProductByLabel($label);
        $view = 'displayProduct';
        $controller = 'product';
        $pagetitle = 'Description produit ' . $label;
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
        $pLabel = $_POST['label'];
        $pPrice = $_POST['price'];
        $pSDesc = $_POST['shortDesc'];
        $pCDesc = $_POST['completeDesc'];
       
            
        $p = new ModelProduct($pId, $pLabel, $pPrice, $pSDesc, $pCDesc);
        
       /* var_dump($p);
        echo "<br>";*/
        $p->save();
        
        $view = 'createdProduct';
        $controller = 'product';
        $pagetitle = 'Produit créé';
       
        require File::build_path(array('view', 'view.php'));
    }
}
?>
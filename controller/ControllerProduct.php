<?php

require_once File::build_path(array('model', 'ModelProduct.php'));
require_once File::build_path(array('model', 'ModelOption.php'));
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

    protected static $object = 'product';

    //###Action du panier

    public static function orderCommand() {
        $view = 'listCommand';
        if(Session::is_connected()){
            $controller = 'product';
            $pagetitle = 'Listes des commandes précédentes';
            require File::build_path(array('view', 'view.php'));
        }
        else{
            $orderCommand = true;
            ControllerUser::connect();
        }
    }


    public static function viewPanier() {
        $view = 'displayPanier';
        $controller = 'product';
        $pagetitle = 'Description du panier';
        require File::build_path(array('view', 'view.php'));
    }

    public static function addPanier() {
        $label = $_GET['label'];
        $price = $_GET['price'];
        
        
        
        Panier::addArticle($label, $price);
        self::viewPanier();
    }

    public static function deleteProductPanier() {
        $label = $_GET['label'];
        Panier::deleteArticle($label);
        self::viewPanier();
    }

    public static function clearPanier() {
        Panier::clearPanier($label);
        self::viewPanier();
    }

    //###Pour les options

    public function readOption() {
        $label = $_GET['label'];
        $p = ModelOption::select($label);

        $view = 'displayOption';
        $controller = 'product';
        $pagetitle = 'Description option ' . $label;
        require File::build_path(array('view', 'view.php'));
    }

    //###Action des produits


    public function read() {
        $label = $_GET['label'];
        $p = ModelProduct::select($label);
        $o = $p->selectAllOption();

        $view = 'displayProduct';
        $controller = 'product';
        $pagetitle = 'Description produit ' . $label;
        require File::build_path(array('view', 'view.php'));
    }

    public function readAll() {
        $tab_p = ModelProduct::selectAll();

        $view = 'displayAllProduct';
        $controller = 'product';
        $pagetitle = 'Description des produits';

        require File::build_path(array('view', 'view.php'));
    }

    public function create() {
        $view = 'updateProduct';
        $controller = 'product';
        $pagetitle = 'Création de produit';

        $cerise = "create";

        require File::build_path(array('view', 'view.php'));
    }

    public function update() {
        if (Session::is_admin() && Session::is_connected()) {

            $label = $_GET['label'];
            $p = ModelProduct::select($label);

            $cerise = "update";

            $view = 'updateProduct';
            $controller = 'product';
            $pagetitle = 'Modification d\' produit';
            require File::build_path(array('view', 'view.php'));
        } else {
            $error = "Vous n'avez pas les droits nécessaires pour effectuer cette action. ";
            ControllerUser::error();
        }
    }

    public function updated() {
        if (Session::is_admin() && Session::is_connected()) {
            $pId = $_POST['idP'];
            $pLabel = $_POST['label'];
            $pPrice = $_POST['price'];
            $pSDesc = $_POST['shortDesc'];
            $pCDesc = $_POST['completeDesc'];

            $data = array(
                'idProduct' => $pId,
                'label' => $pLabel,
                'price' => $pPrice,
                'shortDesc' => $pSDesc,
                'completeDesc' => $pCDesc
            );

            $controller = 'product';
            if (ModelProduct::update($data)) {
                $view = "displayAllProduct";
                $pagetitle = 'Modification d\' produit';
                $tab_p = ModelProduct::selectAll();
                require FILE::build_path(array('view', 'view.php'));
            } else {
                $error = "FATAL ERROR";
                ControllerUser::error();
            }
        } else {

            ControllerDefault::error("FATAL ERROR");
        }
    }

    public function created() {
         if (Session::is_admin() && Session::is_connected()) {
            $pId = $_POST['idP'];
            $pLabel = $_POST['label'];
            $pPrice = $_POST['price'];
            $pSDesc = $_POST['shortDesc'];
            $pCDesc = $_POST['completeDesc'];

            $data = array(
                'idProduct' => $pId,
                'label' => $pLabel,
                'price' => $pPrice,
                'shortDesc' => $pSDesc,
                'completeDesc' => $pCDesc
            );

            if (ModelProduct::save($data)) {
                $view = 'createdProduct';
                $controller = 'product';
                $pagetitle = 'Produit créé';

                require File::build_path(array('view', 'view.php'));
            } else {
            ControllerDefault::error("FATAL ERROR");
            }
         }else {
            $error = "Vous n'avez pas les droits nécessaires pour effectuer cette action. ";
            ControllerUser::error();
        }
    }

    public function delete() {
        if (Session::is_admin() && Session::is_connected()) {
            $id = $_GET['idProduct'];

            $p = ModelProduct::delete($id);

            $view = 'deleteProduct';
            $controller = 'product';
            $pagetitle = 'Produit supprimé';

            require File::build_path(array('view', 'view.php'));

        }else {
            $error = "Vous n'avez pas les droits nécessaires pour effectuer cette action. ";
            ControllerUser::error();
        }
    }

}

?>
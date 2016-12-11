<?php

require_once File::build_path(array('model', 'ModelProduct.php'));
require_once File::build_path(array('model', 'ModelOption.php'));
require_once File::build_path(array('model', 'ModelOrder.php'));
require_once File::build_path(array('lib', 'File.php'));
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
        if (Session::is_connected()) {
            $controller = 'product';
            $pagetitle = 'Listes des commandes précédentes';
            
            $bDate = date('Y/m/d');
            $state = "En cours";
            $nickName = $_SESSION['nickName'];
            $data = array(
               'nickName' => $nickName,
               'date' => $bDate,
               'state' => $state,
               'price' => Panier::totalPrice()
            );
            

            
            ModelOrder::save($data);
            $idOrder = ModelOrder::get_id($nickName, $bDate, $state);
            Panier::saveArticles($idOrder);
            
            require File::build_path(array('view', 'view.php'));
        } else {
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

    public static function deleteArticlePanier() {
        $label = $_GET['label'];
        Panier::deleteArticle($label);
        self::viewPanier();
    }
    public static function deleteAllArticlesPanier() {
        $label = $_GET['label'];
        Panier::deleteAllArticles($label);
        self::viewPanier();
    }

    public static function clearPanier() {
        Panier::clearPanier();
        self::viewPanier();
    }

    //###Pour les options

    public static function readOption() {
        $label = $_GET['label'];
        $p = ModelOption::select($label);

        $view = 'displayOption';
        $controller = 'product';
        $pagetitle = 'Description option ' . $label;
        require File::build_path(array('view', 'view.php'));
    }

    //###Action des produits


    public static function read() {
        $label = $_GET['label'];
        $p = ModelProduct::select($label);
        if(!is_null($p))
            $o = $p->selectAllOption();

        $view = 'displayProduct';
        $controller = 'product';
        $pagetitle = 'Description produit ' . $label;
        require File::build_path(array('view', 'view.php'));
    }

    public static function readAll() {
        $tab_p = ModelProduct::selectAll();

        $view = 'displayAllProduct';
        $controller = 'product';
        $pagetitle = 'Description des produits';

        require File::build_path(array('view', 'view.php'));
    }

    public static function create() {
        $view = 'updateProduct';
        $controller = 'product';
        $pagetitle = 'Création de produit';

        $cerise = "create";

        require File::build_path(array('view', 'view.php'));
    }

    public static function update() {
        if (Session::is_admin() && Session::is_connected()) {

            $label = $_GET['label'];
            $p = ModelProduct::select($label);

            $cerise = "update";

            $view = 'updateProduct';
            $controller = 'product';
            $pagetitle = 'Modification d\' produit';
            require File::build_path(array('view', 'view.php'));
        } else {
			 $data = array();
			$data['error'] =  "Vous n'avez pas les droits nécessaires pour effectuer cette action";
			$data['view'] =	"error";
			$data['controller'] = "default";
			ControllerDefault::error($data);
        }
    }

    public static function updated() {		
		$dataEr = array();
		$dataEr['pId'] = $_POST['idP'];
		$dataEr['pLabel'] = $_POST['label'];
		$dataEr['pPrice'] = $_POST['price'];
		$dataEr['pSDesc'] = $_POST['shortDesc'];
		$dataEr['pCDesc'] = $_POST['completeDesc'];
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
				$dataEr['error'] =  "Erreur de modification du produit";
				$dataEr['view'] =	"updateProduct";
				$dataEr['controller'] = "product";
				$dataEr['cerise'] = "update";
				ControllerDefault::error($dataEr);
            }
        } else {
			$dataEr['error'] =  "Vous n'avez pas les droits nécessaires pour effectuer cette action";
			$dataEr['view'] =	"error";
			$dataEr['controller'] = "default";
			ControllerDefault::error($dataEr);
			
        }
    }

    public static function created() {
		$dataEr = array();
		$dataEr['pId'] = $_POST['idP'];
		$dataEr['pLabel'] = $_POST['label'];
		$dataEr['pPrice'] = $_POST['price'];
		$dataEr['pSDesc'] = $_POST['shortDesc'];
		$dataEr['pCDesc'] = $_POST['completeDesc'];
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

            $extensions_valides = array('jpg','jpeg','png','gif','bmp');
            $extension_upload = strtolower(substr(strrchr($_FILES['path']['name'], '.'), 1));
            if (!in_array($extension_upload, $extensions_valides))
            {
				$dataEr['error'] =  "Extension incorrecte";
				$dataEr['view'] =	"updateProduct";
				$dataEr['controller'] = "product";
				$dataEr['cerise'] = "create";
				ControllerDefault::error($dataEr);
                return;
            }
            
            $nom = "res/upload/produit$pId.$extension_upload";
            $nom2 = "res/upload/produit$pId.jpg";
            move_uploaded_file($_FILES['path']['tmp_name'], $nom);
            File::convertImage($nom, $nom2, 100);
            //TODO setfacl for rights to apache

            if (ModelProduct::save($data)) {
                ControllerProduct::readAll();
            } else {
				$dataEr['error'] =  "Extension incorrecte";
				$dataEr['view'] =	"updateProduct";
				$dataEr['controller'] = "product";
				$dataEr['cerise'] = "create";
				ControllerDefault::error($dataEr);
            }
        } else {
			$dataEr['error'] =  "Vous n'avez pas les droits nécessaires pour effectuer cette action";
			$dataEr['view'] =	"error";
			$dataEr['controller'] = "default";
			ControllerDefault::error($dataEr);
        }
    }

    public static function delete() {
        if (Session::is_admin() && Session::is_connected()) {
            $id = $_GET['idProduct'];

            $p = ModelProduct::delete($id);

            $view = 'deleteProduct';
            $controller = 'product';
            $pagetitle = 'Produit supprimé';

            require File::build_path(array('view', 'view.php'));
        } else {
            $data = array();
			$data['error'] =  "Vous n'avez pas les droits nécessaires pour effectuer cette action";
			$data['view'] =	"error";
			$data['controller'] = "default";
			ControllerDefault::error($data);
        }
    }

    public static function research() {

        $data = $_GET['search'];
        $tab = ModelProduct::research($data);
		if($tab == false){
			$data = array();
			$data['error'] = "Aucun article ne correspond à la recherche";
			$data['view'] = "error";
			$data['controller'] = "default";
			ControllerDefault::error($data);
		}else{	
			$tab_p = array();
			foreach($tab as $key){
				array_push($tab_p,ModelProduct::Select($key['label']));
			}
			$view = 'displayAllProduct';
			$controller = 'product';
			$pagetitle = 'Description des produits';

			require File::build_path(array('view', 'view.php'));
		}
    }

}

?>
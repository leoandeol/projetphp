<?php
require_once File::build_path(array("model","ModelOrderContent.php"));

class Panier {

    public static function createPanier() {
        
        if(!isset($_SESSION['panier'])){
            
            $_SESSION['panier']=array(
                'id' => array(),
                'label' => array(),
                'price' => array(),
                'quantity' => array(),
                'verrou' => false
            );
        }
        return true;
    }
    
    public static function saveArticles($idCommand){
        if(self::createPanier() && !self::is_verouille()){
            for($i = 0; $i < self::countDiffArticles(); $i++){
                $article = ModelProduct::select($_SESSION['panier']['label'][$i]);
                $idArticle = $article->getId();
                $q = $_SESSION['panier']['quantity'][$i];
                $d = array(
                  'idOrder' => $idCommand,
                  'idProduct' => $idArticle,
                  'quantity'  => $q
                );
                ModelOrderContent::save($d);
            }
          self::clearPanier();
        }
    }


    
    public static function clearPanier(){
            $clear =array(
                'id' => array(),
                'label' => array(),
                'price' => array(),
                'quantity' => array(),
                'verrou' => false
            );
            $_SESSION['panier'] = $clear;
    }

    public static function addArticle($label,$price, $id){
        if(self::createPanier() && !self::is_verouille()){
            $exist = in_array($label, $_SESSION['panier']['label']);
            //si le produit existe on ne fait rien
            if($exist){
                $i = array_search($label, $_SESSION['panier']['label']);
                $_SESSION['panier']['quantity'][$i]++;
            }
            else{
                array_push($_SESSION['panier']['id'], $id);
                array_push($_SESSION['panier']['label'], $label);
                array_push($_SESSION['panier']['price'], $price);
                $q = 1;
                array_push($_SESSION['panier']['quantity'], $q);
            }
        }
        else{
            echo "<p>Un problème est survenu lors de l'ajout de l'article dans le panier. <br> Si le problème persiste veuillez contacter l'administrateur du site. </p>";
        }
    }
    public static function deleteArticle($label){
        if(self::createPanier() && !self::is_verouille()){
            $panierTmp = array(
                'id' => array(),
                'label'=> array(),
                'price' => array(),
                'quantity' => array(),
                'verrou' => $_SESSION['panier']['verrou']
            );

            for($i = 0; $i < self::countDiffArticles();$i++){
                 if($_SESSION['panier']['label'][$i] == $label && $_SESSION['panier']['quantity'][$i] > 1){
                     array_push( $panierTmp['id'],$_SESSION['panier']['id'][$i]);
                    array_push( $panierTmp['label'],$_SESSION['panier']['label'][$i]);
                    array_push( $panierTmp['price'],$_SESSION['panier']['price'][$i]);
                    array_push( $panierTmp['quantity'],$_SESSION['panier']['quantity'][$i]-1);
                }
                if($_SESSION['panier']['label'][$i] != $label){
                    array_push( $panierTmp['id'],$_SESSION['panier']['id'][$i]);
                    array_push( $panierTmp['label'],$_SESSION['panier']['label'][$i]);
                    array_push( $panierTmp['price'],$_SESSION['panier']['price'][$i]);
                    array_push( $panierTmp['quantity'],$_SESSION['panier']['quantity'][$i]);
                }
            }

            $_SESSION['panier'] = $panierTmp;
        }
    }
    public static function deleteAllArticles($label){
        if(self::createPanier() && !self::is_verouille()){
            $panierTmp = array(
                'id' => array(),
                'label'=> array(),
                'price' => array(),
                'quantity' => array(),
                'verrou' => $_SESSION['panier']['verrou']
            );

            for($i = 0; $i < self::countDiffArticles();$i++){
                if($_SESSION['panier']['label'][$i] != $label){
                    array_push( $panierTmp['id'],$_SESSION['panier']['id'][$i]);
                    array_push( $panierTmp['label'],$_SESSION['panier']['label'][$i]);
                    array_push( $panierTmp['price'],$_SESSION['panier']['price'][$i]);
                    array_push( $panierTmp['quantity'],$_SESSION['panier']['quantity'][$i]);
                }
            }

            $_SESSION['panier'] = $panierTmp;
        }
    }

    public static function is_verouille(){
        if(isset($_SESSION['panier'])){
            return $_SESSION['panier']['verrou'];
        }
        else{
            return false;
        }
    }
    
    public static function countDiffArticles(){
        if(self::createPanier()){
            return count($_SESSION['panier']['label']);
        }
        else{
            return 0;
        }
    }
        public static function countArticles(){
        if(self::createPanier()){
            $sum = 0;
            for($i = 0; $i < self::countDiffArticles(); $i++){
                $sum += $_SESSION['panier']['quantity'][$i];
            }
            return $sum;
        }
        else{
            return 0;
        }
    }

    public static function totalPrice(){
        if(self::createPanier()){
            $sum = 0;
            for($i = 0; $i < self::countDiffArticles(); $i++){
                $sum += $_SESSION['panier']['price'][$i]*$_SESSION['panier']['quantity'][$i];
            }
            return $sum;
        }
        else{
            return 0;
        }
    }

}

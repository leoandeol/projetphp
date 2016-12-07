<?php
require_once File::build_path(array("model","ModelOrderContent.php"));

class Panier {

    public static function createPanier() {
        
        if(!isset($_SESSION['panier'])){
            
            $_SESSION['panier']=array(
                'label' => array(),
                'price' => array(),
                'option' => array(),
                'verrou' => false
            );
        }
        return true;
    }
    
    public static function saveArticles($idCommand){
        if(self::createPanier() && !self::is_verouille()){
            for($i = 0; $i < self::countArticles(); $i++){
                $article = ModelProduct::select($_SESSION['panier']['label'][$i]);
                $idArticle = $article->getId();
                $d = array(
                  'idOrder' => $idCommand,
                  'idProduct' => $idArticle
                );
                var_dump($d);
                ModelOrderContent::save($d);
            }
        }
        self::clearPanier();
    }


    
    public static function clearPanier(){
        
        if(!isset($_SESSION['panier'])){
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
            setcookie(session_name(),'',time()-1);            
        }
        
    }

    public static function addArticle($label,$price){
        if(self::createPanier() && !self::is_verouille()){
            $exist = in_array($label, $_SESSION['panier']['label']);
            //si le produit existe on ne fait rien
            if($exist){

            }
            else{
                array_push($_SESSION['panier']['label'], $label);
                array_push($_SESSION['panier']['price'], $price);
            }
        }
        else{
            echo "<p>Un problème est survenu lors de l'ajout de l'article dans le panier. <br> Si le problème persiste veuillez contacter l'administrateur du site. </p>";
        }
    }

    public static function deleteArticle($label){
        if(self::createPanier() && !self::is_verouille()){
            $panierTmp = array(
                'label'=> array(),
                'price' => array(),
                'verrou' => $_SESSION['panier']['verrou']
            );

            for($i = 0; $i < self::countArticles();$i++){
                if($_SESSION['panier']['label'][$i] != $label){
                    array_push( $panierTmp['label'],$_SESSION['panier']['label'][$i]);
                    array_push( $panierTmp['price'],$_SESSION['panier']['price'][$i]);
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
    
    public static function countArticles(){
        if(self::createPanier()){
            return count($_SESSION['panier']['label']);
        }
        else{
            return 0;
        }
    }

    public static function totalPrice(){
        if(self::createPanier()){
            $sum = 0;
            for($i = 0; $i < self::countArticles(); $i++){
                $sum += $_SESSION['panier']['price'][$i];
            }
            return $sum;
        }
        else{
            return 0;
        }
    }

}

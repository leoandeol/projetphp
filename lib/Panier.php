<?php

class Panier {

    public static function creerPanier() {
        
        if(!isset($_SESSION['panier'])){
            
            $_SESSION['panier']=array(
                'label' => array(),
                'price' => array(),
                'verroy' => false
            );
        }
        return true;
    }

    public static function ajoutArticle($label,$price){
        if(self::creerPanier() && !self::is_verouille()){
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

    public static function supprimerArticle($label){
        if(self::creerPanier() && !self::is_verouille()){
            $panierTmp = array(
                'label'=> array(),
                'price' => array(),
                'verrou' => $_SESSION['panier']['verrou']
            );

            for($i = 0; $i < self::compterArticles();$i++){
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
    
    public static function compterArticles(){
        if(self::creerPanier()){
            return count($_SESSION['panier']['label']);
        }
        else{
            return 0;
        }
    }

    public static function montantGlobal(){
        if(self::creerPanier()){
            $sum = 0;
            for($i = 0; $i < self::compterArticles(); $i++){
                $sum += $_SESSION['panier']['price'][$i];
            }
            return $sum;
        }
        else{
            return 0;
        }
    }

}

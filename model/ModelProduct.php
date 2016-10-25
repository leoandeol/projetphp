<?php

require_once FILE::build_path(array('model', 'Model.php'));

class Product{
    
    private $idProduct;
    private $productName;
    private $price;
    
    private static $compteur = 0;
    
 // ###################################################      
    // Getters
    public function getId(){
        return $this->idProduct;
    }
    public function getProductName(){
        return $this->productName;
    }
    public function getPrice(){
        return $this->price;
    }
    
    
 // ###################################################      
    // Setters  
    public function setId($id){
        $this->idProduct = $id;
    }
    public function setProductName($bird){
        $this->productName = $bird;
    }
    public function setPrice($bird){
        $this->price = $bird;
    }
    
// ###################################################      
    // Fonction    
    public function __construc($id = NULL, $pn = NULL, $p = NULL){
        if (!is_null($id) && !is_null($pn) && !is_null($p)){
            $this->idProduction = $id;
            $this->productName = $pn;
            $this->price = $p;
        }
    }
    
    public function getProductByName($name){
        try {
            $sql = "SELECT * FROM Products WHERE idProduct:n";
            
            $req_prep = Model::$pdo->prepare($sql);
            
            $values = array(
              "n" => $name  
            );
            
            $req_prep->execute($values);
            
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');
            $tab_p = $req_prep->fetchAll();
            
            if(empty($tab_p)){
                return false;
            }
            return $tab_p[0];
        } catch (PDOException $e) {
             if (Conf::getDebug()) {
                 echo $e->getMessage(); // affiche un message d'erreur
             } else {
                 echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
             }
             die();
         }
    }
    
    
    
    public function save(){
        try{
            $sql = "INSERT INTO Products(idProduit, productName, price) VALUES(:id, :n, :p";
            
            //préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            
            $values = array(
                "id" => self::compteur,
                "n" => $this->productName,
                "p" => $this->price
            );
            
            return $req_prep->execute($values);
            
        } catch (PDOException $e) {
            if($e->getCode()==23000){
                echo '<br>Le produit existe déjà. ';
                return false;
            }
            else{
                echo '<br>Une erreur est survenue lors de la sauvegarde du produit. ';
            }
                

        }
    }
    
  
    
}


?>


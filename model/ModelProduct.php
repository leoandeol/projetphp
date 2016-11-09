<?php

require_once FILE::build_path(array('model', 'Model.php'));

class ModelProduct {

    private $idProduct;
    private $label;
    private $price;
    private $shortDesc;
    private $completeDesc;

    // ###################################################      
    // Getters
    public function getId() {
        return $this->idProduct;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getShortDesc() {
        return $this->shortDesc;
    }

    public function getCompleteDesc() {
        return $this->completeDesc;
    }

    // ###################################################      
    // Setters  
    public function setId($id) {
        $this->idProduct = $id;
    }

    public function setLabel($bird) {
        $this->label = $bird;
    }

    public function setPrice($bird) {
        $this->price = $bird;
    }

    public function setShortDesc($s) {
        $this->shortDesc = $s;
    }

    public function setCompleteDesc($d) {
        $this->completeDesc = $d;
    }

// ###################################################      
    // Fonction    
    public function __construct($id = NULL, $l = NULL, $p = NULL, $sd = NULL, $cd = NULL) {
        if (!is_null($id) && !is_null($l) && !is_null($p) && !is_null($sd) && !is_null($cd)) {
            $this->idProduct = $id;
            $this->label = $l;
            $this->price = $p;
            $this->shortDesc = $sd;
            $this->completeDesc = $cd;
        }
    }

    public function getProductByLabel($label) {
        try {
            $sql = "SELECT * FROM Products WHERE label=:n";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "n" => $label
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');
            $tab_p = $req_prep->fetchAll();

            if (empty($tab_p)) {
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

    public function save() {
        try {
            $sql = "INSERT INTO Products(idProduct, label, price, shortDesc, completeDesc) VALUES(:id, :l, :p, :sd, :cd);";

            //préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);


            $values = array(
                "id" => (int) $this->idProduct,
                "l" => $this->label,
                "p" => (int) $this->price,
                "sd" => $this->shortDesc,
                "cd" => $this->completeDesc
            );

            return $req_prep->execute($values);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo '<br>Le produit existe déjà. ';
                return false;
            } else {
                echo $e->getMessage();
                echo '<br>Une erreur est survenue lors de la sauvegarde du produit. ';
            }
        }
    }

    public function del($idProduct) {
        try {
            $sql = "DELETE FROM Products WHERE idProduct=:id";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "id" => $idProduct
            );

            $req_prep->execute($values);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllProduct() {
        try {
            $sql = "SELECT * FROM Products;";

            $req_prep = Model::$pdo->query($sql);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');

            $tab_p = $req_prep->fetchAll();


            if (empty($tab_p)) {
                return false;
            }
            return $tab_p;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

}
?>


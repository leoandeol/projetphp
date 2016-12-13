<?php

require_once FILE::build_path(array('model', 'Model.php'));

class ModelProduct extends Model {

    private $idProduct;
    private $label;
    private $price;
    private $shortDesc;
    private $completeDesc;
    protected static $object = "product";
    protected static $primary = 'idProduct';

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

    public function countOption() {
        try {
            $sql = "SELECT COUNT(*) FROM Products P JOIN Options O ON O.idProduct = P.idProduct WHERE P.idProduct=:id";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "id" => $this->idProduct
            );

            $nb = $req_prep->execute($values);


            return $nb;
        } catch (Exception $e) {
            return false;
        }
    }

	public static function research($data){      
        try{
            $exploded = explode(" ",$data);
            
            $values = array();
            
            foreach($exploded as $key){
                $values[$key] = $key;
            }
            
            $sql = "SELECT  label FROM Products WHERE label ";

            foreach($exploded as $key){
                $sql = $sql."LIKE '%".$key."%' OR label ";
            }
            $sql = rtrim($sql," OR label ").";";
            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
            $tab_p = $req_prep->fetchAll();
            if (empty($tab_p)) {
                return false;
            }
            return $tab_p;
        } catch (PDOException $ex) {
            if (Conf::getDebug()) {
                echo $ex->getMessage();
            } else {
                echo "une erreur est survenue.";
            }
            return false;
        }
    }
/*
    public function selectAllOption() {
        try {
            $sql = "SELECT * FROM Products P JOIN Options O ON O.idProduct = P.idProduct WHERE P.idProduct=:id";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "id" => $this->idProduct
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelOption');

            return $req_prep->fetchAll();
        } catch (PDOException $ex) {
            if (Conf::getDebug()) {
                echo $ex->getMessage();
            } else {
                echo "une erreur est survenue lors de la mise à jour de l'objet.";
            }
            return false;
        }
    }*/
}

?>


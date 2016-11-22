<?php

require_once FILE::build_path(array('model', 'Model.php'));

class ModelOption extends Model {

    private $idOption;
    private $name;
    private $price;
    private $description;
    private $idProduct;
    
    
    protected static $object = "option";
    protected static $primary = 'idOption';

    // ###################################################      
    // Getters
    public function getId() {
        return $this->idOption;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getIdProduct() {
        return $this->idProduct;
    }

    // ###################################################      
    // Setters  
    public function setId($id) {
        $this->idOption = $id;
    }

    public function setLabel($bird) {
        $this->name = $bird;
    }

    public function setPrice($bird) {
        $this->price = $bird;
    }

    public function setDescription($s) {
        $this->description = $s;
    }

    public function setIdProduct($d) {
        $this->idProduct = $d;
    }

// ###################################################      
    // Fonction    
    public function __construct($id = NULL, $l = NULL, $p = NULL, $sd = NULL, $cd = NULL) {
        if (!is_null($id) && !is_null($l) && !is_null($p) && !is_null($sd) && !is_null($cd)) {
            $this->idOption = $id;
            $this->name = $l;
            $this->price = $p;
            $this->description = $sd;
            $this->idProduct = $cd;
        }
    }

}
?>


<?php

require_once FILE::build_path(array('model', 'Model.php'));

class ModelOrderContent extends Model {

    private $idOrder;
    private $idProduct;
    
    
    protected static $object = "orderContent";

// ###################################################      
    // Fonction    
    public function __construct($id = NULL, $l = NULL) {
        if (!is_null($id) && !is_null($l)) {
            $this->idOrder = $id;
            $this->idProduct = $l;

        }
    }

}
?>


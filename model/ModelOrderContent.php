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
    public static function selectAllProduct($values){
        try {
            $sql = "SELECT P.idProduct, P.label, P.price, P.shortDesc, P.completeDesc "
                    . "FROM Products P "
                    . " JOIN OrderContents OC ON OC.idProduct=P.idProduct "
                    . " WHERE OC.idOrder=:idOrder; ";

            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');
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
}
?>


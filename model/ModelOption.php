<?php

require_once FILE::build_path(array('model', 'Model.php'));

class ModelOption {

    private $idOption;
    private $name;
    private $price;
    private $description;
    private $idProduct;
    /*    
    public function __construct($id = NULL, $l = NULL, $p = NULL, $d = NULL, $idp = NULL) {
        if (!is_null($id) && !is_null($l) && !is_null($p) && !is_null($sd) && !is_null($cd)) {
            $this->idOption = $id;
            $this->name = $l;
            $this->price = $p;
            $this->description = $d;
            $this->idProduct = $idp;
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
    }*/

}
?>


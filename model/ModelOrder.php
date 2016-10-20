<?php

require_once File::build_path(array("model","Model.php"));

class ModelOrder {
  private $id;
  private $userID;
  private $date;
  private $state;

  public function getState(){
    return $this->state;
  }

  public function setState($state2){
    $this->state = $state2;
  }

  public function getUserID(){
    return $this->userID;
  }

  public function setUserID($i){
    $this->userID = $i;
  }	

  public function getDate(){
    return $this->date;
  }

  public function setDate($d){
    $this->date = $d;
  }	

  public function getID(){
    return $this->id;
  }


  /*public function __construct($m = NULL, $i = NULL, $c = NULL){
    if(!is_null($m)&&!is_null($c)&&!is_null($i)){
      $this->marque = $m;
      $this->immatriculation = $i;
      $this->couleur = $c;
    }
  }

  /*public function afficher(){
    echo "<p>Voiture ".$this->immatriculation." de marque $this->marque (couleur $this->couleur)</p>";
  }

  public static function getAllVoitures(){
    $rep = Model::$pdo->query("SELECT * FROM voiture");
    $tab_obj = $rep->fetchAll(PDO::FETCH_CLASS, 'ModelVoiture');
    return $tab_obj;
  }

  public static function getVoitureByImmat($immat) {
    $sql = "SELECT * from voiture WHERE immatriculation=:nom_var";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
  
    $values = array(
		    //nomdutag => valeur,
		    "nom_var" => $immat,
		    );
    // On donne les valeurs et on exécute la requête	 
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
    if($req_prep->rowCount()==0){
        require File::build_path(array("view","voiture","error.php"));
    }
    return $req_prep->fetch();
    // Attention, si il n'y a pas de résultats, fetch renvoie FALSE
    // Pour voir si il y a des résultat : ($req_prep->rowCount() != 0)
  }
  
  public static function deleteByImmat($immat){
      $sql = "DELETE FROM voiture WHERE immatriculation=:nom_var";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
  
    $values = array(
		    //nomdutag => valeur,
		    "nom_var" => $immat,
		    );
    // On donne les valeurs et on exécute la requête	 
    $req_prep->execute($values);
  }
  
  public static function update($data){
      $sql = "UPDATE voiture SET couleur=:couleur AND marque=:marque WHERE immatriculation=:nom_var";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
  
    $values = array(
		    //nomdutag => valeur,
		    "nom_var" => $data['immat'],
                     "marque" => $data['marque'],
                    "couleur" => $data['couleur']
		    );
    // On donne les valeurs et on exécute la requête	 
    $req_prep->execute($values);
  }

  public function save(){
    $sql = "INSERT INTO voiture (immatriculation, marque, couleur) VALUES ( :v1, :v2, :v3 );";
    $req_prep = Model::$pdo->prepare($sql);
    $values = array(
		    ":v1" => $this->immatriculation,
		    ":v2" => $this->marque,
		    ":v3" => $this->couleur,
		    );
    $req_prep->execute($values);
  }*/

}
?>

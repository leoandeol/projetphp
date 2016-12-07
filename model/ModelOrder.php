<?php

require_once File::build_path(array("model","Model.php"));

class ModelOrder extends Model{
  private $id;
  private $nickName;
  private $date;
  private $state;
  
  
    protected static $object = "order";
    protected static $primary = 'idOrder';

  public function getState(){
    return $this->state;
  }

  public function setState($state2){
    $this->state = $state2;
  }

  public function getUserID(){
    return $this->nickName;
  }

  public function setUserID($i){
    $this->nickName = $i;
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


  public function __construct($m = NULL, $i = NULL, $c = NULL, $d = NULL){
    if(!is_null($m)&&!is_null($c)&&!is_null($i)&&!is_null($d)){
      $this->id = $m;
      $this->nickName = $i;
      $this->date = $c;
      $this->state = $d;
    }
  }
  public static function get_id($nickName, $date, $state){
        try {


            $sql = "SELECT * FROM Orders WHERE nickName=:a and date=:d and state=:s;";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "a" => $nickName,
                "d" => $date,
                "s" => $state
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelOrder');
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
}
?>

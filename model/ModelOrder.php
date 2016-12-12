<?php

require_once File::build_path(array("model","Model.php"));

class ModelOrder extends Model{
  private $idOrder;
  private $nickName;
  private $date;
  private $state;
  private $price;
  
    protected static $object = "order";
    protected static $primary = 'idOrder';

    
  public function getIDOrder(){
    return $this->idOrder;
  }
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


  public function getPrice(){
    return $this->price;
  }


  public function __construct($m = NULL, $i = NULL, $c = NULL, $d = NULL, $p = NULL){
    if(!is_null($m)&&!is_null($c)&&!is_null($i)&&!is_null($d) && !is_null($p)){
      $this->id = $m;
      $this->nickName = $i;
      $this->date = $c;
      $this->state = $d;
      $this->price = $p;
    }
  }
  public static function getLastOrder($nickName){
        try {

            $sql = "SELECT MAX(idOrder) FROM Orders WHERE nickname=:nickname";

            $req_prep = Model::$pdo->prepare($sql);
            
            $values = array(
                'nickname'=>$nickName                
            );
            
            $req_prep->execute($values);
            
            $req_prep->setFetchMode(PDO::FETCH_NUM);
            $tab_p = $req_prep->fetchAll();


            if (empty($tab_p)) {
                return false;
            }
            return $tab_p[0][0];
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
  }
  public static function selectAllByUserName($values){
       try {

            $sql = "SELECT * FROM Orders WHERE nickName=:nickName;";

            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelOrder');

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
            return false;
        }
  }
}
?>

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
}
?>

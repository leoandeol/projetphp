<?php

require_once File::build_path(array('model','Model.php'));

class ModelUser {
    
    private $id;
    private $username;
    private $userfirstname;
    private $mail;
    private $birthdate;
    
    public function __construct($id = NULL, $userN = NULL, $userFN = NULL, $mail = NULL, $bd = NULL){
        if(!is_null($id) && !is_null($userN) && !is_null($userFN) &&!is_null($mail) && !is_null($bd)){
            $this->id = $id;
            $this->username = $userN;
            $this->userfirstname = $userFN;
            $this->mail = $mail;
            $this->birthdate = $bd;
        }
    }
    
    public function display(){
        echo "User n° : "+$this->id+" name : "+$this->username+" firstname : "
             +$this->userfirsname+" mail : "+$this->usermail+" birthdate : "+$this->birhtdate;
    }
    
    public static function getUserById($id){
        
        $query = "SELECT * 
                  FROM Users
                  WHERE idUser = :idUs";
        
        try{
            $prepared = Model::$pdo->prepare($sql);
            $values = array (
                'idUs'=>$id,
            );
            $prepared->execute($values);
            $prepared->setFetchMode(PDO::FETCH_CLASS,'ModelUser');
            return $prepared->fetch();
        } catch (PDOException $ex) {
            if(Conf::getDebug()){
                echo $ex->getMessage();
            }
            else{
                echo "une erreur est survenue.";
            }
        }    
    }
    
    public static function getAllUser(){
    
        $query = "SELECT * FROM Users";
        try{
            $prep = Model::$pdo->query($query);
            $prep->setFetchMode(PDO::FETCH_CLASS,'ModelUser');
            $prep->Fetch();
        } catch (PDOException $ex) {
            if(Conf::getDebug()){
                echo $ex->getMessage();
            }
            else{
                echo "une erreur est survenue.";
            }
        }        
    }
    
}

?>

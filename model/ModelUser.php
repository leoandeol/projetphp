<?php

require_once File::build_path(array('model','Model.php'));

class ModelUser {
    
    private $id;
    private $nickName;
    private $firstName;
    private $lastName;
    private $mail;
    private $birthdate;
    
    public function __construct($id = NULL, $nickName = NULL, $firstName = NULL, $lastName = NULL, $mail = NULL, $bd = NULL){
        if(!is_null($id) && !is_null($nickName) && !is_null($firstName) && !is_null($lastName) &&!is_null($mail) && !is_null($bd)){
            $this->id = $id;
            $this->nickName = $nickName;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->mail = $mail;
            $this->birthdate = $bd;
        }
    }
    
    public function display(){
        echo "User n° : ".$this->id." name : ".$this->username." firstname : "
             .$this->userfirstname." mail : ".$this->mail." birthdate : ".$this->birthdate;
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
            return $prep->fetchAll();
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

<?php

require_once File::build_path(array('model','Model.php'));

class ModelUser {
    
    private $idUser;
    private $password;
    private $nickName;
    private $firstName;
    private $lastName;
    private $mail;
    private $birthDate;
    private $isAdmin;
    
    function getIdUser() {
        return $this->idUser;
    }

    function getPassword() {
        return $this->password;
    }

    function getNickName() {
        return $this->nickName;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getMail() {
        return $this->mail;
    }

    function getBirthDate() {
        return $this->birthDate;
    }

    function getIsAdmin() {
        return $this->isAdmin;
    }

    function setNickName($nickName) {
        $this->nickName = $nickName;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }


    
    public function __construct($id = NULL, $nickName = NULL,$pwd = NULL, $firstName = NULL, $lastName = NULL, $mail = NULL, $bd = NULL, $isAdmn = NULL){
        if(!is_null($id) && !is_null($nickName) && !is_null($firstName) && !is_null($lastName) &&!is_null($mail) && !is_null($bd) && !is_null($isAdmn)
                && !is_null($pwd)){
            $this->idUser = $id;
            $this->nickName = $nickName;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->mail = $mail;
            $this->birthDate = $bd;
            $this->isAdmin = $isAdmn;
            $this->password = $pwd;
        }
    }
    
    /*public function display(){
        echo "User n° : ".$this->idUser." name : ".$this->lastName." firstname : "
             .$this->firstName." mail : ".$this->mail." birthdate : ".$this->birthDate;
    }*/
    
    public static function getUserById($id){
        
        $query = "SELECT * 
                  FROM Users
                  WHERE idUser = :idUs";
        
        try{
            $prepared = Model::$pdo->prepare($query);
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
    
    public function save(){
        $query = " INSERT INTO Users(nickName,lastName,password,firstName,mail,birthDate,isAdmin) VALUES (:nickn, :lastn, :pwd, :firstn, :mail, :bdate, :admn) ";
        try{
            $prep = Model::$pdo->prepare($query);
            $values = array (
                    ':nickn'=>$this->getNickName(),
                    ':lastn'=>$this->getLastName(),
                    ':pwd'=>$this->getPassword(),
                    'firstn'=>$this->getFirstName(),
                    ':mail'=>$this->getMail(),
                    ':bdate'=>$this->getBirthDate(),
                    ':admn'=>$this->getIsAdmin()
                    
                    );
            $prep->execute($values);
        } catch (PDOException $ex) {
            if(Conf::getDebug()){
                echo $ex->getMessage();
            }
            else{
                echo "une erreur est survenue.";
            }
            return false;
        }
    }
    
}

?>

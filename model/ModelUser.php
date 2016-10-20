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
    
    public static function displayById($id){
        
        $query = "SELECT * 
                  FROM Users
                  WHERE idUser = :idUs";
        
        try{
            $prepared = Model::$pdo->prepare($sql);
            $values = array (
                'idUs'=>$id,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'ModelUser');
            return $req_prep->fetch();
        } catch (PDOException $ex) {
            if(Conf::getDebug()){
                echo $ex->getMessage();
            }
            else{
                echo "une erreur est survenue.";
            }
        }    
    }
    
    public static function displayAll(){
    
        $query = "SELECT * FROM Users";
        try{
            $rep = Model::$pdo->query($query);
            $rep->setFechMode(PDO::FETCH_CLASS,'ModelUser');
            $rep->Fetch();
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

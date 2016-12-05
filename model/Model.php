<?php

require_once File::build_path(array('config', 'config.php'));

class Model {

    public static $pdo;
    private static $hostname;
    private static $database_name;
    private static $login;
    private static $password;

    public static function Init() {

        $hostname = Conf::getHostName();
        $database_name = Conf::getDatabaseName();
        $login = Conf::getLogin();
        $password = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function update($data) {
        try {
            $table_name = ucfirst(static::$object);
            $class_name = 'Model' . $table_name;
            $table_name = $table_name . "s";



            $sql = "UPDATE $table_name SET ";

            foreach ($data as $cle => $valeur) {
                $sql = $sql . $cle . "=:" . $cle . ", ";
            }

            $sql = rtrim($sql, ' ,');

            $primary_key = static::$primary;

            $sql = $sql . " WHERE $primary_key=:$primary_key;";
            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
            return true;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            return false;
        }
    }

    public static function selectAll() {
        try {

            $table_name = ucfirst(static::$object);
            $class_name = 'Model' . $table_name;
            $table_name = $table_name . "s";

            $sql = "SELECT * FROM $table_name;";

            $req_prep = Model::$pdo->query($sql);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);

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

    public function select($data) {
        try {

            $table_name = ucfirst(static::$object);
            $class_name = 'Model' . $table_name;
            
            $table_name = $table_name . "s";
            
            $primary_key = static::$primary;

            if ($table_name == 'Products') {
                $primary_key = 'label';
            }
            if ($table_name == 'Options') {
                $primary_key = 'name';
            }

            $sql = "SELECT * FROM $table_name WHERE $primary_key=:p;";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "p" => $data
            );

            $req_prep->execute($values);


            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
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

    public static function delete($primary) {
        try {
            $table_name = ucfirst(static::$object);
            $class_name = 'Model' . $table_name;
            $table_name = $table_name . "s";

            $primary_key = static::$primary;

            $sql = "DELETE FROM $table_name WHERE $primary_key=:p";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "p" => $primary
            );

            $req_prep->execute($values);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function save($data) {
        try {
            $table_name = ucfirst(static::$object);
            $class_name = 'Model' . $table_name;
            $table_name = $table_name . "s";


            $sql = "INSERT INTO $table_name VALUES(";

            foreach ($data as $cle => $valeur) {
                $sql = $sql . ":" . $cle . ", ";
            }
            $sql = rtrim($sql, " ,") . ");";

            //préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            return $req_prep->execute($data);
        } catch (PDOException $ex) {
            if (Conf::getDebug()) {
                echo $ex->getMessage();
            } else {
                echo "une erreur est survenue.";
            }
            return false;
        }
    }
    
    public static function research($data){      
        try{
            $exploded = explode(" ",$data);
            
            $values = array();
            
            foreach($exploded as $key){
                $values[$key] = $key;
            }
            
            $sql = "SELECT idProduct FROM Products WHERE label ";

            foreach($exploded as $key){
                $sql = $sql."LIKE '%:".$key."%' OR label ";
            }
            $sql = rtrim($sql," OR label ").";";
            
            echo"$sql";
            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
            
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

Model::Init();
?>
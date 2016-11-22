<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelUser extends Model{

    private $password;
    private $nickName;
    private $firstName;
    private $lastName;
    private $mail;
    private $birthDate;
    private $isAdmin;
    protected static $object = "user";
    protected static $primary = 'nickName';

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

    public static function getSeed() {
        return self::$seed;
    }

    public function __construct($nickName = NULL, $pwd = NULL, $firstName = NULL, $lastName = NULL, $mail = NULL, $bd = NULL, $isAdmn = NULL) {
        if (!is_null($nickName) && !is_null($firstName) && !is_null($lastName) && !is_null($mail) && !is_null($bd) && !is_null($isAdmn) && !is_null($pwd)) {
            $this->nickName = $nickName;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->mail = $mail;
            $this->birthDate = $bd;
            $this->isAdmin = $isAdmn;
            $this->password = $pwd;
        }
    }
    
    public static function checkPassword($nick, $pass) {
        $query = "Select nickName,nonce From Users Where nickName=:nickn and password=:pwd";
        try {
            $prep = Model::$pdo->prepare($query);
            $values = array(
                ':nickn' => $nick,
                ':pwd' => $pass
            );
            $prep->execute($values);
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            if (Conf::getDebug()) {
                echo $ex->getMessage();
            } else {
                echo "une erreur est survenue.";
            }
            return false;
        }
    }

    public static function connect($nick, $pass) {

        $result = ModelUser::checkPassword($nick, $pass);
        if ($result['nickName'] == $nick && $result['nonce'] == NULL) {
            $query = "Select * From Users Where nickName=:nickn and password=:pwd";
            try {
                $prep = Model::$pdo->prepare($query);
                $values = array(
                    ':nickn' => $nick,
                    ':pwd' => $pass,
                );
                $prep->execute($values);
                $prep->setFetchMode(PDO::FETCH_CLASS,'ModelUser');
                $res = $prep->fetch();
                return $res;
            } catch (PDOException $ex) {
                if (Conf::getDebug()) {
                    echo $ex->getMessage();
                } else {
                    echo "une erreur est survenue.";
                }
                return null;
            }
        } else if ($result[0] >= 1) {
            return null;
        } else {
            return null;
        }
    }
}

?>

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
    private $nonce;
    protected static $object = "user";
    protected static $primary = 'nickName';

    public function getNonce() {
        return $this->nonce;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function getNickName() {
        return $this->nickName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function setNickName($nickName) {
        $this->nickName = $nickName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }
    
    public function setNonce($nonce) {
        $this->nonce = $nonce;
    }

    public static function getSeed() {
        return self::$seed;
    }

    public function __construct($nickName = NULL, $pwd = NULL, $firstName = NULL, $lastName = NULL, $mail = NULL, $bd = NULL, $isAdmn = NULL, $nonce = NULL) {
        if (!is_null($nickName) && !is_null($firstName) && !is_null($lastName) && !is_null($mail) && !is_null($bd) && !is_null($isAdmn) && !is_null($pwd) && !is_null($nonce)) {
            $this->nickName = $nickName;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->mail = $mail;
            $this->birthDate = $bd;
            $this->isAdmin = $isAdmn;
            $this->password = $pwd;
            $this->nonce = $nonce;
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

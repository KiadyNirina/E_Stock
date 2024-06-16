<?php 

namespace App;

class Bdd {
    private $dsn;
    private $username;
    private $password;
    private $pdo;

    public function __construct($dsn, $username, $password) {
        $this -> dsn = $dsn;
        $this -> username = $username;
        $this -> password = $password;
    }

    public function connect() {
        try {

            $this -> pdo = new \PDO($this -> dsn, $this -> username, $this -> password);
            $this -> pdo -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return true;
        
        } catch (\PDOException $e) {
            
            echo 'Erreur de connexion : ' . $e->getMessage();
            return false;
        
        }
    }

    public function getPDO() {
        return $this -> pdo;
    }
}

?>
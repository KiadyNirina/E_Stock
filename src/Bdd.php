<?php 

namespace App;

use PDO;

class Bdd {
    private $dsn = "mysql:host=localhost;dbname=gestion_de_stock";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct() {
        $this -> pdo = $this -> connect();
    }

    public function connect() {
        try {

            $pdo = new \PDO($this -> dsn, $this -> username, $this -> password);
            $pdo -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        
        } catch (\PDOException $e) {
            
            echo 'Erreur de connexion : ' . $e->getMessage();
            return false;
        
        }
    }

    public function run($query) {
        try{
            $stmt = $this -> pdo -> prepare($query);
            $stmt -> execute();
            return $stmt-> fetchAll(PDO::FETCH_OBJ); 
        } catch (\PDOException $e) {
            $errorStmt = "Erreur lors de l'envoye du requête : " . $e -> getMessage();
            return $errorStmt;
        }
    }

    public function numRows($query) {
        try{
            $stmt = $this -> pdo -> prepare($query);
            $stmt -> execute();
            return $stmt -> rowCount();
        } catch (\PDOException $e) {
            $errorStmt = "Erreur lors de l'envoye du requête : " . $e -> getMessage();
            return $errorStmt;
        }
    }

    public function search($query, $inputSearch) {
        try{
            $stmt = $this -> pdo -> prepare($query);
            $stmt -> execute(['searchTerm' => '%' . $inputSearch . '%']);
            return $stmt -> fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            $errorStmt = "Erreur lors de l'envoye du requête : " . $e -> getMessage();
            return $errorStmt;
        }
    }
}

?>
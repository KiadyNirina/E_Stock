<?php

namespace App;
use App\Bdd;

class EmployeesMiss {

    public $missing;

    public function __construct($missing)
    {
        $this -> missing = $missing;
    }

    public function getError()
    {
        $error = [];

        if (empty($this -> missing)) {
            $error['missing'] = "Veuillez listez les employées absents"; 
        }

        return $error;
    }

    public function add()
    {
        $pdo = new Bdd();
        $req = $pdo->connect();
        
        $query = "INSERT INTO employees_missing (date, missing) VALUES (:date, :missing)";
        
        $result = $req->prepare($query);
        @$result->bindParam(':date', date('l j F Y h:i A'));
        $result->bindParam(':missing', $this -> missing);

        return $result->execute();
    }

    public function update($id)
    {
        $pdo = new Bdd();
        $req = $pdo->connect();

        $query = "UPDATE employees_missing SET missing = :missing WHERE id = :id";

        $result = $req->prepare($query);
        $result->bindParam(':missing', $this -> missing);
        $result->bindParam(':id', $id);

        return $result->execute();
    }

    public function delete($id)
    {
        $pdo = new Bdd();
        $req = $pdo->connect();

        $query = "DELETE FROM employees_missing WHERE id = :id";
        
        $result = $req -> prepare($query);
        $result -> bindParam(':id', $id);

        return $result -> execute();
    }

}

?>
<?php

namespace App;
use App\Bdd;

class Employees {

    public $matricule;
    public $name;
    public $lastname;
    public $gender;
    public $birthday;
    public $status;
    public $post;
    public $salary;
    public $email;
    public $tel;
    public $recrutment;
    public $end;

    public function __construct($matricule, $name, $lastname, $gender, $birthday, $status, $post, $salary, $email, $tel, $recrutment, $end)
    {
        $this -> matricule = $matricule;
        $this -> name = $name;
        $this -> lastname = $lastname;
        $this -> gender = $gender;
        $this -> birthday = $birthday;
        $this -> status = $status;
        $this -> post = $post;
        $this -> salary = $salary;
        $this -> email = $email;
        $this -> tel = $tel;
        $this ->  recrutment = $recrutment;
        $this -> end = $end;
    }

    public function getError()
    {
        $error = [];
        if (empty($this -> matricule)) {
            $error['matricule'] = "Veuillez remplir le numéro de matricule"; 
        }

        if (empty($this -> name)) {
            $error['name'] = "Veuillez remplir le nom"; 
        }

        if (empty($this -> lastname)) {
            $error['lastname'] = "Veuillez remplir le prénom"; 
        }

        if (empty($this -> birthday)) {
            $error['birthday'] = "Veuillez remplir la date de naissance"; 
        }

        if (empty($this -> post)) {
            $error['post'] = "Veuillez remplir le poste"; 
        }

        if (empty($this -> salary)) {
            $error['salary'] = "Veuillez remplir le salaire monsuel"; 
        }
        
        if (!empty($this -> salary) && !filter_var($this -> salary, FILTER_VALIDATE_FLOAT)) {
            $error['salary'] = "Ce prix n'est pas correct"; 
        }

        if (empty($this -> email) && !filter_var($this -> email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Veuillez remplir l'email"; 
        }

        if (empty($this -> tel) && !filter_var($this -> tel, FILTER_VALIDATE_INT)) {
            $error['tel'] = "Veuillez remplir le tel"; 
        }

        if (empty($this -> recrutment)) {
            $error['recrutment'] = "Veuillez remplir la date de recrutement"; 
        }

        if (empty($this -> end)) {
            $error['end'] = "Veuillez remplir la date de fin du contract"; 
        }

        return $error;
    }

    public function add()
    {
        $pdo = new Bdd();
        $req = $pdo->connect();
        
        $query = "INSERT INTO employees (matricule, name, lastname, gender, birthday, status, post, Salary, email, tel, recrutment, end_contract) VALUES (:matricule, :name, :lastname, :gender, :birthday, :status, :post, :Salary, :email, :tel, :recrutment, :end_contract)";
        
        $result = $req->prepare($query);
        $result->bindParam(':matricule', $this -> matricule);
        $result->bindParam(':name', $this -> name);
        $result->bindParam(':lastname', $this -> lastname);
        $result->bindParam(':gender', $this -> gender);
        $result->bindParam(':birthday', $this -> birthday);
        $result->bindParam(':status', $this -> status);
        $result->bindParam(':post', $this -> post);
        $result->bindParam(':Salary', $this -> salary);
        $result->bindParam(':email', $this -> email);
        $result->bindParam(':tel', $this -> tel);
        $result->bindParam(':recrutment', $this -> recrutment);
        $result->bindParam(':end_contract', $this -> end);

        return $result->execute();
    }

}

?>
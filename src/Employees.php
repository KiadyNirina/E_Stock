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

}

?>
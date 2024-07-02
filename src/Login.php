<?php

namespace App;
use App\Bdd;

class Login{

    public $email;
    public $password;
    private $errors;

    public function __construct($email, $password)
    {
        $this -> email = $email;
        $this -> password = $password;
        $this -> errors = [];
    }

    public function isValid()
    {

        return header("location: index.php?page=home");

    }

    public function getError()
    {

        if(empty($this -> email)){
            $this -> errors['email'] = "Veuillez entrer l'adresse email";
            $this -> errors['global'] = "Veuillez remplir les champs s'il vous plait!";
        }

        if(empty($this -> password)){
            $this -> errors['password'] = "Veuillez entrer le mot de passe";
            $this -> errors['global'] = "Veuillez remplir les champs s'il vous plait!";
        }

        /*if(!empty($this -> email) && !empty($this -> password) && $this -> email != "kiady142ram@gmail.com" || $this -> password != "kiadynirina") {
            $this -> errors['global'] = "L'email ou le mot de passe n'est pas correcte";
        }*/

        if(!empty($this -> email) && !empty($this -> password)) {
            $conn = new Bdd();
            $result = $conn -> runOne('SELECT * FROM connexion');
            
            if( ($this -> email) === ($result -> email) && ($this -> password) === ($result -> password) ) {
                $_SESSION['id'] = $result -> id;
                header('locatio: index.php?page=home');
            } else {
                $this -> errors['global'] = "L'email ou le mot de passe n'est pas correcte";
            }
        }
        
        return $this -> errors;
    }

}

?>
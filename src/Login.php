<?php

namespace App;

class Login{

    public $email;
    public $password;

    public function __construct($email, $password)
    {
        $this -> email = $email;
        $this -> password = $password;
    }

    public function isValid()
    {
        return empty($this -> getError());
    }

    public function getError()
    {
        $error = [];
        if(empty($this -> email)){
            $error['email'] = "Veuillez entrer l'adresse email";
        }

        if(empty($this -> password)){
            $error['password'] = "Veuillez entrer le mot de passe";
        }

        if($this -> email != "kiady142ram@gmail.com" || $this -> password != "kiadynirina") {
            $error['global'] = "L'email ou le mot de passe n'est pas correcte";
        }
        
        return $error;
    }

}

?>
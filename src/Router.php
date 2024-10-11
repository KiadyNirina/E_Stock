<?php

namespace App;

class Router {

    public $viewPath;
    public $param;
    public $viewLogin;
    public $viewHome;
    public $viewEmployees;
    public $viewEmployeesMissing;
    public $content;

    public function __construct($viewPath, $param)
    {
        $this -> viewPath = $viewPath;   
        $this -> param = $param;
        $this -> viewLogin = scandir($this -> viewPath . DIRECTORY_SEPARATOR . 'login');
        $this -> viewHome = scandir($this -> viewPath . DIRECTORY_SEPARATOR . 'home' );
        $this -> viewEmployees = scandir($this -> viewPath . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'employees');
        $this -> viewEmployeesMissing = scandir($this -> viewPath . DIRECTORY_SEPARATOR . 'home' .DIRECTORY_SEPARATOR . 'employeesMiss');
    }

    public function get()
    {
        $page = $this -> param;

        if(!empty($page) && in_array($page.".php", $this -> viewLogin) && empty($_SESSION['id'])){

            return $this -> content = $this -> viewPath . DIRECTORY_SEPARATOR . 'login' . DIRECTORY_SEPARATOR . $page.'.php';
        
        }else if(!empty($page) && in_array($page.".php", $this -> viewHome) && !empty($_SESSION['id'])){
        
            return $this -> content = $this -> viewPath . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . $page.'.php';
        
        }else if(!empty($page) && in_array($page.".php", $this -> viewEmployees) && !empty($_SESSION['id'])){
        
            return $this -> content = $this -> viewPath . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'employees' . DIRECTORY_SEPARATOR . $page.'.php';
        
        }else if(!empty($page) && in_array($page.".php", $this -> viewEmployeesMissing) && !empty($_SESSION['id'])){
        
            return $this -> content = $this -> viewPath . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'employeesMiss' . DIRECTORY_SEPARATOR . $page.'.php';
        
        }else{
            return header("location: index.php?page=login");
        }

        return $this;
    }

}

?>
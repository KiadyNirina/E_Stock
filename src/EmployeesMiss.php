<?php

namespace App;
use App\Bdd;
use DateTime;
use DateTimeInterface;

class EmployeesMiss {

    public $date;
    public $missing;

    public function __construct($date, $missing)
    {
        $this -> date = $date;
        $this -> missing = $missing;
    }

    public function getError()
    {
        $error = [];
        if (empty($this -> date)) {
            $error['date'] = "Veuillez remplir la date"; 
        }

        if(!empty($this -> date) && !date_format($this -> date, 'yy-mm-dd')) {
            $error['date'] = "Ce format est incorrecte";
        }

        if (empty($this -> missing)) {
            $error['missing'] = "Veuillez listez les employées absents"; 
        }

        return $error;
    }

}

?>
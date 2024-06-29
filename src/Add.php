<?php

namespace App;

class Add {

    public $devis;
    public $equipement;
    public $configuration;
    public $prix_unit;
    public $quantite;
    public $fournisseur;
    public $date_commande;
    public $date_livraison;
    public $type;

    public function __construct($devis, $equipement, $configuration, $prix_unit, $quantite, $fournisseur, $date_commande, $date_livraison, $type)
    {
        $this -> devis = $devis;
        $this -> equipement = $equipement;
        $this -> configuration = $configuration;
        $this -> prix_unit = $prix_unit;
        $this -> quantite = $quantite;
        $this -> fournisseur = $fournisseur;
        $this -> date_commande = $date_commande;
        $this -> date_livraison = $date_livraison;
        $this -> type = $type;
    }

    public function getError()
    {
        $error = [];
        if(empty($this -> devis)) {
            $error['devis'] = " Veuillez remplir le numéro de devis "; 
        }

        if(empty($this -> equipement)) {
            $error['equipement'] = " Veuillez remplir le nom de l'équipement "; 
        }

        if(empty($this -> configuration)) {
            $error['configuration'] = " Veuillez remplir la configuration "; 
        }

        if(empty($this -> prix_unit)) {
            $error['prix_unit'] = " Veuillez remplir le prix unitaire "; 
        }

        if(!empty($this -> prix_unit) && !filter_var(($this -> prix_unit), FILTER_VALIDATE_INT)) {
            $error['prix_unit'] = " Ce prix n'est pas correcte "; 
        }

        if(empty($this -> quantite)) {
            $error['quantite'] = " Veuillez remplir la quantite de l'équipement "; 
        }

        if(empty($this -> fournisseur)) {
            $error['fournisseur'] = " Veuillez remplir le nom du fournisseur "; 
        }

        if(empty($this -> date_commande)) {
            $error['date_commande'] = " Veuillez remplir la date du commande "; 
        }

        return $error;
    }

    public function add()
    {
        return empty($this -> getError()) ;
    }

}

?>
<?php

namespace App;
use App\Bdd;

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
        $this->devis = $devis;
        $this->equipement = $equipement;
        $this->configuration = $configuration;
        $this->prix_unit = $prix_unit;
        $this->quantite = $quantite;
        $this->fournisseur = $fournisseur;
        $this->date_commande = $date_commande;
        $this->date_livraison = $date_livraison;
        $this->type = $type;
    }

    public function getError()
    {
        $error = [];
        if (empty($this->devis)) {
            $error['devis'] = "Veuillez remplir le numéro de devis"; 
        }

        if (empty($this->equipement)) {
            $error['equipement'] = "Veuillez remplir le nom de l'équipement"; 
        }

        if (empty($this->configuration)) {
            $error['configuration'] = "Veuillez remplir la configuration"; 
        }

        if (empty($this->prix_unit)) {
            $error['prix_unit'] = "Veuillez remplir le prix unitaire"; 
        }

        if (!empty($this->prix_unit) && !filter_var($this->prix_unit, FILTER_VALIDATE_FLOAT)) {
            $error['prix_unit'] = "Ce prix n'est pas correct"; 
        }

        if (empty($this->quantite)) {
            $error['quantite'] = "Veuillez remplir la quantité de l'équipement"; 
        }

        if (empty($this->fournisseur)) {
            $error['fournisseur'] = "Veuillez remplir le nom du fournisseur"; 
        }

        if (empty($this->date_commande)) {
            $error['date_commande'] = "Veuillez remplir la date de commande"; 
        }

        return $error;
    }

    public function add()
    {
        $pdo = new Bdd();
        $req = $pdo->connect();
        
        $query = "INSERT INTO entrées_sorties (devis, equipement, configuration, prix_unitaire, quantite, prix_total, fournisseur, commande, livraison, type) VALUES (:devis, :equipement, :configuration, :prix_unit, :quantite, :prix_total, :fournisseur, :commande, :livraison, :type)";
        
        $result = $req->prepare($query);
        $result->bindParam(':devis', $this -> devis);
        $result->bindParam(':equipement', $this -> equipement);
        $result->bindParam(':configuration', $this -> configuration);
        $result->bindParam(':prix_unit', $this -> prix_unit);
        $result->bindParam(':quantite', $this -> quantite);
        $prix_total = $this -> prix_unit * $this -> quantite;
        $result->bindParam(':prix_total', $prix_total);
        $result->bindParam(':fournisseur', $this -> fournisseur);
        $result->bindParam(':commande', $this -> date_commande);
        $result->bindParam(':livraison', $this -> date_livraison);
        $result->bindParam(':type', $this -> type);

        return $result->execute();
    }

    public function update($id)
    {
        $pdo = new Bdd();
        $req = $pdo->connect();

        $query = "UPDATE entrées_sorties SET devis = :devis, equipement = :equipement, configuration = :configuration, prix_unitaire = :prix_unit, 
                  quantite = :quantite, prix_total = :prix_total, fournisseur = :fournisseur, commande = :commande, livraison = :livraison, type = :type
                  WHERE id = :id";

        $result = $req->prepare($query);
        $result->bindParam(':devis', $this -> devis);
        $result->bindParam(':equipement', $this -> equipement);
        $result->bindParam(':configuration', $this -> configuration);
        $result->bindParam(':prix_unit', $this -> prix_unit);
        $result->bindParam(':quantite', $this -> quantite);
        $prix_total = $this -> prix_unit * $this -> quantite;
        $result->bindParam(':prix_total', $prix_total);
        $result->bindParam(':fournisseur', $this -> fournisseur);
        $result->bindParam(':commande', $this -> date_commande);
        $result->bindParam(':livraison', $this -> date_livraison);
        $result->bindParam(':type', $this -> type);
        // Assuming 'id' is a property of the class
        $result->bindParam(':id', $id);

        return $result->execute();
    }

    public function delete($id)
    {
        $pdo = new Bdd();
        $req = $pdo->connect();

        $query = "DELETE FROM entrées_sorties WHERE id = :id";
        
        $result = $req -> prepare($query);
        $result -> bindParam(':id', $id);

        return $result -> execute();
    }

}
?>

<?php

use App\Bdd;
use App\Add;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    // Exécution d'une requête
    $getId = htmlentities($_GET['id']);
    $result = $conn -> runOne("SELECT * FROM entrées_sorties WHERE id = $getId");

    //Récupération du valeur des champs
    @$devis = htmlentities($_POST['devis']);
    @$equipement = htmlentities($_POST['equipement']);
    @$configuration = htmlentities($_POST['conf']);
    @$prix_unit = htmlentities($_POST['prix_unitaire']);
    @$quantite = htmlentities($_POST['quantite']);
    @$prix_total = (int)$prix_unit * (int)$quantite;
    @$fournisseur = htmlentities($_POST['fournisseur']);
    @$date_commande = htmlentities($_POST['commande']);
    @$date_livraison = htmlentities($_POST['livraison']);
    @$type = htmlentities($_POST['type']);
    @$submit = htmlentities($_POST['add']);

    $add = new Add($devis, $equipement, $configuration, $prix_unit, $quantite, $fournisseur, $date_commande, $date_livraison, $type);

    $add -> delete($getId);


?>

<div class="deleteContainer">
    <h2 class="success">
        Suppression avec succès !
    </h2>
    <a href="index.php?page=home">Retour vers la page d'accueil</a>
</div>

<?php

}

?>
<?php

use App\Bdd;
use App\Add;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    // Exécution d'une requête
    $results = $conn -> run("SELECT DISTINCT(type) FROM entrées_sorties");

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

?>

<div class="authContainer">
        <form action="" method="post">
            <?php

            if( isset($submit) ) {

                if(empty($add -> getError())) {
                    $query = "INSERT INTO entrées_sorties(devis, equipement, configuration, prix_unitaire, quantite, prix_total, fournisseur, commande, livraison, type) VALUES ('$devis', '$equipement', '$configuration', '$prix_unit', '$quantite', '$prix_total', '$fournisseur', '$date_commande', '$date_livraison', '$type')";
                    $add -> add($query);
                    
                    ?>
                        <b class="success">Ajout avec succès</b>      
                    <?php
                
                } else {
                    $error = $add -> getError();
                }
        
            }
            
            ?>
            <h2>Ajout de nouveau équipement</h2>
            <input <?php if(!empty($error['devis'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="devis" placeholder="N° devis">
            <?php if(!empty($error['devis'])) {?>
                <p class="smallError"><?php echo $error['devis'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['equipement'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="equipement" placeholder="Nom de l'équipement">
            <?php if(!empty($error['equipement'])) {?>
                <p class="smallError"><?php echo $error['equipement'] ?></p>
            <?php } ?>

            <textarea <?php if(!empty($error['configuration'])): ?> style="border: 1px solid coral;" <?php endif ?> name="conf" id="" placeholder="Configuration"></textarea>
            <?php if(!empty($error['configuration'])) {?>
                <p class="smallError"><?php echo $error['configuration'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['prix_unit'])): ?> style="border: 1px solid coral;" <?php endif ?> type="number" name="prix_unitaire" id="" placeholder="Prix unitaire"> Ariary
            <?php if(!empty($error['prix_unit'])) {?>
                <p class="smallError"><?php echo $error['prix_unit'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['quantite'])): ?> style="border: 1px solid coral;" <?php endif ?> type="number" name="quantite" placeholder="Nombre de l'équipement">
            <?php if(!empty($error['quantite'])) {?>
                <p class="smallError"><?php echo $error['quantite'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['fournisseur'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="fournisseur" placeholder="Fournisseur">
            <?php if(!empty($error['fournisseur'])) {?>
                <p class="smallError"><?php echo $error['fournisseur'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['date_commande'])): ?> style="border: 1px solid coral;" <?php endif ?> type="date" name="commande" id="">
            <?php if(!empty($error['date_commande'])) {?>
                <p class="smallError"><?php echo $error['date_commande'] ?></p>
            <?php } ?>

            <input type="date" name="livraison" id="">
            
            <select name="type" id="">
                <?php foreach ( $results as $result ) { ?>
                <option value="<?php echo $result -> type ?>">
                    <?php echo $result -> type ?>
                </option>
                <?php } ?>
            </select>

            <button type="submit" name="add">Ajouter</button>
        </form>
</div>

<?php

}

?>
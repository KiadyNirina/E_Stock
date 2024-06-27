<?php

use App\Bdd;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    // Exécution d'une requête
    $results = $conn -> run("SELECT DISTINCT(type) FROM entrées_sorties");

?>

<div class="content">
    <div class="content-body">
        <form action="" method="post">
            <input type="text" placeholder="N° devis">
            <input type="text" placeholder="Nom de l'équipement">
            <textarea name="" id="" placeholder="Configuration"></textarea>
            <input type="number" name="" id="" placeholder="Prix unitaire"> Ariary
            <input type="number" placeholder="Nombre de l'équipement">
            <input type="text" placeholder="Fournisseur">
            <input type="date" name="" id="">
            <input type="date" name="" id="">
            <select name="" id="">
                <?php foreach ( $results as $result ) { ?>
                <option value="">
                    <?php echo $result -> type ?>
                </option>
                <?php } ?>
            </select>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</div>

<?php

}

?>
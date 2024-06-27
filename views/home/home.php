<?php

use App\Bdd;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    // Exécution d'une requête
    $results = $conn -> run("SELECT * FROM entrées_sorties");

    $inputSearch = htmlentities($_POST['searchI']);

    $query = "SELECT * FROM entrées_sorties WHERE devis LIKE :searchTerm OR equipement LIKE :searchTerm";
    $resultSearch = $conn -> search($query, $inputSearch);

?>

<div class="content">
    <div class="table">
        <div class="nav">
            <div class="menu">
                <a href="">Logo</a>
                <a href=""><img src="../../static/img/icons/accueil.png" alt=""></a>
                <form id="formSearch" action="" method="POST">
                    <input id="search" type="search" name="searchI" id="" placeholder="Entrer le numéro de devis ou le nom de l'équipement">
                </form>
                <a href=""><img src="../../static/img/icons/profile.png" alt=""></a>
                <a href=""><img src="../../static/img/icons/menu.png" alt=""></a>
            </div>
        </div>
        
        <hr>
        
        <div class="">
            <ul>
                <li><b>Nombres des équipements total : </b>200</li>
                <li><b>Prix total : </b><?php 
                    $result = $conn -> run("SELECT SUM(prix_total) AS total FROM entrées_sorties");
                    foreach ( $result as $re ){
                        echo $re -> total;
                    }
                ?> ariary</li>
                <li><b>Total des équipements entrées : </b><?php 
                    $count = $conn -> numRows("SELECT type FROM entrées_sorties WHERE type = 'Entrée'");
                    echo $count;
                ?></li>
                <li><b>Total des équipements sorties : </b><?php 
                    $count = $conn -> numRows("SELECT type FROM entrées_sorties WHERE type = 'Sortie'");
                    echo $count;
                ?></li>
            </ul>
            <div class="add">
                <a href="index.php?page=add">
                    <img src="../../static/img/icons/ajouter.png" alt="">
                    <span>Ajouter</span>
                </a>
            </div>
        </div>

        <hr>

        <table>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">N° devis</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Configuration</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Prix Total</th>
                    <th scope="col">Fournisseur</th>
                    <th scope="col">Date du commande</th>
                    <th scope="col">Date de livraison</th>
                    <th scope="col">Etat</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            
                if( !$resultSearch )
                {   
                   // Affichage des résultats
                        foreach ($results as $row) {

                            ?>
                            <tr>
                                <td><?php echo $row -> id ?></td>
                                <td><?php echo $row -> devis ?></td>
                                <td><?php echo $row -> equipement ?></td>
                                <td id="conf"><?php echo $row -> configuration ?></td>
                                <td><?php echo $row -> prix_unitaire . " ariary" ?></td>
                                <td><?php echo $row -> quantité ?></td>
                                <td><?php echo $row -> prix_total . " ariary" ?></td>
                                <td><?php echo $row -> fournisseur ?></td>
                                <td><?php echo $row -> commande ?></td>
                                <td><?php echo $row -> livraison ?></td>
                                <td><?php echo $row -> type ?></td>
                                <td><a href="a"><img src="/static/img/icons/modifier.png" alt=""></a> <a href="b"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                            </tr>
                            <?php

                        }
                } else {

                    foreach ($resultSearch as $reSe) {

                        ?>
                        <tr>
                            <td><?php echo $reSe -> id ?></td>
                            <td><?php echo $reSe -> devis ?></td>
                            <td><?php echo $reSe -> equipement ?></td>
                            <td id="conf"><?php echo $reSe -> configuration ?></td>
                            <td><?php echo $reSe -> prix_unitaire . " ariary" ?></td>
                            <td><?php echo $reSe -> quantité ?></td>
                            <td><?php echo $reSe -> prix_total . " ariary" ?></td>
                            <td><?php echo $reSe -> fournisseur ?></td>
                            <td><?php echo $reSe -> commande ?></td>
                            <td><?php echo $reSe -> livraison ?></td>
                            <td><?php echo $reSe -> type ?></td>
                            <td><a href="a"><img src="/static/img/icons/modifier.png" alt=""></a> <a href="b"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                        </tr>
                        <?php

                    }

                }
                    
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
} else {
    echo 'Erreur de connexion';
}
?>
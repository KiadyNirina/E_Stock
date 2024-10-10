<?php

use App\Bdd;

$conn = new Bdd();

if($conn -> connect()){

    // Exécution d'une requête
    $results = $conn -> run("SELECT * FROM entrées_sorties");

    @$inputSearch = htmlentities($_POST['search']);
    @$filter = htmlentities($_GET['filter']);

    $query = "SELECT * FROM entrées_sorties WHERE devis LIKE :searchTerm OR equipement LIKE :searchTerm";
    $resultSearch = $conn -> search($query, $inputSearch);

?>

<div class="content">
    <div class="table">
        <?php require 'nav.php' ?>
        
        <hr>
        
        <div class="">
            <ul>
                <li><b>Nombres des équipements total : </b><?php 
                    $count = $conn -> numRows("SELECT DISTINCT(equipement) FROM entrées_sorties");
                    echo $count;
                ?></li>
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

        <hr><br>

        <?php
        
        if(isset($filter) && !empty($filter))
        {
            ?>
            <p>Filtré par <b><?php echo $filter ?></b></p>
            <?php
        }

        ?>

        <table>
            <thead>
                <tr>
                    <th scope="col"><a href="index.php?page=home&filter=id">id</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=devis">N° devis</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=equipement">Equipement</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=configuration">Configuration</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_unitaire">Prix unitaire</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=quantite">Quantités</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_total">Prix Total</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=fournisseur">Fournisseur</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=commande">Date du commande</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=livraison">Date de livraison</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=type">Type</a></th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    if(isset($inputSearch) && !empty($inputSearch)){
                        
                        if (isset($filter) && !empty($filter)) {

                            $searchFilterByParam = $conn -> search($query." ORDER BY $filter ASC", $inputSearch);
                            
                            foreach ($searchFilterByParam as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> id ?></td>
                                    <td><?php echo $result -> devis ?></td>
                                    <td><?php echo $result -> equipement ?></td>
                                    <td id="conf"><?php echo $result -> configuration ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantite ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="index.php?page=edit&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        } else {

                            foreach ($resultSearch as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> id ?></td>
                                    <td><?php echo $result -> devis ?></td>
                                    <td><?php echo $result -> equipement ?></td>
                                    <td id="conf"><?php echo $result -> configuration ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantite ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="index.php?page=edit&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        }

                    } else {
                        
                        if (isset($filter) && !empty($filter)) {

                            $filterByParam = $conn -> run("SELECT * FROM entrées_sorties ORDER BY $filter ASC");
                            foreach ($filterByParam as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> id ?></td>
                                    <td><?php echo $result -> devis ?></td>
                                    <td><?php echo $result -> equipement ?></td>
                                    <td id="conf"><?php echo nl2br($result -> configuration) ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantite ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="index.php?page=edit&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        } else {

                            foreach ($results as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> id ?></td>
                                    <td><?php echo $result -> devis ?></td>
                                    <td><?php echo $result -> equipement ?></td>
                                    <td id="conf"><?php echo nl2br($result -> configuration) ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantite ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="index.php?page=edit&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

} else {

    ?>

    <h1>Erreur de connexion</h1>

    <?php    

}
?>
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
        <?php require '../views/home/nav.php' ?>
        
        <hr>
        
        <div class="">
            <ul>
                <li><b>Nombres total des employées : </b>200</li>
                <li><b>Administrateur réseau : </b><?php 
                    $count = $conn -> numRows("SELECT type FROM entrées_sorties WHERE type = 'Entrée'");
                    echo $count;
                ?></li>
                <li><b>Administrateur Système : </b><?php 
                    $count = $conn -> numRows("SELECT type FROM entrées_sorties WHERE type = 'Sortie'");
                    echo $count;
                ?></li>
                <li><b>Développeur Web : </b><?php 
                    $count = $conn -> numRows("SELECT type FROM entrées_sorties WHERE type = 'Sortie'");
                    echo $count;
                ?></li>
                <li><b>Comptable : </b><?php 
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
                    <th scope="col"><a href="index.php?page=home&filter=id">N° matricule</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=devis">Photo</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=equipement">Nom</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=configuration">Prénom</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_unitaire">Date de naissance</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=livraison">Situation familiale</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=quantite">Poste</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_total">Salaire</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=fournisseur">Date de recrutement</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=commande">Date de fin contrat</a></th>
                    <th scope="col">action</th>
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
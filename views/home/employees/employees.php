<?php

use App\Bdd;

$conn = new Bdd();

if($conn -> connect()){

    // Exécution d'une requête
    $results = $conn -> run("SELECT * FROM employees");

    @$inputSearch = htmlentities($_POST['search']);
    @$filter = htmlentities($_GET['filter']);

    $query = "SELECT * FROM employees WHERE matricule LIKE :searchTerm OR name LIKE :searchTerm OR lastname LIKE :searchTerm";
    $resultSearch = $conn -> search($query, $inputSearch);

?>

<div class="content">
    <div class="table">
        <?php require '../views/home/nav.php' ?>
        
        <hr>
        
        <div class="">
            <ul>
                <li><b>Nombres total des employées : </b><?php 
                        $count = $conn -> numRows("SELECT * FROM employees");
                        echo $count;
                    ?></li>
                <li><b>Nombres total des postes : </b><?php 
                        $count = $conn -> numRows("SELECT DISTINCT(post) FROM employees");
                        echo $count;
                    ?></li>
                <li><b>Salaire total : </b><?php 
                    $count = $conn -> run("SELECT SUM(Salary) AS total FROM employees");
                    foreach($count as $cou) {
                        echo $cou -> total;
                    }
                ?> Ar</li>
            </ul>
            <div class="add">
                <a href="index.php?page=add_employees">
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
                    <th scope="col"><a href="index.php?page=home&filter=configuration">Sexe</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_unitaire">Date de naissance</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=livraison">Situation familiale</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=quantite">Poste</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_total">Salaire</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_total">Email</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=prix_total">Tel</a></th>
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
                                    <td><?php echo $result -> matricule ?></td>
                                    <td><?php echo $result -> picture ?></td>
                                    <td><?php echo $result -> name ?></td>
                                    <td><?php echo $result -> lastname ?></td>
                                    <td><?php echo $result -> gender ?></td>
                                    <td><?php echo $result -> birthday ?></td>
                                    <td><?php echo $result -> status ?></td>
                                    <td><?php echo $result -> post ?></td>
                                    <td><?php echo $result -> Salary . " ariary" ?></td>
                                    <td><?php echo $result -> email ?></td>
                                    <td><?php echo $result -> tel ?></td>
                                    <td><?php echo $result -> recrutment ?></td>
                                    <td><?php echo $result -> end_contract ?></td>
                                    <td><a href="index.php?page=edit_employees&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        } else {

                            foreach ($resultSearch as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> matricule ?></td>
                                    <td><?php echo $result -> picture ?></td>
                                    <td><?php echo $result -> name ?></td>
                                    <td><?php echo $result -> lastname ?></td>
                                    <td><?php echo $result -> gender ?></td>
                                    <td><?php echo $result -> birthday ?></td>
                                    <td><?php echo $result -> status ?></td>
                                    <td><?php echo $result -> post ?></td>
                                    <td><?php echo $result -> Salary . " ariary" ?></td>
                                    <td><?php echo $result -> email ?></td>
                                    <td><?php echo $result -> tel ?></td>
                                    <td><?php echo $result -> recrutment ?></td>
                                    <td><?php echo $result -> end_contract ?></td>
                                    <td><a href="index.php?page=edit_employees&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        }

                    } else {
                        
                        if (isset($filter) && !empty($filter)) {

                            $filterByParam = $conn -> run("SELECT * FROM employees ORDER BY $filter ASC");
                            foreach ($filterByParam as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> matricule ?></td>
                                    <td><?php echo $result -> picture ?></td>
                                    <td><?php echo $result -> name ?></td>
                                    <td><?php echo $result -> lastname ?></td>
                                    <td><?php echo $result -> gender ?></td>
                                    <td><?php echo $result -> birthday ?></td>
                                    <td><?php echo $result -> status ?></td>
                                    <td><?php echo $result -> post ?></td>
                                    <td><?php echo $result -> Salary . " ariary" ?></td>
                                    <td><?php echo $result -> email ?></td>
                                    <td><?php echo $result -> tel ?></td>
                                    <td><?php echo $result -> recrutment ?></td>
                                    <td><?php echo $result -> end_contract ?></td>
                                    <td><a href="index.php?page=edit_employees&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir la supprimer?')" href="index.php?page=delete&id=<?php echo $result -> id ?>"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        } else {

                            foreach ($results as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> matricule ?></td>
                                    <td><?php echo $result -> picture ?></td>
                                    <td><?php echo $result -> name ?></td>
                                    <td><?php echo $result -> lastname ?></td>
                                    <td><?php echo $result -> gender ?></td>
                                    <td><?php echo $result -> birthday ?></td>
                                    <td><?php echo $result -> status ?></td>
                                    <td><?php echo $result -> post ?></td>
                                    <td><?php echo $result -> Salary . " ariary" ?></td>
                                    <td><?php echo $result -> email ?></td>
                                    <td><?php echo $result -> tel ?></td>
                                    <td><?php echo $result -> recrutment ?></td>
                                    <td><?php echo $result -> end_contract ?></td>
                                    <td><a href="index.php?page=edit_employees&id=<?php echo $result -> id ?>"><img src="/static/img/icons/modifier.png" alt=""></a> 
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
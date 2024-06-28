<?php

use App\Bdd;

$conn = new Bdd();

if($conn -> connect()){

    // Exécution d'une requête
    $results = $conn -> run("SELECT * FROM entrées_sorties");

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
                    <th scope="col"><a href="index.php?page=home&param=id">id</a></th>
                    <th scope="col"><a href="index.php?page=home&param=devis">N° devis</a></th>
                    <th scope="col"><a href="index.php?page=home&param=equipement">Nom</a></th>
                    <th scope="col"><a href="index.php?page=home&param=configuration">Configuration</a></th>
                    <th scope="col"><a href="index.php?page=home&param=prix_untaire">Prix unitaire</a></th>
                    <th scope="col"><a href="index.php?page=home&param=quantité">Nombres</a></th>
                    <th scope="col"><a href="index.php?page=home&param=prix_total">Prix Total</a></th>
                    <th scope="col"><a href="index.php?page=home&param=fournisseur">Fournisseur</a></th>
                    <th scope="col"><a href="index.php?page=home&param=commande">Date du commande</a></th>
                    <th scope="col"><a href="index.php?page=home&param=livraison">Date de livraison</a></th>
                    <th scope="col"><a href="index.php?page=home&param=type">Etat</a></th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    @$inputSearch = htmlentities($_POST['searchI']);
                    @$param = htmlentities($_GET['param']);

                    $query = "SELECT * FROM entrées_sorties WHERE devis LIKE :searchTerm OR equipement LIKE :searchTerm";
                    $resultSearch = $conn -> search($query, $inputSearch);

                    if(isset($inputSearch) && !empty($inputSearch)){
                        
                        if (isset($param) && !empty($param)) {

                            $searchFilterByParam = $conn -> search($query." ORDER BY $param DESC", $inputSearch);
                            
                            foreach ($searchFilterByParam as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> id ?></td>
                                    <td><?php echo $result -> devis ?></td>
                                    <td><?php echo $result -> equipement ?></td>
                                    <td id="conf"><?php echo $result -> configuration ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantité ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="a"><img src="/static/img/icons/modifier.png" alt=""></a> <a href="b"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
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
                                    <td><?php echo $result -> quantité ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="a"><img src="/static/img/icons/modifier.png" alt=""></a> <a href="b"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
                                </tr>
                                <?php
                            }

                        }

                    } else {
                        
                        if (isset($param) && !empty($param)) {

                            $filterByParam = $conn -> run("SELECT * FROM entrées_sorties ORDER BY $param DESC");
                            foreach ($filterByParam as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> id ?></td>
                                    <td><?php echo $result -> devis ?></td>
                                    <td><?php echo $result -> equipement ?></td>
                                    <td id="conf"><?php echo $result -> configuration ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantité ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="a"><img src="/static/img/icons/modifier.png" alt=""></a> <a href="b"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
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
                                    <td id="conf"><?php echo $result -> configuration ?></td>
                                    <td><?php echo $result -> prix_unitaire . " ariary" ?></td>
                                    <td><?php echo $result -> quantité ?></td>
                                    <td><?php echo $result -> prix_total . " ariary" ?></td>
                                    <td><?php echo $result -> fournisseur ?></td>
                                    <td><?php echo $result -> commande ?></td>
                                    <td><?php echo $result -> livraison ?></td>
                                    <td><?php echo $result -> type ?></td>
                                    <td><a href="a"><img src="/static/img/icons/modifier.png" alt=""></a> <a href="b"><img src="/static/img/icons/supprimer.png" alt=""></a></td>
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
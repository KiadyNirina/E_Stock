<?php

use App\Bdd;


// Définition des paramètres de connexion
$dsn = "mysql:host=localhost;dbname=gestion_de_stock";
$username = "root";
$password = "";


// Création d'une instance de la classe de connexion
$db = new Bdd($dsn, $username, $password);


// Connexion à la base de données
if ( $db -> connect() ) {

    // Récupération de l'objet PDO
    $pdo = $db -> getPDO();

    // Exécution d'une requête
    $stmt = $pdo -> prepare("SELECT * FROM entrées_sorties");
    $stmt -> execute();
    $result = $stmt -> fetchAll(PDO::FETCH_OBJ);

?>

<div class="content">
    <div class="table">
        <div class="nav">
            <div class="menu">
                <a href="">Logo</a>
                <a href=""><img src="../../static/img/icons/accueil.png" alt=""></a>
                <form id="formSearch" action="" method="post">
                    <input id="search" type="search" name="" id="" placeholder="Entrer le numéro de devis ou le nom de l'équipement">
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
                    $stmts = $pdo -> prepare("SELECT SUM(prix_total) AS total FROM entrées_sorties");
                    $stmts -> execute();
                    $resultat = $stmts -> fetch(PDO::FETCH_OBJ);

                    echo $resultat -> total;
                ?> ariary</li>
                <li><b>Total des équipements entrées : </b><?php 
                    $stmts = $pdo -> prepare("SELECT type FROM entrées_sorties WHERE type = 'Entrée'");
                    $stmts -> execute();
                    $count = $stmts -> rowCount();

                    echo $count;
                ?></li>
                <li><b>Total des équipements sorties : </b><?php 
                    $stmts = $pdo -> prepare("SELECT type FROM entrées_sorties WHERE type = 'Sortie'");
                    $stmts -> execute();
                    $count = $stmts -> rowCount();

                    echo $count;
                ?></li>
            </ul>
            <div class="add">
                <a href="">
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
                
                    // Affichage des résultats
                    foreach ($result as $row) {

                        ?>
                        <tr>
                            <td><?php echo $row -> id ?></td>
                            <td><?php echo $row -> devis ?></td>
                            <td><?php echo $row -> equipement ?></td>
                            <td><?php echo $row -> configuration ?></td>
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
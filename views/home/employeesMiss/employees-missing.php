<?php

use App\Bdd;

$conn = new Bdd();

if($conn -> connect()){

    // Exécution d'une requête
    $results = $conn -> run("SELECT * FROM employees_missing");

    @$inputSearch = htmlentities($_POST['search']);
    @$filter = htmlentities($_GET['filter']);

    $query = "SELECT * FROM employees_missing WHERE date LIKE :searchTerm";
    $resultSearch = $conn -> search($query, $inputSearch);

?>

<div class="content">
    <div class="table">
        <?php require '../views/home/nav.php' ?>

        <hr>
        
        <div class="">
            <div class="add">
                <a href="index.php?page=add_employees_missing">
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
                    <th scope="col"><a href="index.php?page=home&filter=id">Date</a></th>
                    <th scope="col"><a href="index.php?page=home&filter=devis">Absents</a></th>
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

                                </tr>
                                <?php
                            }

                        } else {

                            foreach ($resultSearch as $result){
                                ?>
                                <tr>

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

                                </tr>
                                <?php
                            }

                        } else {

                            foreach ($results as $result){
                                ?>
                                <tr>
                                    <td><?php echo $result -> date ?></td>
                                    <td><?php echo $result -> missing ?></td>
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
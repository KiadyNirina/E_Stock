<?php

use App\Bdd;
use App\Employees;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    //Récupération du valeur des champs
    @$date = htmlentities($_POST['date']);
    @$missing = htmlentities($_POST['missing']);
    @$submit = htmlentities($_POST['add']);

    @$employeesMiss = new EmployeesMiss($date, $absents);

?>

<div class="authContainer">
        <form class="form" action="" method="post">
            <?php

            if( isset($submit) ) {

                if(empty($employeesMiss -> getError())) {
                    
                    $employeesMiss -> add();
                    
                    ?>
                        <b class="success">Ajout avec succès</b>      
                    <?php
                
                } else {
                    $error = $employeesMiss -> getError();

                    ?>
                        <b class="error">Erreur</b>      
                    <?php
                }
        
            }
            
            ?>
            <h2>Ajout de nouveau employé</h2>
            <input <?php if(!empty($error['date'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="date" placeholder="Date d'aujourd'hui">
            <?php if(!empty($error['date'])) {?>
                <p class="smallError"><?php echo $error['date'] ?></p>
            <?php } ?>

            <textarea <?php if(!empty($error['missing'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="missing" placeholder="Nom des employé(e)s"></textarea>
            <?php if(!empty($error['missing'])) {?>
                <p class="smallError"><?php echo $error['missing'] ?></p>
            <?php } ?>

            <button type="submit" name="add">Ajouter</button>
            <a href="index.php?page=employees-missing">Annuler</a>
        </form>
</div>

<?php

}

?>
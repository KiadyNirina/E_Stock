<?php

use App\Bdd;
use App\Employees;
use App\EmployeesMiss;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    $getId = htmlentities($_GET['id']);
    $result = $conn -> runOne("SELECT * FROM employees_missing WHERE id = $getId");

    //Récupération du valeur des champs
    @$missing = htmlentities($_POST['missing']);
    @$submit = htmlentities($_POST['add']);

    @$employees = new EmployeesMiss($missing);

?>

<div class="authContainer">
        <form class="form" action="" method="post">
            <?php

            if( isset($submit) ) {

                if(empty($employees -> getError())) {
                    
                    $employees -> update($getId);
                    
                    ?>
                        <b class="success">Modification avec succès</b>      
                    <?php
                
                } else {
                    $error = $employees -> getError();

                    ?>
                        <b class="error">Erreur</b>      
                    <?php
                }
        
            }
            
            ?>
            <h2>Modification de donnée</h2>
            <p style="font-size: 12px;">Le <?php echo $result -> date?></p>
            <textarea <?php if(!empty($error['missing'])): ?> style="border: 1px solid coral;" <?php endif ?> name="missing" placeholder="Nom des employé(e)s"><?php echo $result -> missing?></textarea>
            <?php if(!empty($error['missing'])) {?>
                <p class="smallError"><?php echo $error['missing'] ?></p>
            <?php } ?>

            <button type="submit" name="add">Modifier</button>
            <a href="index.php?page=employees-missing">Annuler</a>
        </form>
</div>

<?php

}

?>
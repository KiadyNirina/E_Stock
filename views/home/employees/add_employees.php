<?php

use App\Bdd;
use App\Employees;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    //Récupération du valeur des champs
    @$matricule = htmlentities($_POST['matricule']);
    @$name = htmlentities($_POST['name']);
    @$lastname = htmlentities($_POST['lastname']);
    @$gender = htmlentities($_POST['gender']);
    @$birthday = htmlentities($_POST['birthday']);
    @$status = htmlentities($_POST['status']);
    @$post = htmlentities($_POST['post']);
    @$salary = htmlentities($_POST['salary']);
    @$email = htmlentities($_POST['email']);
    @$tel = htmlentities($_POST['tel']);
    @$recrutment = htmlentities($_POST['recrutment']);
    @$end = htmlentities($_POST['end']);
    @$submit = htmlentities($_POST['add']);

    @$employees = new Employees($matricule, $name, $lastname, $gender, $birthday, $status, $post, $salary, $email, $tel, $recrutment, $end);

?>

<div class="authContainer">
        <form class="form" action="" method="post">
            <?php

            if( isset($submit) ) {

                if(empty($employees -> getError())) {
                    
                    $employees -> add();
                    
                    ?>
                        <b class="success">Ajout avec succès</b>      
                    <?php
                
                } else {
                    $error = $employees -> getError();

                    ?>
                        <b class="error">Erreur</b>      
                    <?php
                }
        
            }
            
            ?>
            <h2>Ajout de nouveau employé</h2>
            <input <?php if(!empty($error['matricule'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="matricule" placeholder="N° matricule">
            <?php if(!empty($error['matricule'])) {?>
                <p class="smallError"><?php echo $error['matricule'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['name'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="name" placeholder="Nom de l'employé(e)">
            <?php if(!empty($error['name'])) {?>
                <p class="smallError"><?php echo $error['name'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['lastname'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="lastname" id="" placeholder="Prénom de l'employé(e)">
            <?php if(!empty($error['lastname'])) {?>
                <p class="smallError"><?php echo $error['lastname'] ?></p>
            <?php } ?>

            <select name="gender" id="">
                <option disabled value="">Séléctionnez votre sexe</option>
                <option value="H">Homme</option>
                <option value="F">Femme</option>
            </select>

            <input <?php if(!empty($error['birthday'])): ?> style="border: 1px solid coral;" <?php endif ?> type="date" name="birthday" placeholder="Date de naissance">
            <?php if(!empty($error['birthday'])) {?>
                <p class="smallError"><?php echo $error['birthday'] ?></p>
            <?php } ?>

            <select name="status" id="">
                <option value="" disabled>Séléctionnez sa situation familiale</option>
                <option value="single">Célibataire</option>
                <option value="maried">Marié(e)</option>
                <option value="divorced">Divorcé(e)</option>
                <option value="widower">Veuf(ve)</option>
            </select>

            <input <?php if(!empty($error['post'])): ?> style="border: 1px solid coral;" <?php endif ?> type="text" name="post" id="" placeholder="Entrez son poste">
            <?php if(!empty($error['post'])) {?>
                <p class="smallError"><?php echo $error['post'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['salary'])): ?> style="border: 1px solid coral;" <?php endif ?> type="number" name="salary" id="" placeholder="Entrez son salaire monsuel"> Ariary
            <?php if(!empty($error['salary'])) {?>
                <p class="smallError"><?php echo $error['salary'] ?></p>
            <?php } ?>
            
            <input <?php if(!empty($error['email'])): ?> style="border: 1px solid coral;" <?php endif ?> type="email" name="email" placeholder="Etrez son email">
            <?php if(!empty($error['email'])) {?>
                <p class="smallError"><?php echo $error['email'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['tel'])): ?> style="border: 1px solid coral;" <?php endif ?> type="number" name="tel" id="" placeholder="Entrer son tel">
            <?php if(!empty($error['tel'])) {?>
                <p class="smallError"><?php echo $error['tel'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['recrutment'])): ?> style="border: 1px solid coral;" <?php endif ?> type="date" name="recrutment" id="">
            <?php if(!empty($error['recrutment'])) {?>
                <p class="smallError"><?php echo $error['recrutment'] ?></p>
            <?php } ?>

            <input <?php if(!empty($error['end'])): ?> style="border: 1px solid coral;" <?php endif ?> type="date" name="end" id="">
            <?php if(!empty($error['end'])) {?>
                <p class="smallError"><?php echo $error['end'] ?></p>
            <?php } ?>

            <button type="submit" name="add">Ajouter</button>
            <a href="index.php?page=employees">Annuler</a>
        </form>
</div>

<?php

}

?>
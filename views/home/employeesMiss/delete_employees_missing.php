<?php

use App\Bdd;
use App\EmployeesMiss;

$conn = new Bdd();

// Connexion à la base de données
if ( $conn -> connect() ) {

    // Exécution d'une requête
    $getId = htmlentities($_GET['id']);
    $result = $conn -> runOne("SELECT * FROM employees_missing WHERE id = $getId");

    //Récupération du valeur des champs
    @$missing = htmlentities($_POST['missing']);
    
    $add = new EmployeesMiss($missing);

    $add -> delete($getId);


?>

<div class="deleteContainer">
    <h2 class="success">
        Suppression avec succès !
    </h2>
    <a href="index.php?page=employees-missing">Retour vers la page d'accueil</a>
</div>

<?php

}

?>
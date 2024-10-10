<div class="nav">
            <div class="menu">
                <a href="">Logo</a>
                <a href=""><img src="../../static/img/icons/accueil.png" alt=""></a>
                <a href="index.php?page=employees"><img src="../../static/img/icons/employees.png" alt=""></a>
                <a href="index.php?page=home"><img src="../../static/img/icons/equipement.png" alt=""></a>
                <form id="formSearch" action="" method="post">
                    <?php if($param == 'home') { ?>
                        <input id="search" type="search" name="search" placeholder="Entrer le numéro de devis ou le nom de l'équipement">
                    <?php } else { ?>
                        <input id="search" type="search" name="search" placeholder="Entrer le numéro de matricule ou le nom de l'employée">
                    <?php } ?>
                </form>
                <a href=""><img src="../../static/img/icons/profile.png" alt=""></a>
                <a href=""><img src="../../static/img/icons/parametre.png" alt=""></a>
                <a onclick="return confirm('Êtes-vous sûr de vouloir vous déconnectez ?')" href="index.php?page=logout"><img src="../../static/img/icons/logout.png" alt=""></a>
            </div>
        </div>
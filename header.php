<?php 
require_once('fonction.php');
?>
<!DOCTYPE html>
<html>
<header>
    <div class="home">
    <a href="accueil.php"><img class="home" src="image/home22.png"></a>
</div>
    <div class="titre">
        <h1>Touch Some Grass</h1>
    </div>
    <div class="profile"><h2>
<?php estConnecte()?></h2>
</div>
</header> 
<!-- Pas de </html> car il se trouve à la fin de chaque autre fichier(accueil.php,profil.php, etc...). Ces même fichier n'on pas <!DOCTYPE html> car ils sont dans ce fichier<html> -->


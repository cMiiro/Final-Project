<?php 
require_once('fonction.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
    </head>
<body>
<?php
$hash = '$2y$10$qWGGpITvBXHnKGOjn68SxeR'; // hash stocké en base de données
$mdp = 'mdpp'; // mot de passe entré par l'utilisateur

if (password_verify($mdp, $hash)) {
    echo 'Le mot de passe est valide !';
} else {
    echo 'Le mot de passe est invalide.';
}?>

   </body>
</html>
<?php 
require_once('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="supprimer.css">
<meta charset="ufr-8">
    </head>
<body>
    
<?php
//vérifions que celui sur la page est bien modérateur
if(estModo($_SESSION["user"])===true){
    if(isset($_POST['delete'])){
        $id=$_GET["com"];
        mysqli_query($connexion,"DELETE FROM publications WHERE id=$id");
        header("location:accueil.php");
    }
    if(isset($_POST['unsignal'])){
        $id=$_GET["com"];
        mysqli_query($connexion,"DELETE FROM signalement WHERE idPublication=$id");
        header("location:accueil.php");
    }
    affichePublications2($_GET["com"]);
echo "<form method='post'>
                    <button type='submit' name='delete'>
                    Voulez vraiment suprimer ce commentaire
                    </button>
                     </form>";
echo "<form method='post'>
                    <button type='submit' name='unsignal'>
                    Retirer de la liste des signalement
                    </button>
                     </form>";
}else{
    echo"Vous n'avez rien à faire là";
} ?>
</body> 
</html>
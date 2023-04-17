<?php
require_once("fonction.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="grass_01.css">
<meta charset="ufr-8"/>
    </head>
    <body>
    <h1>
        <?php
        if(!isset($_GET["user"])){
            ?>
            Désolé nous ne trouvons pas de profil à rechercher. 
            <?php }else{
        $userData= getUserByUtil($_GET["user"]);
        if($userData===NULL){
            echo"L'utilisateur chercher n'existe pas";
        }else{
            afficheNomPhotoDeProfil($_GET["user"],100);
            $user=$_GET["user"];
            $req="SELECT * FROM publications WHERE NomUtil='$user'";
            $resultat = mysqli_query ($connexion, $req );
            if($resultat){
                while ($ligne=mysqli_fetch_assoc($resultat)){
                affichePublications($ligne);
                }
            }
        }
        }
        
        ?>
</h1>
</body>
</html>
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
            if($_SESSION["user"]===$_GET["user"]){

            }else{
                $nomDeTab=$_SESSION["user"]."Abonnement";
                $nomDePage=$_GET["user"];
                if(isset($_POST["sub"])){
                    mysqli_query ($connexion, "INSERT INTO $nomDeTab VALUES('$nomDePage');");
                    unset($_POST["sub"]);
                }
                if(isset($_POST["unsub"])){
                    mysqli_query ($connexion, "DELETE FROM $nomDeTab WHERE user='$nomDePage';");
                    unset($_POST["unsub"]);
                    }
            $estAbonné="SELECT * FROM $nomDeTab WHERE user='$nomDePage';";
            $resultat = mysqli_query ($connexion, $estAbonné );//rajouter test
            $estAbonnée= mysqli_fetch_assoc ($resultat);
            if( $estAbonnée==NULL){
                ?>
                <form method="post">
            <button type="submit" name="sub">
              <img src="image/subcribe.jpg">
            </button>
          </form>
                      
                  <?php
            }else{
                ?>
          <form method="post">
      <button type="submit" name="unsub">
        <img src="image/unsubcribe.webp">
      </button>
    </form>
                
            <?php
            }
            $user=$_GET["user"];
            $req="SELECT * FROM publications WHERE NomUtil='$user'";
            $resultat = mysqli_query ($connexion, $req );
            if($resultat){
                while ($ligne=mysqli_fetch_assoc($resultat)){
                affichePublications($ligne);
                }
            }
        }
        }}
        
        ?>
</h1>
</body>
</html>
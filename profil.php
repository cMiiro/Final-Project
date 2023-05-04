<?php
require_once('header.php');
?>
<!DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="profile.css">
     <meta charset="ufr-8"/>
    </head>
    <body>
      <h1>
        <?php
        if(!isset($_GET["user"])){
            ?>
            Désolé nous ne trouvons pas de profil à rechercher. 
            <?php }else{
                like();
                unlike();
                signal();
                delete();
                $modo=estmodo($_SESSION["user"]);
            $userData= getUserByUtil($_GET["user"]);
        if($userData===NULL){
            echo"L'utilisateur chercher n'existe pas";
        }else{
              
            //Toute les modifications des profils grâce aux bouton à disposition seront placé là
              $nomDeTab=$_SESSION["user"]."Abonnement";
              $nomDePage=$_GET["user"];  
              if(isset($_POST["Unban"])){
                mysqli_query ($connexion, "UPDATE user set Ban=0 WHERE NomUtil='$nomDePage';");
                unset($_POST["Unban"]);
                header ("Location:profil.php?user=$nomDePage");
                }
  
                if(isset($_POST["sub"])){
                    mysqli_query ($connexion, "INSERT INTO $nomDeTab VALUES('$nomDePage');");
                    $newNbAbonée=getNbAbonnes($nomDePage)+1;
                    mysqli_query($connexion,"UPDATE user SET abonées=$newNbAbonée WHERE NomUtil='$nomDePage'");
                    unset($_POST["sub"]);
                    header ("Location:profil.php?user=$nomDePage");
                }
                if(isset($_POST["Ban"])){
                    mysqli_query ($connexion, "UPDATE user set Ban=1 WHERE NomUtil='$nomDePage';");
                    unset($_POST["Ban"]);
                    header ("Location:profil.php?user=$nomDePage");
                }
                if(isset($_POST["unsub"])){
                    mysqli_query ($connexion, "DELETE FROM $nomDeTab WHERE user='$nomDePage';");
                    $newNbAbonée=getNbAbonnes($nomDePage)-1;
                    mysqli_query($connexion,"UPDATE user SET abonées=$newNbAbonée WHERE NomUtil='$nomDePage'");
                    unset($_POST["unsub"]);
                    header ("Location:profil.php?user=$nomDePage");
                    }



            echo"<h1 class=\"name\">";      
            afficheNomPhotoDeProfil($_GET["user"],100);
            echo"<\h1>";
            if($userData["Ban"]==="1"){
                echo"<h1 class=\"Description\">Cette utilisateur a été bani(e).<br> Son contenu ne peux plus être visible.</h1><br>";
                if(estModo($_SESSION["user"])===true){
                    ?>
                    <form method="post">
                    <button type="submit" name="Unban">
                    Debannir
                    </button>
                    </form>
                    <?php
                    }}else{
                        echo "<h1 class=\"Description\"><br>Cette utilisateur a ".getNbAbonnes($nomDePage)." abonné(s).<br>";
                        echo $userData["Description"];
            echo "<br></h1>";
            if($_SESSION["user"]===$_GET["user"]){
            echo"<a href='modifications.php'>modification profil</a><br>";
            }else{
            $estAbonné="SELECT * FROM $nomDeTab WHERE user='$nomDePage';";
            $resultat = mysqli_query ($connexion, $estAbonné );//rajouter test
            $estAbonnée= mysqli_fetch_assoc ($resultat);
            if( $estAbonnée===NULL){
                ?>
                <form method="post">
            <button type="submit" name="sub">
            <img class="suivre" src="image/suivre2.png">
            </button>
          </form>
                      
                  <?php
            }else{
                ?>
          <form method="post">
      <button type="submit" name="unsub">
      <img class="suivie" src="image/suivie.png">
      </button>
    </form>

            <?php
            }if(estModo($_SESSION["user"])===true){
                ?>
                <form method="post">
                <button type="submit" name="Ban">
                Bannir
                </button>
                </form>
                <?php
            }}if(isset($estAbonnée) && $estAbonnée===NULL && $userData["privé"]==='1' ){
                echo"ce profil est privée vous ne pouvez pas le voir";
            }else{
            $user=$_GET["user"];
            $req="SELECT * FROM publications WHERE NomUtil='$user' ORDER BY id DESC";
            $resultat = mysqli_query ($connexion, $req );
            if($resultat){
                echo '<div class="pub">';
                while ($ligne=mysqli_fetch_assoc($resultat)){
                affichePublications($ligne,$modo);
                }
                echo'</div>';
            }
        }
        }}}

        ?>
</h1>
</body>
</html>
<?php
require_once('header.php');
?>
    <head>
     <link rel="stylesheet" href="profile.css">
     <meta charset="ufr-8"/>
    </head>
    <body>
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
                    mysqli_query($connexion,"UPDATE user SET abonees=$newNbAbonée WHERE NomUtil='$nomDePage'");
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
                    mysqli_query($connexion,"UPDATE user SET abonees=$newNbAbonée WHERE NomUtil='$nomDePage'");
                    unset($_POST["unsub"]);
                    header ("Location:profil.php?user=$nomDePage");
                    }



            echo"<h1 class=\"name\">";      
            afficheNomPhotoDeProfil($_GET["user"],100);
            echo"</h1>";
            if($userData["Ban"]==="1"){
                echo"<h1 class=\"name\">Cette utilisateur a été bani(e).<br> Son contenu ne peux plus être visible.</h1><br>";
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
            echo"<a href='modifications.php'><img src=\"image/paramétre.png\" width=50 height=50></a>";
            echo"<a href='like.php'><img src=\"image/like2.jpg\" width=50 height=50></a>";
            echo"<form action=\"connection.php\" method='post'>
                    <button type='submit' name='deco' >
                    <img src=image/boutondeco.png width=50 height=50>
                    </button>
                     </form>";
                     $estAbonne="yes";// je veux juste qu'il ne soit pas null pour après
            }else{
            $estAbonne="SELECT * FROM $nomDeTab WHERE user='$nomDePage';";
            $resultat = mysqli_query ($connexion, $estAbonne );//rajouter test
            $estAbonne= mysqli_fetch_assoc ($resultat);
            if( $estAbonne===NULL){
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
                
            }}if( $estAbonne===NULL && $userData["prive"]==='1' ){
                echo"<h1 class=\"name\">Ce profil est privée vous ne pouvez pas le voir</h1>";
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
        mysqli_close($connexion);
        ?>
</body>
</html>
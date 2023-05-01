
<?php 
require_once("connexionMysql.php");//permet de se connecter à Mysql avec ses donné ce qui est nécéssaire pour certaines fonctions.

function estConnecte(){ /*Donne le nom si connecter sinon propose de se connecter*/
if (isset($_SESSION["user"])){
    $user=$_SESSION["user"];
    echo "<a href=\"profil.php?user=$user\">";
    afficheNomPhotoDeProfil($_SESSION["user"],60);
    echo"</a>";
    }else{
        if(isset($_COOKIE["user"])){
     $_SESSION["user"]=$_COOKIE["user"];
     $user=$_SESSION["user"];
     echo "<a href=\"profil.php?user=$user\">";
     afficheNomPhotoDeProfil($_SESSION["user"],60);
     echo"</a>";
        }else{
        echo"<a href=\"connection.php\">Se connecter</a>";
    }}
}

function getUserByUtil($nomUtil){
    global $connexion;
    $selectUser = "SELECT * FROM user WHERE NomUtil='".$nomUtil."'" ;
    $utilisateur = mysqli_query ($connexion, $selectUser);//permet d'avoir tous les utilisateur avec le nom d'utilisateur et donc toute ces information;
    $user= mysqli_fetch_assoc ($utilisateur) ;
    return $user;
}

function afficheNomPhotoDeProfil($nomUtil,$taille){
    $userData=getUserByUtil($nomUtil);
       $photo=$userData["PhotoProfil"];
       echo "<img src=\"$photo\" width=\"$taille\" height=\"$taille\">" ; 
       echo $userData["NomUtil"];
       echo "<br>";
}

function affichePublications($ligne){ 
   echo "<table><tr><td><img src=\"";
              echo $ligne['lienImage'];
              echo "\"width=500 height=375></td><td>"; 
              $UserName=$ligne['NomUtil'];
              echo "<a href=profil.php?user=$UserName>";
              afficheNomPhotoDeProfil($ligne['NomUtil'],30);
              echo"</a>";
              echo $ligne['DescriptionImage'];
              echo"<br>";
              echo $ligne["aime"];
              $idPubli=$ligne["id"];
              if(isInLike($idPubli)){
                echo"<form method='post'>
                <button type='submit' name='unlike' value=$idPubli>
                <img src=image/like2.jpg width=35 height=35>
                </button>
                 </form>";
              }else{
              echo"<form method='post'>
              <button type='submit' name='like' value=$idPubli>
              <img src=image/like.jpg width=35 height=35>
              </button>
               </form>";}
             echo"</td></tr><table><br>";
}

function like(){
    if(isset($_POST['like'])){
        global $connexion;
        $tableLike=$_SESSION["user"]."like";
        $publication=$_POST['like'];
        $req="Select * from publications where id=$publication";
        $DataPubli=mysqli_query($connexion,$req);
        $DataPubli= mysqli_fetch_assoc ($DataPubli) ;
        $nblike=$DataPubli["aime"]+1;
        $req="Update publications set aime=$nblike where id=$publication";
        mysqli_query($connexion,$req);
        mysqli_query ($connexion, "INSERT INTO $tableLike VALUES($publication)");
    }
}

function unlike(){              //sert à enlever le like on ne vas pas mettre de dislike dans notre site internet on déjà des commentaires.
    if(isset($_POST['unlike'])){
        global $connexion;
        $tableLike=$_SESSION["user"]."like";
        $publication=$_POST['unlike'];
        $req="Select * from publications where id=$publication";
        $DataPubli=mysqli_query($connexion,$req);
        $DataPubli= mysqli_fetch_assoc ($DataPubli) ;
        $nblike=$DataPubli["aime"]-1;
        $req="Update publications set aime=$nblike where id=$publication";
        mysqli_query($connexion,$req);
        mysqli_query ($connexion, "DELETE FROM $tableLike WHERE NumeroId=$publication;");
    }
}

function isInLike($NumCom){
global $connexion;
$tableLike=$_SESSION["user"]."like";
$aLike="SELECT * FROM $tableLike WHERE NumeroId=$NumCom;";
            $resultat = mysqli_query ($connexion, $aLike );//rajouter test
            $req= mysqli_fetch_assoc ($resultat);
            if($req===NULL){
                return false;
            }
            return true;
}
        
     
      


function estModo($user){
    $userdata=getUserByUtil($user);
    if($userdata["Modo"]==="1"){
        return true;
    }
    return false;
}


function getNbAbonnes($user){
    $userData=getUserByUtil($user);
    return $userData["abonées"];
}
?>
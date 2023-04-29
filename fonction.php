
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
              afficheNomPhotoDeProfil($ligne['NomUtil'],30);
              echo $ligne['DescriptionImage'];
             echo"</td></tr><table><br>";
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
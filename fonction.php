
<?php 
require_once("connexionMysql.php");//permet de se connecter à Mysql avec ses donné ce qui est nécéssaire pour certaines fonctions.

function estConnecte(){ /*Donne le nom si connecter sinon propose de se connecter*/
if (isset($_SESSION["user"])){
    afficheNomPhotoDeProfil($_SESSION["user"]);
    }else{
        if(isset($_COOKIE["user"])){
     $_SESSION["user"]=$_COOKIE["user"];
     afficheNomPhotoDeProfil($_SESSION["user"]);
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

function afficheNomPhotoDeProfil($nomUtil){
    $userData=getUserByUtil($nomUtil);
       $photo=$userData["PhotoProfil"];
       echo "<img src=\"$photo\" width=\"60\" height=\"60\">" ;
       echo $_COOKIE["user"];
}




?>
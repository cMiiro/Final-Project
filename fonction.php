
<?php 
require_once("connexionMysql.php");//permet de se connecter à Mysql avec ses donné ce qui est nécéssaire pour certaines fonctions.

function returnNom(){ /*Donne le nom si connecter sinon propose de se connecter*/
    if (isset($_COOKIE["user"])){
        echo $_COOKIE["user"];
    }else{
        echo"<a href=\"connection.php\">Se connecter</a>";
    }
}

function getUserByUtil($nomUtil){
    global $connexion;
    $selectUser = "SELECT * FROM user WHERE NomUtil='".$nomUtil."'" ;
    $utilisateur = mysqli_query ($connexion, $selectUser);//permet d'avoir tous les utilisateur avec le nom d'utilisateur et donc toute ces information;
    $user= mysqli_fetch_assoc ($utilisateur) ;
    return $user;
}




?>
<?php 

function returnNom(){ /*Donne le nom si connecter sinon propose de se connecter*/
    if (isset($_COOKIE["nom"])){
        echo $_COOKIE["nom"];
    }else{
        echo"<a href=\"connection.php\">Se connecter</a>";
    }
}


?>
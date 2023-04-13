<?php
require_once("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
<link rel="stylesheet" href="connection.css">
</head>
<body>
    <table border=1>
        <tr><th>
        <form action="createPublication.php" method="post" autocomplete="on">
         Document à envoyer : <input type="url" name="url"><br>
         Description <br> <textarea name="description" rows="10" cols="10" >
</textarea><br>

        <input type="submit" name="go">
        </form>      
  <p> <?php
if(isset($_POST["go"])){
if($_POST["url"] && $_POST["description"]){
$url=$_POST["url"];
$description=$_POST["description"];
$user=$_COOKIE["user"];
$dateActu=date("Y-m-d h:i:s");
$AddPublication="INSERT INTO publications VALUES('$user' , '$url' ,'$description' ,'$dateActu');";
$resultat = mysqli_query ($connexion, $AddPublication );
           if ($resultat === TRUE){
            echo"Votre publication à bien été envoyer";
            
            //Maintenant on va supprimer tout les post Ainsi si on refresh la page l'on ne vas pas avoir une publication qui va recommencer mais uniquement la date et leur qui change.
            
            unset($_POST["url"]);
            unset($_POST["go"]);
            unset($_POST["description"]);
           }else{
            echo"il y a eu un probléme lors de la publication.Merci de réessayer";
           }
}else{
    echo "il y un probleme l'url n'est pas rempli ou la description n'est pas rempli";
}

}

   
    ?></p>
    </th></tr>
    </table>
</body>
</html>
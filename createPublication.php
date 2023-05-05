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
<a href="accueil.php"><img class="home" src="image/home22.png"></a>
    <table border=1>
        <tr><th>
        <form action="createPublication.php" method="post" enctype="multipart/form-data">
         Document à envoyer : <input type="file" name="image"><br>
         Description <br> <textarea name="description" rows="10" cols="80" >
</textarea><br>
Voulez vous une publications privé :<input type="checkbox" name="prive">
        <input type="submit" name="go">
        </form>      
  <p> <?php
if(isset($_POST["go"])){
    $file = $_FILES['image'];

    // récupère les informations de l'image
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // vérifie que le fichier est une image
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){//on vérifie qu'il n'y a pas d'erreur
            if($fileSize < 5000000){ // limite de 5 Mo
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'publication/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "La publication à été envoyer avec succès.";
            } else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
    if(isset($_POST["prive"])){
  $prive=1;
    }else{
        $prive=0;
    }
$description=$_POST["description"];
$description=addslashes($description);
$user=$_SESSION["user"];
$dateActu=date("Y-m-d h:i:s");
$AddPublication="INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ,prive ) VALUES('$user' , '$fileDestination' ,'$description' ,'$dateActu',0,$prive);";
$resultat = mysqli_query ($connexion, $AddPublication );
           if ($resultat === TRUE){
            echo"Votre publication à bien été envoyer";
            
            //Maintenant on va supprimer tout les post Ainsi si on refresh la page l'on ne vas pas avoir une publication qui va recommencer mais uniquement la date et leur qui change.
            
            unset($_POST["image"]);
            unset($_POST["go"]);
            unset($_POST["description"]);
           }else{
            echo "il y un probleme il n'y a pas d'image ou la description n'est pas rempli";
        }
}



   end();
    ?></p>
    </th></tr>
    </table>
</body>
</html>
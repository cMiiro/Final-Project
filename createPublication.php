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
        <form action="createPublication.php" method="post" autocomplete="on" enctype="multipart/form-data">
         Document à envoyer : <input type="file" name="image"><br>
         Description <br> <textarea name="description" rows="10" cols="80" >
</textarea><br>

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
    $fileType = $file['type'];

    // vérifie que le fichier est une image
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 5000000){ // limite de 5 Mo
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'commentaire/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "L'image a été téléversée avec succès.";
            } else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
$description=$_POST["description"];
$user=$_SESSION["user"];
$dateActu=date("Y-m-d h:i:s");
$AddPublication="INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ) VALUES('$user' , '$fileDestination' ,'$description' ,'$dateActu',0);";
$resultat = mysqli_query ($connexion, $AddPublication );
           if ($resultat === TRUE){
            echo"Votre publication à bien été envoyer";
            
            //Maintenant on va supprimer tout les post Ainsi si on refresh la page l'on ne vas pas avoir une publication qui va recommencer mais uniquement la date et leur qui change.
            
            unset($_POST["image"]);
            unset($_POST["go"]);
            unset($_POST["description"]);
           }else{
            echo"il y a eu un probléme lors de la publication.Merci de réessayer";
           }
}else{
    echo "il y un probleme il n'y a pas d'image ou la description n'est pas rempli";
}



   
    ?></p>
    </th></tr>
    </table>
</body>
</html>
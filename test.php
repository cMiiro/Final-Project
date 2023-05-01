<?php 
require_once('fonction.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
    </head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit" name="submit">Téléverser</button>
</form>
<?php
if(isset($_POST['submit'])){
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
            echo "Erreur lors du téléversement de l'image.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
}
?>

   </body>
</html>
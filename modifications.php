<?php
require_once("fonction.php"); //rajouter sécurité une personne non connecté ne peux pas utiliser cette page
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
<link rel="stylesheet" href="inscription.css">
</head>
<body>
<a href="accueil.php"><img class="home" src="image/home22.png"></a>
    <table border=1>
        <tr><th>   
        <form action="modifications.php" method="post" autocomplete="on" enctype="multipart/form-data">
         Modifier Photo De Profil : <input type="file" name="Newprofil"><br>
         Nouvelle Description <br> <textarea name="NewDescription" rows="10" cols="70" ></textarea><br>
         Ancien Mot De Passe : <input type="text" name="OldMdp"><br>
         Nouveau Mot De Passe :<input type="text" name="Newmdp"><br>
       devenir compte privé <input type="checkbox" name="private">  <br>
         <input type="submit" name="go"></form>
        
        
        <?php if(isset($_POST["go"])){

                 $user=$_SESSION["user"];
                 $file = $_FILES['Newprofil'];
                 if($file['error'] !== UPLOAD_ERR_NO_FILE){

                 // récupère les informations de l'image
                 $fileName = $file['name'];
                 $fileTmpName = $file['tmp_name'];
                 $fileSize = $file['size'];
                 $fileError = $file['error'];

                // vérifie que le fichier est une image
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $Typeautorise = array('jpg', 'jpeg', 'png', 'gif');
                if(in_array($fileActualExt, $Typeautorise)){
                if($fileError === 0){
                if($fileSize < 5000000){ // limite de 5 Mo on ne vas pas telecharger de trop grosse images
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'profil/'.$fileNameNew;
                echo $fileDestination;
                move_uploaded_file($fileTmpName, $fileDestination);
                }}} 
                $req="UPDATE user SET PhotoProfil='$fileDestination' WHERE NomUtil='$user' "; 
                $resultat = mysqli_query ($connexion, $req );
            }
            if($_POST['NewDescription']!==''){
                $newDes=$_POST["NewDescription"];
                $req="UPDATE user SET Description='$newDes' WHERE NomUtil='$user' "; //modifier le nom
                $resultat = mysqli_query ($connexion, $req );
            }
            if($_POST["Newmdp"]!=="" && $_POST["OldMdp"]!==""){
                $userData=getUserByUtil($_SESSION["user"]);
                //on verifie l'ancien mot de passe pour avoir un nouveau
                if(password_verify($_POST["OldMdp"], $userData["mdp"])){
                    $newmdp=password_hash($_POST['Newmdp'], PASSWORD_DEFAULT);
                    $req="UPDATE user SET mdp='$newmdp' WHERE NomUtil='$user' ";
                    $resultat = mysqli_query ($connexion, $req );
                }
            }
            if(isset($_POST["private"])){
                //transforme en compte privé
                mysqli_query($connexion,"UPDATE user SET prive=1 WHERE NomUtil='$user'");
            }
            header ("Location:profil.php?user=$user");
        }
        
        mysqli_close($connexion);
        ?>
</body>
</html>
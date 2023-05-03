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
    <table border=1>
        <tr><th>   
        <form action="modifications.php" method="post" autocomplete="on" enctype="multipart/form-data">
         Modifier Photo De Profil : <input type="file" name="Newprofil"><br>
         Nouvelle Description <br> <textarea name="NewDescription" rows="10" cols="70" ></textarea><br>
         Ancien Mot De Passe : <input type="text" name="OldMdp"><br>
         Nouveau Mot De Passe :<input type="text" name="Newmdp"><br>
         <button type="submit" name="private">devenir compte privé</button><br>
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
                if($fileSize < 5000000){ // limite de 5 Mo
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
                if($userData["mdp"]===$_POST["OldMdp"]){
                    $newmdp=$_POST["Newmdp"];
                    $req="UPDATE user SET mdp='$newmdp' WHERE NomUtil='$user' ";
                    $resultat = mysqli_query ($connexion, $req );
                }
            }
            if(isset($_POST["private"])){
                mysqli_query($connexion,"UPDATE user SET privé=1 WHERE NomUtil='$user'");
            }
            header ("Location:profil.php?user=$user");
        }
        
        
        
        ?>
</body>
</html>
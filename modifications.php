<?php
require_once("fonction.php"); //rajouter sécurité une personne non connecté ne peux pas utiliser cette page
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
        <form action="modifications.php" method="post" autocomplete="on">
         Modifier Photo De Profil : <input type="text" name="Newprofil"><br>
         Nouvelle Description <br> <textarea name="NewDescription" rows="10" cols="10" ></textarea><br>
         Ancien Mot De Passe : <input type="text" name="OldMdp"><br>
         Nouveau Mot De Passe :<input type="text" name="Newmdp"><br>
        <input type="submit" name="go"></form>
        <?php if(isset($_POST['Newprofil']) && isset($_POST['NewDescription'])){
            $user=$_SESSION["user"];
            if($_POST["Newprofil"]!==''){
                $newprofil=$_POST["Newprofil"];
                $req="UPDATE user SET PhotoProfil='$newprofil' WHERE NomUtil='$user' "; //modifier le nom
                $resultat = mysqli_query ($connexion, $req );
            }
            if($_POST['NewDescription']!==''){
                $newDes=$_POST["NewDescription"];
                $req="UPDATE user SET Descritpion='$newDes' WHERE NomUtil='$user' "; //modifier le nom
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
            header ("Location:profil.php?user=$user");
        }
        
        
        
        ?>
</body>
</html>
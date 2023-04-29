<?php 
require_once('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="accueil.css">
<meta charset="ufr-8">
    </head>
<body>
    <a href="createPublication.php"> <img class="plus" src="image/plus.png"></a><br>
    <datalist id="ListeUser">
     <?php 
     $listeUser=mysqli_query($connexion,"SELECT * From user ORDER BY abonées");
     while ($ligne=mysqli_fetch_assoc($listeUser)){
    echo '<option value="'.$ligne['NomUtil'].'"></option>'; 
    }
     ?>
</datalist>
<form action="accueil.php" method="post">
<input type="search" name="recherche" list="ListeUser" placeholder="Valeur par defaut">
<button type="submit">rechercher</button>
</form>
    <?php 
    estModo($_SESSION["user"]);
    $req="Select * from publications;";
    $resultat=mysqli_query ($connexion,$req);
    $user=$_SESSION["user"];
    if($resultat){
        while ($ligne=mysqli_fetch_assoc($resultat)){
        $NomUserPost=$ligne["NomUtil"];
        $req="Select * from $user"."abonnement WHERE user='$NomUserPost';";
        $estAbonne=mysqli_query ($connexion,$req);
        $verification= mysqli_fetch_assoc ($estAbonne);
        if($verification!==NULL){
            affichePublications($ligne);
        }}}
    
        if(isset($_POST["recherche"])){
            $userChercher= $_POST["recherche"];
            header ("Location:profil.php?user=$userChercher");
        }
    ?>
    

<body>
</html>
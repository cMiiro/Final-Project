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
    <a href="createPublication.php"> test publications</a><br>
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
    
    ?>

<body>
</html>

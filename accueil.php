<?php 
require_once('header.php');
?>

<head>
    <link rel="stylesheet" href="accueil.css">
<meta charset="ufr-8">
    </head>
<body>
    <?php
    if(isset($_SESSION["user"])){
    $modo=estmodo($_SESSION["user"]);
    if ($modo){
        $signal=mysqli_query($connexion,"SELECT * FROM signalement");
        $signal=mysqli_fetch_assoc($signal);
        
        //le bouton plus bas n'apparait que s'il y a des commentaires signialé et n'est visible que les modérateur
        if($signal!==NULL){
    
echo "<a href=\"verificationSignalment.php\"><img class=\"verif\" src=\"image/verif.png\"></a>";
 }}
     
     //on vérifie s'il y a des like ajouter ou suprimmer.
     like();
     unlike();
     signal();
     delete();
?>

    <a href="createPublication.php"> <img class="plus" src="image/plus.png"></a><br>
    <datalist id="ListeUser">
     <?php
     $listeUser=mysqli_query($connexion,"SELECT * From user ORDER BY abonees");
     while ($ligne=mysqli_fetch_assoc($listeUser)){
    echo '<option value="'.$ligne['NomUtil'].'"></option>';  //on créer une option par utilisateur pour la barre de recherche. On les classe par ordre d'abonées.
    }
     ?>
</datalist>
<!-- Barre de recherche  -->
<form action="accueil.php" method="post">
<input type="search" name="recherche" list="ListeUser" placeholder="Valeur par defaut">
<button type="submit" class="bouton">rechercher</button>
</form>
    <?php 
    estModo($_SESSION["user"]);
    $req="SELECT * FROM publications ORDER BY id DESC;";
    $resultat=mysqli_query ($connexion,$req);
    $user=$_SESSION["user"];
    if($resultat){
        while ($ligne=mysqli_fetch_assoc($resultat)){
         $NomUserPost=$ligne["NomUtil"];
          //regarde si l'utilisateur est abonné à celui qui à poster la publication
         $req="SELECT * from $user"."abonnement WHERE user='$NomUserPost';";
         $estAbonne=mysqli_query ($connexion,$req);
         $verification= mysqli_fetch_assoc ($estAbonne);
         if($verification!==NULL){//dans le cas ou il y a au moins un utilisateur du même nom que celui qui a posté la publication alors on affiche le commentaire(normalement il y en a au plus un).
             affichePublications($ligne,$modo);
    }}}
    //Dans le cas ou on a chercher avec la barre de recherche un utilisateur alors on va aller sur son profil
        if(isset($_POST["recherche"])){
            $userChercher= $_POST["recherche"];
            header ("Location:profil.php?user=$userChercher");
        }
    //Dans le cas ou on n'est pas connecter on va juste montrer les commentaires les plus liker.
    }else{
            $req="SELECT * FROM publications ORDER BY aime;";
            $resultat=mysqli_query ($connexion,$req); 
            while ($ligne=mysqli_fetch_assoc($resultat)){
            $id=$ligne["id"];
            if($ligne["prive"]==="0"){
            affichePublications2($id);
            }}
        }
        mysqli_close($connexion);
    ?>
    
<body>
</html>
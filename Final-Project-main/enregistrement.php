<?php
require_once("connexionMysql.php");
require_once("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
</head>
<body>
<h1><?php 
if(isset ($_POST['nom']) && isset ($_POST['prenom']) && isset ($_POST['user']) && isset ($_POST['mdp'])){
    $nameUse=getUserByUtil($_POST['user']);
        if($nameUse !== NULL){//si $nomutilisé n'est pas null alors il y a déjà un utilisateur de ce nom.
            echo "Ce nom d'utilisateur est déjà utilisé";
        }else{
    if($_POST['mdp']===$_POST['vmdp']){
    $user=$_POST['user'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $mdp=$_POST['mdp'];
    $AddUser="INSERT INTO user VALUES('$nom' , '$prenom' ,'$user' ,'$mdp',NULL ,NULL,0 ,0);";
    $resultat = mysqli_query ($connexion, $AddUser );
    if ($resultat === TRUE){
    setcookie("user",$_POST["user"],time()+3600);/* si un nom à été enregistrer alors on se souviendras du nom. De plus le cookies va rester pendant une heure et ensuite il faudras se reconnecter*/
    echo "Inscryption terminée";}
    else{
     echo "il y a eu un probléme lors de l'inscryption réessayer";
    }}else{
    echo "pas le meme mots de passe";
}}}else{
    echo"des informations ne sont pas rempli";
}

?></h1>
</body>
</html>
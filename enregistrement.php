<?php
include_once("connexionMysql.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
</head>
<body>
<h1><?php 
if(isset ($_POST['nom']) && isset ($_POST['prenom']) && isset ($_POST['user']) && isset ($_POST['mdp'])){
    $user=$_POST['user'];
    $selectUser = "SELECT * FROM user WHERE NomUtil='$user'" ;
    $nomutilisé = mysqli_query ($connexion, $selectUser );//permet d'avoir tous les utilisateur avec le nom d'utilisateur rentrer précédament;
        if($nomutilisé !== null){//si $nomutilisé n'est pas null alors il y a déjà un utilisateur de ce nom.
        echo 'nom déjà utilisé';
        }else{
    if($_POST['mdp']===$_POST['vmdp']){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $mdp=$_POST['mdp'];
    $AddUser="INSERT INTO user VALUES('$nom' , '$prenom' ,'$user' ,'$mdp',NULL ,NULL,0 ,0);";
    $resultat = mysqli_query ($connexion, $AddUser );
    echo $resultat;
    setcookie("user",$_POST["user"],time()+3600);/* si un nom à été enregistrer alors on se souviendras du nom. De plus le cookies va rester pendant une heure et ensuite il faudras se reconnecter*/
    echo "Inscryption terminée";
}else{
    echo "pas le meme mots de passe";
}}}
else{
    echo"des informations ne sont pas rempli";
}

?></h1>
</body>
</html>
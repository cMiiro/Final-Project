<?php
require_once("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
<link rel="stylesheet" href="connection.css">
</head>
<body><table border="1">
    <tr><th>
    <form action="connection.php" method="post">
    <?php
if(isset($_POST["user"])){ //regarde si le user est déjà rempli.
    ?> 
Nom d'utilisateur :<input type="text" size="30" name="user" value=<?php echo $_POST["user"] ?>><br>
Mot de Passe :<input type="password" size="30" name="mdp"><br><br>
<p class="erreur">
<?php 
if (isset($_POST["mdp"])){
    if(ctype_alnum($_POST["mdp"]) && (ctype_alnum("user"))){
$user= getUserByUtil($_POST["user"]);
if ($user===null){
    echo"Ce nom d'utilisateur n'existe pas";
}else{
   if($_POST["mdp"]===$user["mdp"]){
    setcookie("user",$_POST["user"],time()+3600); //on enregistre le nom d'utilisateur pendant 3600 secondes(Une heure) pour ne pas avoir à le réécrire.
    $_SESSION["user"]=$_POST["user"];
    header ('Location:accueil.php');//on va à la page d'acceuil.
   }else{
    echo"Le mot de passe n'est pas celui associer au nom d'utilisateur";
   }
}}else{
    echo "Vous avez utiliser des caractères n'étant ni des chiffres ou des lettres. Merci de les retirer";
}
}else{
    echo "Le mot de passe n'est pas rempli";
}
?></p>
<?php }else{ ?>
Nom d'utilisateur :<input type="text" size="30" name="user" placeholder="Votre nom"><br>
Mot de Passe :<input type="password" size="30" name="mdp">
<?php
} ?>
<br><input type="submit" name="go">
</form><br>
<p>Tu n'es pas encore inscrit.<a href="inscription.php">Clique içi</a></p>
</th></tr>
</table>
</body>
</html>
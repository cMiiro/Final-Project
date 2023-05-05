<?php
require_once("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
<link rel="stylesheet" href="connection.css">
</head>
<a href="accueil.php"><img class="home" src="image/home22.png"></a>
<div class="anime"></div>
<h1>Touch Some Grass</h1>
<h2>Avec Touch Some Grass, vous allez être fasciner par l'herbe VERTE</h2>
<body><table border="1">
    <tr><th>
    <form method="post">
    <?php
//Commençons par vérifier qu'on ne cherche pas à se déconecter.

if(isset($_POST["deco"])){
    unset($_SESSION["user"]);
    setcookie("user", "", time()-3600);//on ne peux pas enlever un cookies donc on lui donne un temps négatif
}
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
   echo $_POST['mdp'];
   echo  $user['mdp'];
      if(password_verify($_POST['mdp'], $user['mdp'])){
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
 <?php 
}else{ ?>
 Nom d'utilisateur :<input type="text" size="15" name="user" placeholder="Votre nom"><br>
 Mot de Passe :<input type="password" size="30" name="mdp">
 <?php
} ?>
<br><input type="submit" name="go">
</form><br>
<p>Tu n'es pas encore inscrit.<a href="inscription.php">Clique içi</a></p>
</th></tr>
</table>
</body>
<?php end();
 ?>
</html>
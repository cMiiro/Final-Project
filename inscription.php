<?php
require_once("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
<link rel="stylesheet" href="inscription.css">
</head>
<body>
<a href="accueil.php"><img class="home" src="image/home22.png"></a> 
<div class="primary">
   <h1> Bienvenue!<h1></div>
   <div class="secondary">
      <h2>Nous sommes heureux de te voir!</h2></div>
   <table border="1">
    <tr><th>
    <form action="inscription.php" method="post">
<?php
if(isset($_POST["go"])){ //regarde si le formulaire à déjà été remplie dans ce cas la pluspart des information sont garder sauf le mots de passe te la vérification du mots de passe.
    ?> 
 <p class="formulaire">Nom :<input type="text" size="30" name="nom" value=<?php echo $_POST['nom']?>><br>
 Prénom :<input type="text" size="30" name="prenom" value=<?php echo $_POST['prenom']?>><br>
 Nom d'Utilisateur :<input type="text" size="15" name="user" value=<?php echo $_POST['user']?>><br> 
 Mot de Passe :<input type="password" size="30" name="mdp"><br>
 Vérification Mot de Passe :<input type="password" size="30" name="vmdp"><br></p>
 <p class="erreur">
 <?php if(isset ($_POST['nom']) && isset ($_POST['prenom']) && isset ($_POST['user']) && isset ($_POST['mdp']) && isset ($_POST['mdp'])){
    if(ctype_alnum($_POST["user"]) && ctype_alnum($_POST["nom"]) && ctype_alnum($_POST["prenom"]) && ctype_alnum($_POST["mdp"])){
   $nameUse=getUserByUtil($_POST['user']);
     if($nameUse !== NULL){ //si $nomutilisé n'est pas null alors il y a déjà un utilisateur de ce nom et on ne vas pas en mettre un deuxiéme.
        echo "Ce nom d'utilisateur est déjà utilisé";
     }else{
        if($_POST['mdp']===$_POST['vmdp']){
           $user=$_POST['user'];
           $nom=$_POST['nom'];
           $prenom=$_POST['prenom'];
           $mdp= password_hash($_POST['mdp'], PASSWORD_DEFAULT);
           $AddUser="INSERT INTO user VALUES('$nom' , '$prenom' ,'$user' ,'$mdp',NULL ,'image/profilvide.png',0 ,0, 0,0);";
           $resultat = mysqli_query ($connexion, $AddUser );
           if ($resultat === TRUE){
            $AddAbonnement="CREATE TABLE $user"."Abonnement(user VARCHAR(30))";
            $resultat = mysqli_query ($connexion, $AddAbonnement );
            $AddLike="CREATE TABLE $user"."Like(NumeroId INT)";
            $resultat = mysqli_query ($connexion, $AddLike );
              setcookie("user",$_POST["user"],time()+3600);/* si un nom à été enregistrer alors on se souviendras du nom d'utilisateur. De plus le cookies va rester pendant une heure et ensuite il faudras se reconnecter*/
              $_SESSION["user"]=$_POST["user"];
              header ('Location:accueil.php');}
           else{
              echo "il y a eu un probléme lors de l'inscryption réessayer";
           }
        }else{
          echo "pas le meme mots de passe";
        }
     }
    }else{
        echo "Vous avez utiliser des caractères n'étant ni des chiffres ou des lettres. Merci de les retirer";
    }
}else{
        echo"des informations ne sont pas rempli";
    }
}else{?>
</p>
<p class="formulaire">Nom :<input type="text" size="30" name="nom" placeholder="Votre nom"><br>
Prénom :<input type="text" size="30" name="prenom" placeholder="Votre Prénom"><br>
Nom d'Utilisateur :<input type="text" size="30" name="user" placeholder="Votre Nom D'utilisateur"><br>
Mot de Passe :<input type="password" size="30" name="mdp"><br>
Vérification Mot de Passe :<input type="password" size="30" name="vmdp"><br></p>
<?php }?><br>
<input type="submit" name="go">
</form><br>
</th></tr>
</table>
</body>
<?php mysqli_close($connexion);
?>
</html>
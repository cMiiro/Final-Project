<?php
require_once("connexionMysql.php");
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
    <form action="inscription.php" method="post">
<?php
if(isset($_POST["go"])){ //regarde si le formulaire à déjà été remplie.
    ?> 
Nom :<input type="text" size="30" name="nom" value=<?php echo $_POST['nom']?>><br>
Prénom :<input type="text" size="30" name="prenom" value=<?php echo $_POST['prenom']?>><br>
Nom d'Utilisateur :<input type="text" size="30" name="user" value=<?php echo $_POST['user']?>><br> 
Mot de Passe :<input type="password" size="30" name="mdp"><br>
Vérification Mot de Passe :<input type="password" size="30" name="vmdp"><br>
    <?php if(isset ($_POST['nom']) && isset ($_POST['prenom']) && isset ($_POST['user']) && isset ($_POST['mdp']) && isset ($_POST['mdp'])){
        $nameUse=getUserByUtil($_POST['user']);
            if($nameUse !== NULL){ //si $nomutilisé n'est pas null alors il y a déjà un utilisateur de ce nom et on ne vas pas en mettre un deuxiéme.
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
        setcookie("user",$_POST["user"],time()+3600);/* si un nom à été enregistrer alors on se souviendras du nom d'utilisateur. De plus le cookies va rester pendant une heure et ensuite il faudras se reconnecter*/
        echo "Inscription terminée";}
        else{
         echo "il y a eu un probléme lors de l'inscryption réessayer";
        }}else{
        echo "pas le meme mots de passe";
    }}}else{
        echo"des informations ne sont pas rempli";
    }
}else{?>
Nom :<input type="text" size="30" name="nom" value="Votre nom"><br>
Prénom :<input type="text" size="30" name="prenom" value="Votre Prénom"><br>
Nom d'Utilisateur :<input type="text" size="30" name="user" value="Votre Nom D'utilisateur"><br>
Mot de Passe :<input type="password" size="30" name="mdp"><br>
Vérification Mot de Passe :<input type="password" size="30" name="vmdp"><br>
<?php }?><br>
<input type="submit" name="go">
</form><br>
</th></tr>
</table>
</body>
</html>
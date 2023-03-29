<!DOCTYPE html>
<html>
<head>
<meta charset="ufr-8">
</head>
<body>
<h1><?php 
if(isset($_POST["nom"])){
    setcookie("nom",$_POST["nom"],time()+3600);/* si un nom à été enregistrer alors on se souviendras du nom. De plus le cookies va rester pendant une heure et ensuite il faudras se reconnecter*/
echo "ça marche";
}echo $_COOKIE["nom"];
?></h1>
</body>
</html>
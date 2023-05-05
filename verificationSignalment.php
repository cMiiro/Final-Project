<?php 
require_once('header.php');
?>

<head>
    <link rel="stylesheet" href="profile.css">
<meta charset="ufr-8">
    </head>
<body>
<?php if(estModo($_SESSION["user"])===true){
$signalement=mysqli_query($connexion,"Select * from signalement");
while ($ligne=mysqli_fetch_assoc($signalement)){
 $id=$ligne["idPublication"];
echo "L'utilsateur ".$ligne["utilSignal"]."signal la publications suivantes <a href=supprimer.php?com=$id>";
affichePublications2($id);
echo"</a>";
}
mysqli_close($connexion);
} ?>
</body> 
</html>
<?php
require_once('header.php');
?>

    <head>
     <link rel="stylesheet" href="profile.css">
     <meta charset="ufr-8"/>
    </head>
    <body>
<?php 
like();
unlike();
signal();
delete();
if(isset($_SESSION["user"])){
    $table=$_SESSION["user"]."like";
    $like=mysqli_query($connexion,"SELECT * FROM $table ORDER BY NumeroId DESC");
    while ($ligne=mysqli_fetch_assoc($like)){
    $id=$ligne["NumeroId"];
if($id!==NULL) {
    $UnePublication=mysqli_query($connexion,"SELECT * FROM publications WHERE id=$id");
    $UnePublication=mysqli_fetch_assoc($UnePublication);
    if($UnePublication!==NULL){
    affichePublications($UnePublication,estModo($_SESSION["user"]));
    }
    }}
}
mysqli_close($connexion);
?>
</body>
</html>
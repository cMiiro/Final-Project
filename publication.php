<?php 
require_once('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="publication.css">
<meta charset="ufr-8">
    </head>
<body>
<?php 
//on vérifie s'il y a des like ajouter ou suprimmer.
like();
unlike();
//on vérifie s'il y a au moins un commentaire à afficher.
if(isset($_GET["com"])){
    $idPublication=$_GET["com"];

    //ajout d'un commentaire
    if(isset($_POST["commentaire"])){
    if($_POST["commentaire"]!==''){//regarde si le commentaire n'est pas vides
    $user=$_SESSION['user'];
    $com=$_POST["commentaire"];
    mysqli_query($connexion, "INSERT INTO commentaire VALUES('$user','$com',$idPublication)");
}}
$publication=mysqli_query($connexion,"SELECT * FROM publications WHERE id=$idPublication");
$publication=mysqli_fetch_assoc ($publication);
affichePublications($publication);
$commentaires=mysqli_query($connexion,"SELECT * FROM commentaire WHERE idPublication=$idPublication");
?>
<tr><td>
<form method="post">
<input type="text" name="commentaire" size="60" placeholder="Voulez vous commentez ?">
<button class="buttons" name="private">Poster</button>
</form>
</td></tr>
<div class="comment">
    <table>
        <?php
        while ($ligne=mysqli_fetch_assoc($commentaires)){
            echo"<tr><td>";
            afficheNomPhotoDeProfil($ligne["NomUtil"],45);
            echo "<br>".$ligne["TexteCom"]."<br></td></tr>";
        }
        ?>
    </table>
</div>

<?php
}else{
    echo "il n'y a pas de publications à voir";
}
?>
</body>
</html>

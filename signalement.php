<?php 
require_once('header.php');
?>

<head>
    <link rel="stylesheet" href="supprimer.css">
<meta charset="ufr-8">
    </head>
<body>
<?php 
if(isset($_POST['signal'])){
    $id=$_GET["com"];
    $name=$_SESSION["user"];
    mysqli_query($connexion,"INSERT INTO signalement VALUES('$name',$id)");
    header("location:accueil.php");
}
affichePublications2($_GET["com"]); 
   echo "<form method='post'>
                    <button type='submit' name='signal'>
                    Voulez vraiment signialer ce commentaire.
                    </button>
                     </form>";
    echo "<h1>Un abus de signialement injustifier peut être un raison de ban</h1>";
    mysqli_close($connexion);                
    ?>
</body> 
</html>

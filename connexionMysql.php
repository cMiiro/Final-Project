<?php
session_start();
//paramétre Camille
$serveur='localhost';
$username='root';
$mdp='';
$base='tsg_base';

$connexion = mysqli_connect ($serveur,$username,$mdp,$base);

?>
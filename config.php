<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_de_donnees = "projet";

$conn = mysqli_connect('localhost','root','','projet');
if(!$conn){
    die('Error '.mysqli_connect_error());
}

?>

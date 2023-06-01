<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $motdepasse = $_POST['motdepasse'];
    
    // Mettre à jour les informations de l'utilisateur
    $Id_U = $_SESSION['Id_U'];
    $sql = "UPDATE utilisateur SET ";
    
    // Vérifier si les champs sont remplis et construire la requête SQL
    if (!empty($nom)) {
        $sql .= "nom='$nom', ";
    }
    if (!empty($prenom)) {
        $sql .= "prenom='$prenom', ";
    }
    if (!empty($tel)) {
        $sql .= "tel='$tel', ";
    }
    if (!empty($motdepasse)) {
        $sql .= "motdepasse='$motdepasse', ";
    }
    
    // Supprimer la virgule finale de la requête SQL
    $sql = rtrim($sql, ", ");
    
    // Exécuter la requête SQL uniquement si au moins un champ a été modifié
    if (!empty($sql)) {
        $sql .= " WHERE Id_U='$Id_U'";
        
        if (mysqli_query($conn, $sql)) {
            echo '<script> alert("Les informations ont été mises à jour avec succès"); </script>';
            header("Location: profil.Php");
            exit();
        } else {
            echo '<script> alert("Une erreur s\'est produite lors de la mise à jour des informations"); </script>';
            header("Location: Edit.php");
            exit();
        }
    } else {
        echo '<script> alert("Aucune modification n\'a été effectuée"); </script>';
        header("Location: Edit.php");
        exit();
    }
}
?>

<?php
    session_start();
    include('config.php');

    if(isset($_POST['supprimer'])){
        $annonceId = $_POST['annonceId'];
        $Id_U = $_SESSION['Id_U'];
        
        // Supprimer l'annonce des favoris
        $sql = " DELETE FROM favoris WHERE id_an='$annonceId'; "; 
        $sql1 = " DELETE FROM annonce WHERE id_A='$annonceId'; ";
        if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
            echo '<script> alert("Votre annonce a été supprimée avec succès"); </script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo '<script> alert("Une erreur s\'est produite lors de la suppression de l\'annonce"); </script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
?>
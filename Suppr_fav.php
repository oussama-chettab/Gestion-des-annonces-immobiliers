<?php
    session_start();
    include('config.php');

    if(isset($_POST['supprimer'])){
        $annonceId = $_POST['annonceId'];
        $Id_U = $_SESSION['Id_U'];
        
        // Supprimer l'annonce des favoris
        $sql = " DELETE FROM favoris WHERE id_ut='$Id_U' AND id_an='$annonceId' ";
        if(mysqli_query($conn, $sql)){
            echo '<script> alert("L\'annonce a été supprimée des favoris avec succès"); </script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo '<script> alert("Une erreur s\'est produite lors de la suppression de l\'annonce des favoris"); </script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
?>
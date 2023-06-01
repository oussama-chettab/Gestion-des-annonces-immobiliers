<?php
session_start();
include('config.php');

if(isset($_POST['submit'])){
    if(isset($_SESSION['email'])){
        $id_ann = $_POST['annonceId'];
        $sql = " SELECT id_A, id_U FROM annonce WHERE id_A = $id_ann ";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
        if(isset($id_ann)){
            if($result != 0){
                $row = mysqli_fetch_array($query);
                $annonceId = $row['id_A'];
                $userId = $_SESSION['Id_U'];
                
                $checkSql = "SELECT id_F FROM favoris WHERE id_ut = '$userId' AND id_an = '$annonceId'";
                $checkQuery = mysqli_query($conn, $checkSql);
                $checkResult = mysqli_num_rows($checkQuery);
                
                if($checkResult == 0){
                    $sql1 = " INSERT INTO favoris (id_ut, id_an) VALUES ('$userId', '$annonceId') ";
                    if(mysqli_query($conn,$sql1)){
                        echo '<script> alert("l\'Ajout à liste favoris est bien dérouler"); </script>';
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit();
                    }
                }else{
                    echo '<script> alert(" l\'annonce est déja dans la list des favoris "); </script>';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
        }else{
            echo '<script> alert("Invalid annonce id "); </script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }else{
        echo '<script> alert(" Vous etes déconnecter ! "); </script>';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }   
}
  
?>
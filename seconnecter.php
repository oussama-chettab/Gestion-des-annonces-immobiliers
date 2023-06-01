<?php

session_start();
include_once('config.php');

if((isset($_POST['email']) && isset($_POST['motdepasse']))){
    $email = stripcslashes($_POST['email']);
    $email = filter_input(INPUT_POST,'email');
    //$md5_pass = md5($_POST['motdepasse']);
    $motdepasse = stripcslashes($_POST['motdepasse']);
    $motdepasse_hashe = password_hash($motdepasse, PASSWORD_DEFAULT);

    if(empty($email)){
        $email_error = '<p id="error">Entrer votre email</p>';
        $err_s = 1;
    }
    if(empty($motdepasse)){
        $pass_error = '<p id="error">Entrer votre mot de passe</p>';
        $err_s = 1;
        include('connexion.php');
    }
    else{
        include('connexion.php');
    }
}

if(!isset($err_s)){
    $sql = " SELECT Id_U, email, motdepasse FROM utilisateur WHERE email='$email' AND motdepasse='$motdepasse' limit 1";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows != 0){
        $row = mysqli_fetch_assoc($result);
        if($row['email']== $email && $row['motdepasse']== $motdepasse ){
            $_SESSION['email']= $row['email'];
            $_SESSION['Id_U']= $row['Id_U'];
            header('Location: profil.php');
            exit();
        } 
        
    }else{
        $email_error = '<p id="error">email ou mot de passe incorrect</p>';
        include_once('connexion.php');
        exit();
    }
}
?>
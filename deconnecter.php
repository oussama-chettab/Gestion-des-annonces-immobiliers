<?php
    session_start();
    include('config.php');
    session_unset();
    session_destroy();
    header('Location: connexion.php');
?>
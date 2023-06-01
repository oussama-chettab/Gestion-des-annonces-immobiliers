<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer mot de passe</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/confirmdp.css">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    <div class="main">
        <form action="" method="post">
        
            <h2>Confirmation de mot de passe par email</h2><br>
            <p1>Entrer votre email ici</p1><br>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <button type="submit" name="reset">Confirmer</button>

        <?php
            include_once('config.php');
        
            if(isset($_POST['reset'])){
                if(isset($_POST['email'])){
                    $email = stripcslashes($_POST['email']);
                    $email = filter_input(INPUT_POST,'email');
                }
                $sql = "SELECT email FROM utilisateur WHERE email ='$email' limit 1 ";
                $result = mysqli_query($conn,$sql);
                $num_rows = mysqli_num_rows($result);

                if($num_rows != 0){
                    $row = mysqli_fetch_assoc($result);
                    if($row['email']=== $email){
                        header('Location: profil.php');
                    }
                }else{
                    echo "<p>Cet email n'est pas enrigistré, réessayez... </p><br>";
                }
            }
        ?>
    </form>
</div>
</body>
</html>
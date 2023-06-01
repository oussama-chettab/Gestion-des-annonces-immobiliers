<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
    <style>
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 92vh;
            margin: 25px 400px;
            border-radius: 10%;
            background-color: rgba(20, 83, 154, 0.9);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        .icon_insc{
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-bottom: 30px;
        }
        .icon_insc img{
            height: 70px;
        }
        input[type="text"],
        input[type="tel"],
        input[type="password"]{
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            border: solid 1px #fff;
            border-radius: 7px;
        }
        input[type="submit"] {
            width: 200px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="Edit.php" method="POST">
        <div class="icon_insc">
           <img src="images/logo_white_large.png" alt="icon"> 
           <h2>MODIFIER</h2>
        </div>
        <input type="text" id="nom" name="nom" placeholder=" Nom"><br>
        <input type="text" id="prenom" name="prenom" placeholder=" Prenom"><br>
        <input type="tel" id="tel" name="tel" placeholder=" Tel (+213)000 000 000" ><br>
        <input type="password" id="motdepasse" name="motdepasse" placeholder=" Mot de passe"><br>
        <input type="submit" value="modifier"><br>
    </form>
</body>
</html>
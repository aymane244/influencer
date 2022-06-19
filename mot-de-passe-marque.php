<?php
    session_start();
    require("db/db.php");
    if(isset($_POST['submit_marque'])){
        $email = $_POST['email_marque'];
        $password = sha1($_POST['password_marque']);
        $query = $db->query("SELECT `mar_email` FROM `marque` WHERE mar_email = '$email'");
        $result = $query->fetch();
        if($result){
            $sql = $db->prepare("UPDATE `marque` SET `mar_password`=? WHERE mar_email = ?");
            $sql->execute(array($password, $email));
            header("location: index.php");
            $_SESSION['status'] = 'Mot de passe a été bien modifié';
        }else{
            $error = "L'email: ".$email. " n'existe pas dans notre base de données";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mot de passe oublié</title>
        <?php include 'css/style.php' ?>
        <style>
            body{
                background-color: #7f53ac;
                background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
            }
        </style>
        <?php include 'js/javascript.php' ?>
    </head>
    <body>
        <?php 
            if(isset($error)){
        ?>
        <div class="div-error">
            <h1 class="center-header"><?php echo $error ?></h1>
        </div>
        <?php   
            unset($error);
            }
        ?>
        <div class="div-center">
            <div class="div-style">
                <div style="font-size:18px; font-weight:bold; margin-bottom:20px;">
                    <a href="index.php" class="link-space">&#8592; Retour</a>
                </div>
                <h2 class="center-header">Mot de passe oublié Marque</h2>
                <form action="" method="POST">
                    <div class="center-form">
                        <div style="margin-top:40px;">
                            <label for="email" class="input-inscription">
                                <input type="email" name="email_marque" id="email" class="input-conn" placeholder="Votre email" required/>
                            </label>
                        </div>
                        <br><br>
                        <div>
                            <label for="password">
                                <input type="password" name="password_marque" id="password" class="input-conn" placeholder="Nouveau mot de passe" required/>
                            </label>
                        </div>
                        <br>
                        <div class="div-btn" style="padding-bottom:20px;">
                            <button type="submit" name="submit_marque" class="btn-submit">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
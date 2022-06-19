<?php
    session_start();
    require("db/db.php");
    if(isset($_POST['submit_admin'])){
        $email = $_POST['email_admin'];
        $password = sha1($_POST['password_admin']);
        $query = $db->query("SELECT `admin_email` FROM `admin` WHERE admin_email = '$email'");
        $result = $query->fetch();
        if($result){
            $sql = $db->prepare("UPDATE `admin` SET `admin_password`= ? WHERE admin_email = ? ");
            $sql->execute(array($password, $email));
            header("location: admin.php");
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
                    <a href="admin.php" class="link-space">&#8592; Retour</a>
                </div>
                <h2 class="center-header">Mot de passe oublié</h2>
                <form action="" method="POST">
                    <div class="center-form">
                        <div style="margin-top:40px;">
                            <label for="email" class="input-inscription">
                                <input type="email" name="email_admin" id="email_admin" class="input-conn" placeholder="Votre email" required/>
                            </label>
                        </div>
                        <br><br>
                        <div>
                            <label for="password">
                                <input type="password" name="password_admin" id="password" class="input-conn" placeholder="Nouveau mot de passe" required/>
                            </label>
                        </div>
                        <br>
                        <div class="div-btn" style="padding-bottom:20px;">
                            <button type="submit" name="submit_admin" class="btn-submit">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
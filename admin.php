<?php
    session_start();
    require("db/db.php");
    if(isset($_POST['submit_admin'])){
        $email = $_POST['email_admin'];
        $password = sha1($_POST['password_admin']);
        $sql= $db->query("SELECT * FROM `admin` WHERE admin_email ='$email' AND admin_password = '$password'");
        $result = $sql->fetch();
        if($result){
            $_SESSION['id_admin'] = $result['admin_id'];
            $_SESSION['email_admin'] = $result['admin_email'];
            $_SESSION['name_admin'] = $result['admin_nom'];
            $_SESSION['firstname_admin'] = $result['admin_prenom'];
            $_SESSION['password_admin'] = $result['admin_password'];
            header("location:espace-admin.php");
        }else{
            $error = "Email ou mot de passe incoreccte";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'css/style.php' ?>
        <style>
            body{
                background-color: #7f53ac;
                background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
            }
        </style>
        <?php include 'js/javascript.php' ?>
        <title>Connexion</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['status'])){
        ?>
        <div class="div-success">
            <h1 class="center-header"><?php echo $_SESSION['status']?></h1>
        </div>
        <?php
            unset($_SESSION['status']);
            }
        ?>
        <?php
            if(isset($error)){
        ?>
        <div class="div-error">
            <h1 class="center-header"><?php echo $error?></h1>
        </div>
        <?php
            unset($error);
            }
        ?>
        <div class="div-center">
            <div class="div-style">
                <h2 class="center-header">Connexion Admin</h2>
                <form action="" method="POST">
                    <div class="center-form">
                        <div style="margin-top:40px;">
                            <label for="email" class="label-inscrirption">
                                <input type="email" name="email_admin" placeholder="Votre email" class="input-conn" id="email" required/>
                            </label>
                        </div>
                        <br><br>
                        <div>
                            <label for="password" class="label-inscrirption">
                                <input type="password" name="password_admin" id="password" class="input-conn" placeholder="Votre mot de passe" required/>
                            </label>
                        </div>
                        <br>
                        <div class="div-btn">
                            <button type="submit" name="submit_admin" class="btn-submit">Se connecter</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="div-links">
                    <a href="inscription-admin.php" class="link-space">Pas de compte inscrivez vous ici</a>
                    <a href="mot-de-passe-admin.php" class="link-space">Mot de passe oublié</a>
                </div>
            </div>
        </div> 
    </body>
</html>
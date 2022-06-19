<?php
    session_start();
    require("db/db.php");
    if(isset($_POST['submit_influenceur'])){
        $email = $_POST['email_influenceur'];
        $password = sha1($_POST['password_influenceur']);
        $sql= $db->query("SELECT * FROM `influenceur` WHERE inf_email ='$email' AND inf_password = '$password'");
        $result = $sql->fetch();
        if($result){
            $_SESSION['id'] = $result['inf_id'];
            $_SESSION['email'] = $result['inf_email'];
            $_SESSION['name'] = $result['inf_nom'];
            $_SESSION['firstname'] = $result['inf_prenom'];
            $_SESSION['password'] = $result['inf_password'];
            header("location:espace-influenceur.php");
        }else{
            $error = "Email ou mot de passe incoreccte";
        }
    }
    if(isset($_POST['submit_marque'])){
        $email = $_POST['email_marque'];
        $password = sha1($_POST['password_marque']);
        $sql= $db->query("SELECT * FROM `marque` WHERE mar_email ='$email' AND mar_password = '$password'");
        $result = $sql->fetch();
        if($result){
                $_SESSION['id_marque'] = $result['mar_id'];
                $_SESSION['email_marque'] = $result['mar_email'];
                $_SESSION['entreprise_marque'] = $result['mar_entreprise'];
                $_SESSION['password_marque'] = $result['mar_password'];
                header("location:espace-marque.php");
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
            <div class="div-position">
                <h3 class="titre" onclick="influenceur()">Vous êtes influenceurs</h3>
                <h3 class="titre" onclick="marque()">Vous êtes une marque</h3>
            </div>
            <div class="div-style" id="influenceur">
                <h2 class="center-header">Connexion Influenceur</h2>
                <form action="" method="POST">
                    <div class="center-form">
                        <div style="margin-top:40px;">
                            <label for="email" class="label-inscrirption">
                                <input type="email" name="email_influenceur" id="email" class="input-conn" placeholder="Votre email" required/>
                            </label>
                        </div>
                        <br><br>
                        <div>
                            <label for="password" class="label-inscrirption">
                                <input type="password" name="password_influenceur" id="password" class="input-conn" placeholder="Votre mot de passe" required/>
                            </label>
                        </div>
                        <br>
                        <div class="div-btn">
                            <button type="submit" name="submit_influenceur" class="btn-submit">Se connecter</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="div-links">
                    <a href="inscription-infleunceur.php" class="link-space">Pas de compte inscrivez vous ici</a>
                    <a href="mot-de-passe-influenceur.php" class="link-space">Mot de passe oublié</a>
                </div>
            </div>
            <div class="div-style" id="marque" style="display: none;">
                <h2 class="center-header">Connexion Marque</h2>
                <form action="" method="POST">
                    <div class="center-form">
                        <div style="margin-top:40px;">
                            <label for="email" class="label-inscrirption">
                                <input type="email" name="email_marque" id="email" class="input-conn" placeholder="Votre email" required/>
                            </label>
                        </div>
                        <br><br>
                        <div>
                            <label for="password" class="label-inscrirption">
                                <input type="password" name="password_marque" id="password" class="input-conn" placeholder="Votre mot de passe" required/>
                            </label>
                        </div>
                        <br>
                        <div class="div-btn">
                            <button type="submit" name="submit_marque" class="btn-submit">Se connecter</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="div-links">
                    <a href="inscription-marque.php" class="link-space">Pas de compte inscrivez vous ici</a>
                    <a href="mot-de-passe-marque.php" class="link-space">Mot de passe oublié</a>
                </div>
            </div>  
        </div> 
    </body>
</html>
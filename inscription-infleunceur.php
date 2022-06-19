<?php 
    require("db/db.php");
    if(isset($_POST['submit_influenceur'])){
        $nom = $_POST['nom_influenceur'];
        $prenom = $_POST['prenom_influenceur'];
        $username = $_POST['username_influenceur'];
        $age = $_POST['age_influenceur'];
        $email = $_POST['email_influenceur'];
        $password = sha1($_POST['password_influenceur']);
        $facebook = $_POST['facebook_influenceur'];
        $instagram = $_POST['instagram_influenceur'];
        $youtube = $_POST['youtube_influenceur'];
        $time = time();
        $image = basename($_FILES['image_influenceur']['name']);
        $allowed = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($image, PATHINFO_EXTENSION); 
        $path = "./images/influenceur/";
        $query = $db->query("SELECT * FROM `influenceur` WHERE inf_email = '$email'");
        $res = $query->fetch();
        if($res){
            $error = "email exite deja";
        }else{
            if(!in_array($ext, $allowed) && $image != ""){
                $error_image = "L'image que vous avez choisit ".$image." est de type ".$ext.
                     "<br>Nous supportons juste les images de type 'jpg, png, jpeg'";
             }else{
                move_uploaded_file($_FILES['image_influenceur']['tmp_name'], $path.$image);
                $sql = $db->prepare("INSERT INTO `influenceur`(`inf_nom`, `inf_prenom`, `inf_username`, `inf_age`, `inf_email`, `inf_password`, 
                `inf_facebook`, `inf_instagram`, `inf_youtube`, `inf_image`, `inf_status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $sql->execute(array($nom, $prenom, $username, $age, $email, $password, $facebook, $instagram, $youtube, $path.$image, $time));
            }
            $_SESSION['status'] = 'Inscription réussite';
            header("location:index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
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
            <?php 
                if(isset($error_image)){
            ?>    
            <div class="div-error">    
                <h1 class="center-header"><?php echo $error_image ?></h1>
            </div>
            <?php   
                unset($error_image);
                }
            ?>
        <div class="div-center">
            <div class="div-style">
                <div style="font-size:18px; font-weight:bold; margin-bottom:20px;">
                    <a href="index.php" class="link-space">&#8592; Retour</a>
                </div>
                <h2 class="center-header">Inscription Influenceur</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="center-form">
                        <div class="space_inputs_inscr">
                            <label for="nom">Votre nom:</label>
                            <input type="text" name="nom_influenceur" id="nom" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="prenom">Votre prénom:</label>
                            <input type="text" name="prenom_influenceur" class="input_inscr" id="prenom" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="username">Votre nom d'utilisateur:</label>
                            <input type="text" name="username_influenceur" class="input_inscr" id="username" required/>
                        </div>
                        <div  class="space_inputs_inscr">
                            <label for="age">Votre âge:</label>
                            <input type="number" min="18" name="age_influenceur" class="input_inscr" id="age" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="email">Votre email:</label>
                            <input type="email" name="email_influenceur" class="input_inscr" id="email" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="password">Votre mot de passe:</label>
                            <input type="password" name="password_influenceur" class="input_inscr" id="password" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="facebook">Votre compte Facebook:</label>
                            <input type="url" name="facebook_influenceur" class="input_inscr" id="facebook" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="instagram">Votre compte Instagram:</label>
                            <input type="url" name="instagram_influenceur" class="input_inscr" id="instagram" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="youtube">Votre chaîne Youtube:</label>
                            <input type="url" name="youtube_influenceur" class="input_inscr" id="youtube" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="image">Votre image (optionnel):</label>
                            <input type="file" name="image_influenceur" class="input_inscr" id="image"/>
                        </div>
                        <br>
                        <div class="div-btn">
                            <button type="submit" name="submit_influenceur" class="btn-submit">S'inscrire</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
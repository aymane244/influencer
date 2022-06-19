<?php 
    require("db/db.php");
    if(isset($_POST['submit_admin'])){
        $nom = $_POST['nom_admin'];
        $prenom = $_POST['prenom_admin'];
        $cin = $_POST['cin_admin'];
        $age = $_POST['age_admin'];
        $email = $_POST['email_admin'];
        $password = sha1($_POST['password_admin']);
        $image = basename($_FILES['image_admin']['name']);
        $allowed = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($image, PATHINFO_EXTENSION); 
        $path = "./images/admin/";
        $query_email = $db->query("SELECT * FROM `admin` WHERE admin_email = '$email'");
        $query_cin = $db->query("SELECT * FROM `admin` WHERE admin_cin = '$cin'");
        $res_email = $query_email->fetch();
        $res_cin = $query_cin->fetch();
        if($res_cin){
            $error = "CIN exite deja";
        }else if($res_email){
            $error = "email exite deja";
        }else{
            if(!in_array($ext, $allowed) && $image != ""){
                $error_image = "L'image que vous avez choisit ".$image." est de type ".$ext.
                     "<br>Nous supportons juste les images de type 'jpg, png, jpeg'";
             }else{
                move_uploaded_file($_FILES['image_admin']['tmp_name'], $path.$image);
                $sql = $db->prepare("INSERT INTO `admin`(`admin_nom`, `admin_prenom`, `admin_cin`, `admin_age`, `admin_email`, `admin_password`, 
                `admin_image`) VALUES (?,?,?,?,?,?,?)");
                $sql->execute(array($nom, $prenom, $cin, $age, $email, $password, $path.$image));
                if($sql){
                    $_SESSION['status'] = 'Inscription réussite';
                    header("location:admin.php");
                }
            }
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
        <div class="div-center">
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
            <div class="div-style">
                <div style="font-size:18px; font-weight:bold; margin-bottom:20px;">
                    <a href="admin.php" class="link-space">&#8592; Retour</a>
                </div>
                <h2 class="center-header">Inscription Admin</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="center-form">
                        <div class="space_inputs_inscr">
                            <label for="nom" class="spaces_3">Votre nom:</label>
                            <input type="text" name="nom_admin" id="nom_admin" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="prenom" class="spaces_2">Votre prénom:</label>
                            <input type="text" name="prenom_admin" id="prenom_admin" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="cin">Votre N°CIN:</label>
                            <input type="text" name="cin_admin" id="cin_admin" class="input_inscr" required/>
                        </div>
                        <div  class="space_inputs_inscr">
                            <label for="age" class="spaces">Votre âge:</label>
                            <input type="number" min="18" name="age_admin" id="age_admin" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="email" class="spaces_4">Votre email:</label>
                            <input type="email" name="email_admin" id="email" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="password" class="spaces_5">Votre mot de passe:</label>
                            <input type="password" name="password_admin" id="password" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="image">Votre image (optionnel):</label>
                            <input type="file" name="image_admin" id="image" class="input_inscr"/>
                        </div>
                        <div class="div-btn">
                            <button type="submit" name="submit_admin" class="btn-submit">S'inscrire</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
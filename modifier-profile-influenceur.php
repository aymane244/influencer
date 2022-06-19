<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->query("SELECT * FROM `influenceur` WHERE inf_id='$id'");
    if(isset($_POST['submit'])){
        $nom = $_POST['nom_influenceur'];
        $prenom = $_POST['prenom_influenceur'];
        $username = $_POST['username_influenceur'];
        $age = $_POST['age_influenceur'];
        $email = $_POST['email_influenceur'];
        $facebook = $_POST['facebook_influenceur'];
        $instagram = $_POST['instagram_influenceur'];
        $youtube = $_POST['youtube_influenceur'];
        $image = basename($_FILES['image_influenceur']['name']);
        $allowed = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($image, PATHINFO_EXTENSION); 
        $path = "./images/influenceur/";
        if(!in_array($ext, $allowed) && $image != ""){
            $error_image = "L'image que vous avez choisit ".$image." est de type ".$ext.
                 "<br>Nous supportons juste les images de type 'jpg, png, jpeg'";
        }else{
            if(move_uploaded_file($_FILES['image_influenceur']['tmp_name'], $path.$image)){
                $sql = $db->prepare("UPDATE `influenceur` SET `inf_nom`=?,`inf_prenom`=?,`inf_username`=?,`inf_age`=?,
                `inf_email`=?,`inf_facebook`=?,`inf_instagram`=?,`inf_youtube`=?,`inf_image`=? WHERE inf_id=?");
                $sql->execute(array($nom, $prenom, $username, $age, $email, $facebook, $instagram, $youtube, $path.$image, $id));
            }else{
                $sql = $db->prepare("UPDATE `influenceur` SET `inf_nom`=?,`inf_prenom`=?,`inf_username`=?,`inf_age`=?,
                `inf_email`=?,`inf_facebook`=?,`inf_instagram`=?,`inf_youtube`=? WHERE inf_id=?");
                $sql->execute(array($nom, $prenom, $username, $age, $email, $facebook, $instagram, $youtube, $id));
            }
            $_SESSION['status'] = "Profile modifié avec succès";
            header("location:profile-influenceur.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier profile</title>
    <?php include 'css/style.php' ?>
    <?php include 'js/javascript.php' ?>
</head>
<body>
    <?php include 'navbar-influenceur.php' ?>
    <div style="padding-top: 100px"></div>
    <div style="text-align:center;">
        <h1 style="margin-bottom:20px;">Modifier profile</h1>
    </div>
        <?php 
            foreach($sql as $rows){
                if($rows['inf_id'] == $_SESSION['id']){
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div style="padding-bottom:40px; margin-left:32%">
                <div style="margin-bottom:20px; padding-left:110px" class="space_inputs_inscr_profile profile-pic">
                    <?php 
                        if($rows['inf_image'] == './images/influenceur/'){
                    ?>
                    <img src="images/unknown_person.jpg">
                    <?php 
                        }else{
                    ?>
                    <img src="<?php echo $rows['inf_image'] ?>"> 
                    <?php 
                        }
                    ?>
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Nom: </label> <br>
                    <input type="text" name="nom_influenceur" id="nom_influenceur" class="input_inscr_profile" value="<?php echo $rows['inf_nom']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Prénom: </label> <br>
                    <input type="text" name="prenom_influenceur" id="prenom_influenceur" value="<?php echo $rows['inf_prenom']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Email: </label> <br>
                    <input type="email" name="email_influenceur" id="email_influenceur" value="<?php echo $rows['inf_email']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Age: </label> <br>
                    <input type="number" name="age_influenceur" id="age_influenceur" value="<?php echo $rows['inf_age']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Nom d'utilisateur: </label> <br>
                    <input type="text" name="username_influenceur" id="username_influenceur" value="<?php echo $rows['inf_username']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Compte facebook: </label> <br>
                    <input type="url" name="facebook_influenceur" id="facebook_influenceur" value="<?php echo $rows['inf_facebook']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Compte Instagram</label> <br>
                    <input type="url" name="instagram_influenceur" id="instagram_influenceur" value="<?php echo $rows['inf_instagram']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Chaîne youtube: </label> <br>
                    <input type="url" name="youtube_influenceur" id="youtube_influenceur" value="<?php echo $rows['inf_youtube']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Image: </label> <br>
                    <input type="file" name="image_influenceur" id="image_influenceur">
                </div>
                <div class="space_inputs_inscr_profile">
                    <button type="submit" name="submit" class="btn-submit">Modifier</button>
                </div>
            </div>
        </form>
        <?php 
                }
            }
        ?>
    
</body>
</html>
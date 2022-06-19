<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_marque']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->query("SELECT * FROM `marque` WHERE mar_id='$id'");
    if(isset($_POST['submit'])){
        $nom = $_POST['nom_marque'];
        $prenom = $_POST['prenom_marque'];
        $entreprise = $_POST['entreprise_marque'];
        $ice = $_POST['ice_marque'];
        $registre = $_POST['rc_marque'];
        $date = $_POST['date_marque'];
        $email = $_POST['email_marque'];
        $site = $_POST['site_marque'];
        $image = basename($_FILES['image_marque']['name']);
        $allowed = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($image, PATHINFO_EXTENSION); 
        $path = "./images/marque/";
        if(!in_array($ext, $allowed) && $image != ""){
            $error_image = "L'image que vous avez choisit ".$image." est de type ".$ext.
                 "<br>Nous supportons juste les images de type 'jpg, png, jpeg'";
        }else{
            if(move_uploaded_file($_FILES['image_marque']['tmp_name'], $path.$image)){
                $sql = $db->prepare("UPDATE `marque` SET `mar_nom`=?,`mar_prenom`=?,`mar_entreprise`=?,`mar_ice`=?,`mar_rc`=?,`mar_date`=?,
                        `mar_email`=?,`mar_site`=?,`mar_image`=? WHERE mar_id=?");
                $sql->execute(array($nom, $prenom, $entreprise, $ice, $registre, $date, $email, $site, $path.$image, $id));
            }else{
                $sql = $db->prepare("UPDATE `marque` SET `mar_nom`=?,`mar_prenom`=?,`mar_entreprise`=?,`mar_ice`=?,
                `mar_rc`=?,`mar_date`=?,`mar_email`=?,`mar_site`=? WHERE mar_id=?");
                $sql->execute(array($nom, $prenom, $entreprise, $ice, $registre, $date, $email, $site, $id));
            }
            $_SESSION['status'] = "profile modifié avec succès";
            header("location:profile-marque.php");
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
    <?php include 'navbar-marque.php' ?>
    <div style="padding-top: 100px"></div>
    <div style="text-align:center;">
        <h1 style="margin-bottom:20px;">Modifier profile</h1>
    </div>
    <?php 
        foreach($sql as $rows){
            if($rows['mar_id'] == $_SESSION['id_marque']){
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div style="padding-bottom:40px; margin-left:32%">
            <div style="margin-bottom:20px; padding-left:110px" class="space_inputs_inscr_profile profile-pic">
                <img src="<?php echo $rows['mar_image'] ?>">  
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Nom du directeur: </label> <br>
                <input type="text" name="nom_marque" id="nom_marque" value="<?php echo $rows['mar_nom']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Prénom du directeur</label> <br>
                <input type="text" name="prenom_marque" id="prenom_marque" value="<?php echo $rows['mar_prenom']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Nom de l'entreprise: </label> <br>
                <input type="text" name="entreprise_marque" id="entreprise_marque" value="<?php echo $rows['mar_entreprise']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Email:</label> <br>
                <input type="email" name="email_marque" id="email_marque" value="<?php echo $rows['mar_email']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">N° ICE:</label> <br>
                <input type="number" name="ice_marque" id="ice_marque" value="<?php echo $rows['mar_ice']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">N° Registre de commerce</label> <br>
                <input type="number" name="rc_marque" id="rc_marque" value="<?php echo $rows['mar_rc']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Date de créaion:</label> <br>
                <input type="date" name="date_marque" id="date_marque" value="<?php echo $rows['mar_date']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Site web</label> <br>
                <input type="url" name="site_marque" id="site_marque" value="<?php echo $rows['mar_site']?>">
            </div>
            <div class="space_inputs_inscr_profile">
                <label for="">Image:</label> <br>
                <input type="file" name="image_marque" id="image_marque">
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
<?php 
    require("db/db.php");
    if(isset($_POST['submit_marque'])){
        $nom = $_POST['nom_marque'];
        $prenom = $_POST['prenom_marque'];
        $entreprise = $_POST['entreprise_marque'];
        $ice = $_POST['ice_marque'];
        $registre = $_POST['registre_marque'];
        $date = $_POST['date_marque'];
        $email = $_POST['email_marque'];
        $site = $_POST['site_marque'];
        $password = sha1($_POST['password_marque']);
        $image = basename($_FILES['image_marque']['name']);
        $time = time();
        $allowed = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($image, PATHINFO_EXTENSION); 
        $path = "./images/marque/";
        $query_email = $db->query("SELECT * FROM `marque` WHERE mar_email = '$email'");
        $query_ice = $db->query("SELECT * FROM `marque` WHERE mar_ice = '$ice'");
        $query_registre = $db->query("SELECT * FROM `marque` WHERE mar_ice = '$registre'");
        $res_email = $query_email->fetch();
        $res_ice = $query_ice->fetch();
        $res_registre = $query_registre->fetch();
        if($res_email){
            $error = " email exite deja";
        }else if($res_ice){
            $error = " ICE exite deja";
        }else if($res_registre){
            $error = " registre de commerce exite deja";
        }else{
            if(!in_array($ext, $allowed) && $image != ""){
                $error_image = "L'image que vous avez choisit ".$image." est de type ".$ext.
                     "<br>Nous supportons juste les images de type 'jpg, png, jpeg'";
             }else{
                move_uploaded_file($_FILES['image_marque']['tmp_name'], $path.$image);
                $sql = $db->prepare("INSERT INTO `marque`(`mar_nom`, `mar_prenom`, `mar_entreprise`, `mar_ice`, `mar_rc`, `mar_date`, `mar_email`,
                `mar_site`, `mar_password`, `mar_image`, `mar_status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $sql->execute(array($nom, $prenom, $entreprise, $ice, $registre, $date, $email, $site, $password, $path.$image, $time));
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
                    <a href="index.php" class="link-space">&#8592; Retour</a>
                </div>
                <h2 class="center-header">Inscription Marque</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="center-form">
                        <div class="space_inputs_inscr">
                            <label for="nom" class="spaces_3">Nom:</label>
                            <input type="text" name="nom_marque" id="nom" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="prenom" class="spaces_2">Prénom:</label>
                            <input type="text" name="prenom_marque" id="prenom" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="entreprise" style="margin-left:8px;">Nom de votre entreprise:</label>
                            <input type="text" name="entreprise_marque" id="entreprise" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="ice" style="margin-left:8px;">N° d'ICE:</label>
                            <input type="number" min="0" name="ice_marque" id="ice" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="registre" style="margin-left:8px;">N° de registre de commerce:</label>
                            <input type="number" min="0" name="registre_marque" id="registre" class="input_inscr" required/>
                        </div>
                        <div  class="space_inputs_inscr">
                            <label for="date" class="spaces">Date de création:</label>
                            <input type="date" name="date_marque" id="date" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="email" class="spaces_4">Adresse email:</label>
                            <input type="email" name="email_marque" id="email" class="input_inscr" required/>
                        </div>
                        <div  class="space_inputs_inscr">
                            <label for="site" class="spaces">Site web:</label>
                            <input type="url" name="site_marque" id="site" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="password" class="spaces_5">Mot de passe:</label>
                            <input type="password" name="password_marque" id="password" class="input_inscr" required/>
                        </div>
                        <div class="space_inputs_inscr">
                            <label for="image">Logo de l'entreprise:</label>
                            <input type="file" name="image_marque" id="image" class="input_inscr" required/>
                        </div>
                        <div class="div-btn">
                            <button type="submit" name="submit_marque" class="btn-submit">S'inscrire</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
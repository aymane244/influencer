<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_marque']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->query("SELECT * FROM `contrat` WHERE con_id='$id'");
    if(isset($_POST['submit'])){
        $nom = $_POST['nom_contrat'];
        $duree = $_POST['duree_contrat'];
        $montant = $_POST['montant_contrat'];
        $description = $_POST['description_contrat'];
        $sql = $db->prepare("UPDATE `contrat` SET `con_nom`=?,`con_duree`=?,`con_montant`=?,
            `con_description`=? WHERE con_id=?");
        $sql->execute(array($nom, $duree, $montant, $description, $id));
        $_SESSION['status'] = "Contrat modifié avec succès";
        header("location:contrat-marque.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Contrat</title>
    <?php include 'css/style.php' ?>
    <?php include 'js/javascript.php' ?>
</head>
<body>
    <?php include 'navbar-marque.php' ?>
    <div style="padding-top: 100px"></div>
    <div style="text-align:center;">
        <h1 style="margin-bottom:20px;">Modifier contrat</h1>
    </div>
        <?php 
            foreach($sql as $rows){
        ?>
        <form action="" method="post">  
            <div class="center-form" style="padding-bottom:40px;">
                <div class="space_inputs_inscr_profile">
                    <label for="">Titre du contrat:</label><br>
                    <input type="text" name="nom_contrat" id="nom_contrat" value="<?php echo $rows['con_nom']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Durée du contrat:</label><br>
                    <input type="text" name="duree_contrat" id="duree_contrat" value="<?php echo $rows['con_duree']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Montant du contrat:</label><br>
                    <input type="number" name="montant_contrat" id="montant_contrat" value="<?php echo $rows['con_montant']?>">
                </div>
                <div class="space_inputs_inscr_profile">
                    <label for="">Déscription du contrat:</label> <br>
                    <textarea name="description_contrat" cols="73" rows="10"><?php echo $rows['con_description']?></textarea>
                </div>
                <div class="space_inputs_inscr_profile">
                    <button type="submit" name="submit" class="btn-submit link-deco">Modifier</button>
                </div>
            </div>
        </form>
        <?php 
            }
        ?>
</body>
</html>
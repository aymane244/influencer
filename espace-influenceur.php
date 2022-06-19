<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $sql = $db->query("SELECT * FROM `marque`");
    if(isset($_POST['submit_suppression'])){
        $id_influenceur = $_POST['id_influenceur'];
        $id_marque = $_POST['id_marque'];
        $message = "inf";
        $sql = $db->prepare("INSERT INTO `suppression`(`sup_infleunceur`, `sup_marque`, `sup_date`, `sup_demande`) VALUES (?,?,?,?)");
        $sql->execute(array($id_influenceur, $id_marque, date("Y-m-d"), $message));
        $_SESSION['status'] = "Demande de suppression envoyé avec succès";
        header("location:espace-influenceur.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon espace</title>
        <?php include 'css/style.php' ?>
        <?php include 'js/javascript.php' ?>
    </head>
    <body>
        <?php include 'navbar-influenceur.php' ?>
        <div style="padding-top: 100px"></div>
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
        <h1 style="margin-bottom: 40px; text-align:center">Les marques inscrits</h1>
        <?php 
            foreach($sql as $rows){
        ?>
        <div class="wrapper">
            <div class="img-area">
                <div class="inner-area"><img src="<?php echo $rows['mar_image'] ?>"></div>
            </div>
            <div class="name">Directeur(ice): <?php echo $rows['mar_prenom'] ?> <?php echo $rows['mar_nom'] ?></div>
            <hr class="horizon" />
            <div class="entreprise">Entreprise: <?php echo $rows['mar_entreprise'] ?></div>
            <hr class="horizon" />
            <div class="email">Email: <?php echo $rows['mar_email'] ?></div>
            <hr class="horizon" />
            <div class="site">Site web: <?php echo $rows['mar_site'] ?></div>
            <hr class="horizon" />
            <p class="contacter">
                <a href="messanger-influenceur.php?id=<?php echo $rows['mar_id'] ?>" class="link_contact">
                    Contacter <?php echo $rows['mar_entreprise'] ?>
                </a>
            </p>
            <form action="" method="POST">
                <input type="hidden" name="id_marque" value="<?php echo $rows['mar_id'] ?>">
                <input type="hidden" name="id_influenceur" value="<?php echo $_SESSION['id'] ?>">
                <button type="submit" name="submit_suppression" class="contacter">Demande de suppression</button>
            </form>
        </div>
        <?php       
            }
        ?>    
    </body>
</html>
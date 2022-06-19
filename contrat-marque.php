
<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_marque']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_SESSION['id_marque'];
    $sql = $db->query("SELECT * FROM `contrat` INNER JOIN `influenceur` ON con_infleunceur=inf_id WHERE con_marque=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrats</title>
    <?php include 'css/style.php' ?>
    <?php include 'js/javascript.php' ?>
</head>
<body>
    <?php include 'navbar-marque.php' ?>
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
    <div style="position: relative; width:100%;">
        <table>
            <thead>
                <tr style="text-align:center; padding: 16px 20px !important;">
                    <th style="padding: 16px 20px !important;">#</th>
                    <th style="padding: 16px 20px !important;">Nom de l'infleunceur</th>
                    <th style="padding: 16px 20px !important;">Titre de contrat</th>
                    <th style="padding: 16px 20px !important;">Durée</th>
                    <th style="padding: 16px 20px !important;">Montant</th>
                    <th style="padding: 16px 20px !important;">Déscription du contrat</th>
                    <th style="padding: 16px 20px !important;">Date d'élaboration de contrat</th>
                    <th style="padding: 16px 20px !important;">Modifier</th>
                    <th style="padding: 16px 20px !important;">Terminer Contrat</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach($sql as $rows){
                ?> 
                <tr style="text-align:center; padding: 16px 20px !important;">
                    <td style="padding: 16px 20px !important;"><?php echo $i++ ?></td>
                    <td style="padding: 16px 20px !important;"><?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></td>
                    <td style="padding: 16px 20px !important;"><?php echo $rows['con_nom'] ?></td>
                    <td style="padding: 16px 20px !important;"><?php echo $rows['con_duree'] ?></td>
                    <td style="padding: 16px 20px !important;"><?php echo $rows['con_montant'] ?></td>
                    <td style="padding: 16px 20px !important;"><?php echo $rows['con_description'] ?></td>
                    <td style="padding: 16px 20px !important;"><?php echo $rows['con_date'] ?></td>
                    <td style="padding: 16px 20px !important;"><a href="modifier-contrat.php?id=<?php echo $rows['con_id'] ?>" class="btn-submit link-deco">Modifier</a></td>
                    <td style="padding: 16px 20px !important;"><a href="terminer-contrat.php?id=<?php echo $rows['con_id'] ?>" onclick='return confirm("Voulez-vous terminer le contrat avec cet infleunceur")' class="btn-submit link-deco">Terminer</a>
                    </td>
                </tr>
                <?php 
                    }
                ?> 
            </tbody>
        </table>
    </div>
</body>
</html>
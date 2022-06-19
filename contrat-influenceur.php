
<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_SESSION['id'];
    $sql = $db->query("SELECT * FROM `contrat` INNER JOIN `marque` ON con_marque=mar_id WHERE con_infleunceur=$id");
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
    <?php include 'navbar-influenceur.php' ?>
    <div style="padding-top: 100px"></div>
    <div style="padding-left:30px; Padding-right:30px;">
        <table>
            <thead>
                <tr style="text-align:center;">
                    <th>#</th>
                    <th>Nom de la marque</th>
                    <th>Titre de contrat</th>
                    <th>Durée</th>
                    <th>Montant</th>
                    <th>Déscription du contrat</th>
                    <th>Date d'élaboration de contrat</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach($sql as $rows){
                ?> 
                <tr style="text-align:center;">
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $rows['mar_entreprise'] ?></td>
                    <td><?php echo $rows['con_nom'] ?></td>
                    <td><?php echo $rows['con_duree'] ?></td>
                    <td><?php echo $rows['con_montant'] ?> MAD</td>
                    <td><?php echo $rows['con_description'] ?></td>
                    <td><?php echo $rows['con_date'] ?></td>
                </tr>
            </tbody>
            <?php 
                }
            ?> 
        </table>
    </div>
</body>
</html>
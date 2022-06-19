<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_marque']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_SESSION['id_marque'];
    $sql = $db->query("SELECT * FROM `marque`");
    $sql_contrat = $db->query("SELECT * FROM `contrat` INNER JOIN `influenceur` ON con_infleunceur=inf_id WHERE con_marque=$id");
    $sql_message = $db->query("SELECT * FROM `message` INNER JOIN `influenceur` ON msg_infleunceur=inf_id WHERE msq_marque=$id 
    GROUP BY inf_id")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css/style.php' ?>
    <?php include 'js/javascript.php' ?>
    <title>Mon profile</title>
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
    <div class="topper" style="text-align:center">  
        <h1>Marque profile</h1>
    </div>
    <div class="container_profile">
        <?php 
            foreach($sql as $rows){
                if($rows['mar_id'] == $_SESSION['id_marque']){
        ?>
        <div class="photo">
            <img src="<?php echo $rows['mar_image'] ?>" style="max-width:250px; max-height:250px">
            <p style="font-size:20px"><b><?php echo $rows['mar_entreprise']?></b></p>
        </div>
        <div style="font-size:20px; font-weight:bold;">
            <p style="margin-top:5px"><i class="fa-solid fa-user"></i> &nbsp; <?php echo $rows['mar_prenom']?> <?php echo $rows['mar_nom']?></p>
            <p style="margin-top:5px"><i class="fa-solid fa-envelope"></i> &nbsp; <?php echo $rows['mar_email']?></p>
            <p style="margin-top:5px"><i class="fa-solid fa-calendar"></i> &nbsp; <?php echo $rows['mar_date']?></p>
            <p style="margin-top:5px"><i class="fa-brands fa-internet-explorer"></i> &nbsp; <a href="<?php echo $rows['mar_site']?>"><?php echo $rows['mar_site']?></a></p>
            <p style="margin-top:5px">N° ICE: <?php echo $rows['mar_ice']?> </p>
            <p style="margin-top:5px">N° registre de commerce: <?php echo $rows['mar_rc']?></p>
            <p style="margin-top:20px"><a href="modifier-profile-marque.php?id=<?php echo $rows['mar_id']?>"class="btn-submit link-deco">Modifier profile</a></p>
            <?php 
                    }
                }
            ?>
        </div>
    </div>
    <div style="position:relative; width:100%; margin-top:50px">
        <div style="background-color:black; color: white; padding-top:10px; padding-bottom:10px; margin-bottom:10px">
            <h1 style="text-align:center">Mes contrats</h1>
        </div>
        <table>
            <thead>
                <tr style="text-align:center">
                    <th>#</th>
                    <th>Nom de l'influenceur</th>
                    <th>Titre de contrat</th>
                    <th>Durée</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach($sql_contrat as $rows){
                ?> 
                <tr style="text-align:center;">
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></td>
                    <td><?php echo $rows['con_nom'] ?></td>
                    <td><?php echo $rows['con_duree'] ?></td>
                    <td><?php echo $rows['con_montant'] ?> MAD</td>
                </tr>
                <?php 
                    }
                ?> 
            </tbody>
        </table>
    </div>
    <div style="position:relative; width:100%; margin-top:50px">
        <div style="background-color:black; color: white; padding-top:10px; padding-bottom:10px; margin-bottom:10px">
            <h1 style="text-align:center">Mes discussions</h1>
        </div>
        <table>
            <thead>
                <tr style="text-align:center">
                    <th>#</th>
                    <th>Nom de l'infleunceur</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach($sql_message as $rows){
                ?> 
                <tr style="text-align:center;">
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></td>
                </tr>
                <?php 
                    }
                ?> 
            </tbody>
        </table>
    </div>
</body>
</html>
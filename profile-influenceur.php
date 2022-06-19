<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_SESSION['id'];
    $sql = $db->query("SELECT * FROM `influenceur`");
    $sql_contrat = $db->query("SELECT * FROM `contrat` INNER JOIN `marque` ON con_marque=mar_id WHERE con_infleunceur=$id");
    $sql_message = $db->query("SELECT * FROM `message` INNER JOIN `marque` ON msq_marque=mar_id WHERE msg_infleunceur=$id 
        GROUP BY mar_id")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css/style.php' ?>
    <?php include 'js/javascript.php' ?>
    <title>Mon profile</title>
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
    <div class="topper" style="text-align:center">
        <h1>Influenceur profile</h1>
    </div>
    <div class="container_profile">
        <?php 
            foreach($sql as $rows){
                if($rows['inf_id'] == $_SESSION['id']){
        ?>
        <div class="photo">
            <?php 
                if($rows['inf_image'] == './images/influenceur/'){
            ?>
            <img src="images/unknown_person.jpg" style="max-width:100px;"></p>
            <?php 
                }else{
            ?> 
            <img src="<?php echo $rows['inf_image'] ?>" style="max-width:250px; max-height:250px">  
            <?php     
                }
            ?>
            <p style="font-size:20px"><b><?php echo $rows['inf_prenom']?> <?php echo $rows['inf_nom']?></b></p>
        </div>
        <div style="font-size:20px; font-weight:bold;">
            <div>

            </div>
            <p style="display:flex; align-items:center"><i class="fa-solid fa-envelope"></i> &nbsp; <?php echo $rows['inf_email']?></p>
            <p style="margin-top:5px;display:flex; align-items:center"><i class="fa-solid fa-cake-candles"></i> &nbsp; <?php echo $rows['inf_age']?> ans</p>
            <p style="margin-top:5px"><i class="fa-solid fa-user"></i> &nbsp; <?php echo $rows['inf_username']?></p>
            <p style="margin-top:5px"><i class="fa-brands fa-facebook"></i> &nbsp; <a href="<?php echo $rows['inf_facebook']?>"><?php echo $rows['inf_facebook']?></a></p>
            <p style="margin-top:5px"><i class="fa-brands fa-instagram"></i> &nbsp; <a href="<?php echo $rows['inf_instagram']?>"><?php echo $rows['inf_instagram']?></a></p>
            <p style="margin-top:5px"><i class="fa-brands fa-youtube"></i> &nbsp; <a href="<?php echo $rows['inf_youtube']?>"><?php echo $rows['inf_youtube']?></a></p>
            <p style="margin-top:20px"><a href="modifier-profile-influenceur.php?id=<?php echo $rows['inf_id']?>" class="btn-submit link-deco">Modifier profile</a></p>
        </div>
        <?php 
                }
            }
        ?>
    </div>
    <div style="position:relative; width:100%; margin-top:50px">
        <div style="background-color:black; color: white; padding-top:10px; padding-bottom:10px; margin-bottom:10px">
            <h1 style="text-align:center">Mes contrats</h1>
        </div>
        <table>
            <thead>
                <tr style="text-align:center">
                    <th>#</th>
                    <th>Nom de la marque</th>
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
                    <td><?php echo $rows['mar_entreprise'] ?></td>
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
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach($sql_message as $rows){
                ?> 
                <tr style="text-align:center;">
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $rows['mar_entreprise'] ?></td>
                </tr>
                <?php 
                    }
                ?> 
            </tbody>
        </table>
    </div>
</body>
</html>
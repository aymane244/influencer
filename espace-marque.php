<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_maruqe']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $sql = $db->query("SELECT * FROM `influenceur`");
    if(isset($_POST['submit_suppression'])){
        $id_influenceur = $_POST['id_influenceur'];
        $id_marque = $_POST['id_marque'];
        $message = "marque";
        $sql = $db->prepare("INSERT INTO `suppression`(`sup_infleunceur`, `sup_marque`, `sup_date`, `sup_demande`) VALUES (?,?,?,?)");
        $sql->execute(array($id_influenceur, $id_marque, date("Y-m-d"), $message));
        header("location:espace-marque.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Mon espace</title>
        <?php include 'css/style.php' ?>
        <?php include 'js/javascript.php' ?>
    </head>
    <body>
        <?php include 'navbar-marque.php' ?>
        <div style="padding-top: 100px"></div>
        <h1 style="margin-bottom: 40px; text-align:center">Les influenceurs inscrits</h1>
        <?php 
            foreach($sql as $rows){
        ?>
        <div class="wrapper">
            <div class="img-area">
                <div class="inner-area">
                    <?php
                        if($rows['inf_image'] == './images/influenceur/'){
                    ?>
                    <img src="images/unknown_person.jpg" style="max-width:200px; max-height:150px;"> <br>
                    <?php       
                        }else{
                    ?> 
                    <img src="<?php echo $rows['inf_image'] ?>" style="max-width:200px; max-height:150px;"> <br>
                    <?php        
                        }
                    ?>
                </div>
            </div>
            <div class="name">Nom: <?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></div>
            <hr class="horizon" />
            <div class="name">Âge: <?php echo $rows['inf_age'] ?></div>
            <hr class="horizon" />
            <div class="name">Email: <?php echo $rows['inf_email'] ?></div>
            <hr class="horizon" />
            <button class="contacter">Résaux sociaux</button>
            <div class="social-icons">
                <a href="<?php echo $rows['inf_facebook'] ?>" class="fb"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo $rows['inf_instagram'] ?>" class="insta"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo $rows['inf_youtube'] ?>" class="insta"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="contacter">
                <a href="messanger-marque.php?id=<?php echo $rows['inf_id'] ?>" class="link_contact">
                    Contacter <?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?>
                </a>
            </p>
            <form action="" method="POST">
                <input type="hidden" name="id_influenceur" value="<?php echo $rows['inf_id'] ?>">
                <input type="hidden" name="id_marque" value="<?php echo $_SESSION['id_marque'] ?>">
                <button type="submit" name="submit_suppression" class="contacter">Demande de suppression</button>
            </form>
        </div>
        <?php       
            }
        ?>
    </body>
</html>
<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->query("SELECT * FROM `admin` WHERE admin_id='$id'");
    if(isset($_POST['submit_admin'])){
        $nom = $_POST['nom_admin'];
        $prenom = $_POST['prenom_admin'];
        $email = $_POST['email_admin'];
        $age = $_POST['age_admin'];
        $cin = $_POST['cin_admin'];
        $image = basename($_FILES['image_admin']['name']);
        $allowed = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($image, PATHINFO_EXTENSION); 
        $path = "./images/admin/";
        if(!in_array($ext, $allowed) && $image != ""){
            $error_image = "L'image que vous avez choisit ".$image." est de type ".$ext.
                 "<br>Nous supportons juste les images de type 'jpg, png, jpeg'";
        }else{
            if(move_uploaded_file($_FILES['image_admin']['tmp_name'], $path.$image)){
                $sql = $db->prepare("UPDATE `admin` SET `admin_nom`=?,`admin_prenom`=?,`admin_cin`=?,
                `admin_age`=?,`admin_email`=? ,`admin_image`=? WHERE admin_id=?");
                $sql->execute(array($nom, $prenom, $cin, $age, $email, $path.$image, $id));
            }else{
                $sql = $db->prepare("UPDATE `admin` SET `admin_nom`=?,`admin_prenom`=?,`admin_cin`=?,
                `admin_age`=?,`admin_email`=? WHERE admin_id=?");
                $sql->execute(array($nom, $prenom, $cin, $age, $email, $id));
            }
            $_SESSION['status'] = "Profile modifié avec succès";
            header("location:profile-admin.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier profile</title>
    <?php include 'css/style-admin.php' ?>
</head>
<body>
<?php include 'navbar-admin.php' ?>
    <div class="main-content">
        <main style="margin-top: 1px !important;">
            <h1 style="color:black; text-align:center">Page Profile</h1>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card" style="height:530px;">
                        <?php 
                            foreach($sql as $rows){
                                if($rows['admin_id'] == $_SESSION['id_admin']){
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div style="text-align:center; padding-top:20px">
                                <?php 
                                    if($rows['admin_image'] == './images/admin/'){
                                ?>
                                <img src="images/unknown_person.jpg" style="max-width:200px; max-height:150px; border-radius:50%">
                                <?php 
                                    }else{
                                ?> 
                                <img src="<?php echo $rows['admin_image'] ?>" style="max-width:200px; max-height:150px; border-radius:50%">
                                <?php 
                                    }
                                ?>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <div class="col-3">
                                        <label for="">Nom: </label>
                                        <input type="text" name="nom_admin" id="nom_admin" class="effect-1" value="<?php echo $rows['admin_nom']?>">
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Prénom: </label>
                                        <input type="text" name="prenom_admin" id="prenom_admin" class="effect-1" value="<?php echo $rows['admin_prenom']?>">
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col-3">
                                        <label for="">Email: </label>
                                        <input type="email" name="email_admin" id="email_admin" class="effect-1" value="<?php echo $rows['admin_email']?>">
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Age: </label>
                                        <input type="number" name="age_admin" id="age_admin" class="effect-1" value="<?php echo $rows['admin_age']?>">
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col-3">
                                        <label for="">CIN: </label>
                                        <input type="text" name="cin_admin" id="cin_admin" class="effect-1" value="<?php echo $rows['admin_cin']?>">
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Age: </label>
                                        <input type="file" name="image_admin" id="image_admin" class="effect-1">
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div style="text-align:center">
                                <button type="submit" name="submit_admin"  class="btn-submit">Modifier</button>  
                                </div>
                                   
                            </div>
                        </form>
                        <?php 
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>        
        </main>
    </div> 
</body>
</html>
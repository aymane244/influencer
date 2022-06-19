<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_SESSION['id_admin'];
    $sql = $db->query("SELECT * FROM `admin` WHERE admin_id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profile</title>
    <?php include 'css/style-admin.php' ?>
</head>
<body>
<?php include 'navbar-admin.php' ?>
    <div class="main-content">
        <main style="margin-top: 1px !important;">
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
            <h1 style="color:black; text-align:center">Page Profile</h1>
            <div class="recent-grid" style="width:50% !important; margin-right:auto; margin-left:auto;">
                <div class="projects">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile">
                                <?php 
                                    foreach($sql as $rows){
                                ?> 
                                <div class="profile-pic">
                                    <div class="header-color"></div>
                                    <?php 
                                        if($rows['admin_image'] == './images/admin/'){
                                    ?>
                                    <img src="images/unknown_person.jpg">
                                    <?php 
                                        }else{
                                    ?> 
                                    <img src="<?php echo $rows['admin_image'] ?> " alt="Profile Picture">
                                    <?php 
                                        }
                                    ?>
                                </div>
                                <div class="title">
		                            <h1>Nom: <?php echo $rows['admin_prenom'] ?> <?php echo $rows['admin_nom'] ?></h1>
                                    <h1>Age: <?php echo $rows['admin_age'] ?></h1>
                                    <h1>CIN: <?php echo $rows['admin_cin'] ?></h1>
                                    <h1>Email: <?php echo $rows['admin_email'] ?></h1>
                                    <h1><a href="modifier-profile-admin.php?id=<?php echo $rows['admin_id'] ?>">Modifier Profile</a></h1>
	                            </div>
                                <?php 
                                    }
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </main>
    </div> 
</body>
</html>
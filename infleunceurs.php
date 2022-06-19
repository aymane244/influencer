<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $sqlInf = $db->query("SELECT * FROM `influenceur`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infleunceurs</title>
    <?php include 'css/style-admin.php' ?>
</head>
<body>
    <?php include 'navbar-admin.php' ?>
    <div class="main-content">
        <main style="margin-top: 1px !important;">
        <h1 style="color:black; text-align:center">Page Influenceurs</h1>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h2>Liste des Infleunceurs</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom Prénom</th>
                                            <th>Age</th>
                                            <th>Nom d'utilisateur</th>
                                            <th>Email</th>
                                            <th>Pages facebook</th>
                                            <th>Chaine Youtube</th>
                                            <th>Page Instagram</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $k = 1;
                                            foreach($sqlInf as $rows){
                                        ?>
                                        <tr>
                                            <td><?php echo $k++ ?></td>
                                            <td><?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></td>
                                            <td><?php echo $rows['inf_age'] ?></td>
                                            <td><?php echo $rows['inf_username'] ?></td>
                                            <td><?php echo $rows['inf_email'] ?></td>
                                            <td><?php echo $rows['inf_facebook'] ?></td>
                                            <td><?php echo $rows['inf_youtube'] ?></td>
                                            <td><?php echo $rows['inf_instagram'] ?></td>
                                            <td>
                                                <?php 
                                                    if($rows['inf_image'] == './images/influenceur/'){
                                                ?>
                                                <img src="images/unknown_person.jpg" width="40px" height="40px" alt="profile-img"></p>
                                                <?php 
                                                    }else{
                                                ?> 
                                                <img src="<?php echo $rows['inf_image'] ?>" width="40px" height="40px" alt="profile-img">  
                                                <?php     
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </main>
    </div>  
</body>
</html>
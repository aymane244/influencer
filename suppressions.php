<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $sql_marque = $db->query("SELECT * FROM `suppression` INNER JOIN `marque` ON sup_marque=mar_id WHERE sup_demande='inf' ");
    $sql_inf = $db->query("SELECT * FROM `suppression` INNER JOIN `influenceur` ON sup_infleunceur=inf_id WHERE sup_demande='marque'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression</title>
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
            <h1 style="color:black; text-align:center">Page Suppressions</h1>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h2>Liste des Marques à supprimer</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom Prénom</th>
                                            <th>Nom de l'entreprise</th>
                                            <th>Email</th>
                                            <th>Logo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($sql_marque as $rows){
                                        ?> 
                                        <tr style="text-align:center">
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $rows['mar_prenom'] ?> <?php echo $rows['mar_nom'] ?></td>
                                            <td><?php echo $rows['mar_entreprise'] ?></td>
                                            <td><?php echo $rows['mar_email'] ?></td>
                                            <td><img src="<?php echo $rows['mar_image'] ?>" width="40px" height="40px" alt="profile-img">  </td>
                                            <td><a href="supprimer-marque.php?id=<?php echo $rows['sup_marque'] ?>" onclick="return confirm('Voulez-vous supprimer cette marque')" style="margin-left:45px">Supprimer</a></td>
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
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h2>Liste des Influenceurs à supprimer</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom Prénom</th>
                                            <th>Age</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($sql_inf as $rows){
                                        ?> 
                                        <tr style="text-align:center">
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></td>
                                            <td><?php echo $rows['inf_age'] ?></td>
                                            <td><?php echo $rows['inf_email'] ?></td>
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
                                            <td><a href="supprimer-influenceur.php?id=<?php echo $rows['sup_infleunceur'] ?>" onclick="return confirm('Voulez-vous supprimer cet infeunceur')" style="margin-left:95px">Supprimer</a></td>
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
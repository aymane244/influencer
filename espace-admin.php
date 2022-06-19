<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_SESSION['id_admin'];
    $sqlMarque = $db->query("SELECT COUNT(mar_id) AS 'totalMarques' FROM `marque`")->fetchColumn();
    $sqlInfluenceur = $db->query("SELECT COUNT(inf_id) AS 'totalInfluenceurs' FROM `influenceur`")->fetchColumn();
    $sqlContrat = $db->query("SELECT COUNT(con_id) AS 'totalContrat' FROM `contrat`")->fetchColumn();
    $sqlsupp = $db->query("SELECT COUNT(sup_id) AS 'totalSup' FROM `suppression`")->fetchColumn();
    $sqlAdmin = $db->query("SELECT * FROM `admin` WHERE admin_id=$id");
    $sqlInfLimit = $db->query("SELECT * FROM `influenceur`LIMIT 10");
    $sqlMarqueLimit = $db->query("SELECT * FROM `marque`LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mon espace</title>
    <?php include 'css/style-admin.php' ?>
</head>
<body>
<?php include 'navbar-admin.php' ?>
<div class="main-content">
    <header>
        <h2>
            <label for="nav-toggle">
                <span class="fas fa-bars"></span>
            </label>
            Dashboard
        </h2>
        <div class="user-wrapper">
            <?php
                foreach($sqlAdmin as $item){
            ?>
            <?php 
                if($item['admin_image'] == './images/admin/'){
            ?>
            <img src="images/unknown_person.jpg" width="40px" height="40px" alt="profile-img"></p>
            <?php 
                }else{
            ?> 
            <img src="<?php echo $item['admin_image'] ?>" width="40px" height="40px" alt="profile-img">  
            <?php     
                }
            ?>
            <div class="">
                <h4><?php echo $item['admin_prenom'] ?> <?php echo $item['admin_nom'] ?></h4>
                <?php
                    }
                ?>
                <small>Admin</small>
            </div>
        </div>
    </header>
    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1><?php echo $sqlMarque ?></h1>
                    <span>Nombre des marques</span>
                </div>
                <div>
                    <span class="fa-solid fa-briefcase"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php echo $sqlInfluenceur ?></h1>
                    <span>Nombre des influenceurs</span>
                </div>
                <div>
                    <span class="fas fa-users"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php echo $sqlContrat ?></h1>
                    <span>Nombre des contrats élaborés</span>
                </div>
                <div>
                    <span class="fas fa-clipboard-list"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1><?php echo $sqlsupp ?></h1>
                    <span>Demande de suppression</span>
                </div>
                <div>
                    <span class="fa-solid fa-trash"></span>
                </div>
            </div>
        </div>
        <div class="recent-grid">
            <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h2>Les 10 derniers inscriptions influenceurs</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Nom</td>
                                        <td>Age</td>
                                        <td>email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $j = 1;
                                        foreach($sqlInfLimit as $item){
                                    ?>
                                    <tr>
                                        <td><?php echo $j++ ?></td>
                                        <td><?php echo $item['inf_prenom'] ?> <?php echo $item['inf_nom'] ?></td>
                                        <td><?php echo $item['inf_age'] ?></td>
                                        <td><?php echo $item['inf_email'] ?></td>
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
                        <h2>Les 10 derniers inscriptions marque</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Nom</td>
                                        <td>Age</td>
                                        <td>email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        foreach($sqlMarqueLimit as $item){
                                    ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $item['mar_entreprise'] ?></td>
                                        <td><a href="<?php echo $item['mar_site'] ?>"><?php echo $item['mar_site'] ?></a></td>
                                        <td><?php echo $item['mar_email'] ?></td>
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
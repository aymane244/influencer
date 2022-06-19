<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $sql = $db->query("SELECT * FROM `marque`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marques</title>
    <?php include 'css/style-admin.php' ?>
</head>
<body>
<?php include 'navbar-admin.php' ?>
    <div class="main-content">
        <main style="margin-top: 1px !important;">
            <h1 style="color:black; text-align:center">Page Marques</h1>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h2>Liste des Marques</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom Prénom</th>
                                            <th>Nom de l'entreprise</th>
                                            <th>Date de création</th>
                                            <th>Email</th>
                                            <th>N° registre de commerce</th>
                                            <th>N° ICE</th>
                                            <th>Site web</th>
                                            <th>Logo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($sql as $rows){
                                        ?> 
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $rows['mar_prenom'] ?> <?php echo $rows['mar_nom'] ?></td>
                                            <td><?php echo $rows['mar_entreprise'] ?></td>
                                            <td><?php echo $rows['mar_date'] ?></td>
                                            <td><?php echo $rows['mar_email'] ?></td>
                                            <td><?php echo $rows['mar_rc'] ?></td>
                                            <td><?php echo $rows['mar_ice'] ?></td>
                                            <td><?php echo $rows['mar_site'] ?></td>
                                            <td><img src="<?php echo $rows['mar_image'] ?>" width="40px" height="40px" alt="profile-img">  </td>
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
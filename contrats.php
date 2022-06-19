
<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $sql_cont = $db->query("SELECT * FROM `contrat` INNER JOIN `influenceur` ON con_infleunceur=inf_id INNER JOIN `marque` ON con_marque=mar_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrats</title>
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
            <h1 style="color:black; text-align:center">Page Contrats</h1>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h2>Liste des Contrats</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom de l'infleunceur</th>
                                            <th>Nom de la marque</th>
                                            <th>Titre de contrat</th>
                                            <th>Durée</th>
                                            <th>Montant</th>
                                            <th>Déscription du contrat</th>
                                            <th>Date d'élaboration de contrat</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($sql_cont as $rows){
                                        ?> 
                                        <tr style="text-align:center;">
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $rows['inf_prenom'] ?> <?php echo $rows['inf_nom'] ?></td>
                                            <td><?php echo $rows['mar_entreprise'] ?></td>
                                            <td><?php echo $rows['con_nom'] ?></td>
                                            <td><?php echo $rows['con_duree'] ?></td>
                                            <td><?php echo $rows['con_montant'] ?></td>
                                            <td><?php echo $rows['con_description'] ?></td>
                                            <td><?php echo $rows['con_date'] ?></td>
                                            <td>
                                                <a href="supprimer-contrat.php?id=<?php echo $rows['con_id'] ?>" onclick='return confirm("Voulez-vous supprimer ce contrat")'>Supprimer le contrat</a>
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
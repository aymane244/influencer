<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_marque']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id_session = $_SESSION['id_marque'];
    @$id = $_GET['id'];
    $sql = $db->query("SELECT * FROM `influenceur`");
    if(isset($_POST['envoyer'])){
        $id_sender = $_SESSION['id_marque'];
        $id_receiver = $_GET['id'];
        $message = $_POST['message'];
        $send = "marque";
        $sql = $db->prepare("INSERT INTO `message`(`msg_infleunceur`, `msq_marque`, `msg_inf`, `msg_sender`, `msg_date`) VALUES (?,?,?,?,?)");
        $sql->execute(array($id_receiver, $id_sender, $message, $send, date('Y-m-d H:i')));
        header("location:messanger-marque.php?id=".$id_receiver);
    }
    if(isset($_POST['submit_contrat'])){
        $id_marque = $_SESSION['id_marque'];;
        $id_influenceur = $_GET['id'];
        $nom = $_POST['nom_contrat'];
        $duree = $_POST['durée_contrat'];
        $montant = $_POST['montant_contrat'];
        $description = $_POST['description_contrat'];
        $sql = $db->prepare("INSERT INTO `contrat`(`con_marque`, `con_infleunceur`, `con_nom`, `con_duree`, `con_montant`, `con_description`, 
                `con_date`) VALUES (?,?,?,?,?,?,?)");
        $sql->execute(array($id_marque, $id_influenceur, $nom, $duree, $montant, $description, date('Y-m-d')));
        header("location:messanger-marque.php?id=".$id_influenceur);
        $_SESSION['status'] = "Contrat élaboré avec sucèss";
    }
    $sql_contrat = $db->query("SELECT * FROM `contrat` WHERE con_marque=@$id AND con_infleunceur=$id_session");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chatroom</title>
        <?php include 'css/style.php' ?>
        <?php include 'js/javascript.php' ?>
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
            }
        ?>
        <div class="container">
            <div class="div-position-mesenger">
                <div class="bg-contact" style="overflow-y: scroll !important; height:490px !important;">
                    <h1 style="text-align:center; margin-bottom: 30px;">Contacts</h1>
                    <?php
                        foreach($sql as $rows){
                    ?>
                    <div style="padding-left:10px; margin-bottom: 30px; font-size:18px; display:flex; align-items:center" class="user-wrapper">
                        <?php
                            if($rows['inf_image'] == './images/influenceur/'){
                        ?>
                        <img src="images/unknown_person.jpg" style="margin-right:10px;" width="40px" height="40px">
                        <?php       
                            }else{
                        ?> 
                        <img src="<?php echo $rows['inf_image'] ?>" style="margin-right:10px;" width="40px" height="40px">
                        <?php        
                           }
                        ?>
                        <a href="messanger-marque.php?id=<?php echo $rows['inf_id'] ?>" class="contacts">
                            <?php echo $rows['inf_prenom']?> <?php echo $rows['inf_nom']?>
                        </a>
                    </div> 
                    <?php       
                        }
                    ?>
                </div>
                <div style="width:60%;">
                    <h1 style="text-align:center">Messages</h1>
                    <?php
                        if(isset($_GET['id'])){  
                            $sql = $db->query("SELECT * FROM `influenceur` WHERE inf_id='$id'");
                                foreach($sql as $rows){   
                    ?>
                    <h2 style="text-align:center">Vous êtes en discussion avec <?php echo $rows['inf_prenom']?> <?php echo $rows['inf_nom']?></h2>
                    <?php    
                            }   
                        }
                    ?>
                    <div style="overflow-y: scroll !important; height:400px !important;">
                        <?php
                            if(isset($_GET['id'])){
                                $sql_sender = $db->query("SELECT * FROM `message` INNER JOIN `influenceur` ON msg_infleunceur=inf_id
                                INNER JOIN `marque` ON msq_marque=mar_id WHERE msg_infleunceur=$id 
                                AND msq_marque=$id_session ORDER BY 'msg_inf' DESC");
                                foreach($sql_sender as $rows){
                                    if($rows['msg_sender'] == 'marque'){
                        ?> 
                        <div class="message">
                            <!-- <img src="<?php echo $rows['mar_image']?>" class="img-chat" alt="sdsq"> -->
                            <div style="margin-bottom: 8px;"><b><?php echo $rows['mar_entreprise']?></b></div>
                            <div class="my_message"><?php echo $rows['msg_inf']?></div>
                            <div style="font-size:12px; color:grey; margin-left:5px; margin-top:5px;"><?php echo date("H:i", strtotime($rows['msg_date']))?></div>
                        </div>
                        <?php    
                                    }else if($rows['msg_sender'] == 'influenceur'){
                        ?>
                        <div class="message" style="position:relative;">
                            <!-- <img src="<?php echo $rows['inf_image']?>" class="img-chat-receiver" alt="sdsq"> -->
                            <div style="position:relative; margin-left:73%; margin-bottom:8px;"><b><?php echo $rows['inf_prenom'].' '.$rows['inf_nom']?></b></div>
                            <div class="other_message"><?php echo $rows['msg_inf']?></div>
                            <div style="font-size:12px; color:grey; margin-top:5px; position:relative; margin-left:73%;"><?php echo date("H:i", strtotime($rows['msg_date']))?></div>
                        </div> 
                        <?php
                                    }            
                                }
                        ?>
                        <div style="text-align:center">
                            <button id="modal-btn" onclick="afficher()" class="btn-submit">Elaborer un contrat</button>
                        </div>
                        <?php
                            }else{
                        ?>
                        <h1 style="text-align:center; margin-top:180px">Veuillez choisir un contact</h1> 
                        <?php
                            }
                        ?>
                    </div>
                    <div class="div-margin">
                        <form action="" method="POST">
                            <div class="publisher bt-1 border-light" id="fixed">
                                <input class="publisher-input" type="text" placeholder="Ecrivez votre message" name="message">  
                                <button type ="submit" class="btn btn-primary publisher-btn" id="btn-send" name="envoyer">Envoyer</button>
                            </div>
                        </form>
                    </div>
                    <div id="modal" class="modal">
                        <div class="modal-content" style="overflow-y: scroll !important;height:500px !important;">
                            <span class="close" onclick="fermer()">&times;</span>
                            <h2 style="text-align:center; margin-top:10px; margin-bottom:10px;">Elaboration du contrat</h2>
                            <form action="" method="post">
                            <div class="space_inputs_inscr">
                                <label for="">Nom du contart:</label> <br>
                                <input type="text" name="nom_contrat" class="input_inscr" style="width: 80%;" required>
                            </div>
                            <div class="space_inputs_inscr">
                                <label for="">Durée du contart</label> <br>
                                <input type="text" name="durée_contrat" class="input_inscr" style="width: 80%;" required>
                            </div>
                            <div class="space_inputs_inscr">
                                <label for="">Montant</label> <br>
                                <input type="number" min="1000" step="100" name="montant_contrat" placeholder="1000" class="input_inscr" style="width: 80%;" required> <br>
                            </div>
                            <div class="space_inputs_inscr">
                                <label for="">Description</label> <br>
                                <textarea name="description_contrat" cols="30" rows="10" class="input_inscr" style="width: 80%;" required></textarea>
                            </div>
                            <div class="space_inputs_inscr">
                                <button type="submit" name="submit_contrat" class="btn-submit">Valider</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php 
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id_session = $_SESSION['id'];
    $sql = $db->query("SELECT * FROM `marque`");
    if(isset($_POST['envoyer'])){
        $id_receiver = $_GET['id'];
        $id_sender = $_SESSION['id'];
        $message = $_POST['message'];
        $sender = "influenceur";
        $sql = $db->prepare("INSERT INTO `message`(`msg_infleunceur`, `msq_marque`, `msg_inf`, `msg_sender`, `msg_date`) VALUES (?,?,?,?,?)");
        $sql->execute(array($id_sender, $id_receiver, $message, $sender, date('Y-m-d H:i')));
        header("location:messanger-influenceur.php?id=".$id_receiver);
    }
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
        <?php include 'navbar-influenceur.php' ?>
        <div style="padding-top: 100px"></div>
        <div class="container">
            <div class="div-position-mesenger">
                <div class="bg-contact" style="overflow-y: scroll !important;  height:490px !important;">
                    <h1 style="text-align:center; margin-bottom: 30px;">Contacts</h1>
                    <?php
                        foreach($sql as $rows){
                    ?>
                    <div style="padding-left:10px; margin-bottom: 30px; font-size:18px; display:flex; align-items:center" class="user-wrapper">
                        <img src="<?php echo $rows['mar_image']?>" style="margin-right:10px;" width="40px" height="40px">
                        <a href="messanger-influenceur.php?id=<?php echo $rows['mar_id'] ?>" class="contacts"><?php echo $rows['mar_entreprise']?></a>    
                    </div> 
                    <?php       
                        }
                    ?>
                </div>
                <div style="width:60%;">
                    <h1 style="text-align:center">Messages</h1> <br>
                    <?php
                        @$id = $_GET['id'];
                        if(isset($_GET['id'])){  
                            $sql = $db->query("SELECT * FROM `marque` WHERE mar_id='$id'");
                                foreach($sql as $rows){   
                    ?>
                    <h2 style="text-align:center">Vous êtes en discussion avec <?php echo $rows['mar_entreprise']?></h2>
                    <?php    
                            }   
                        }
                    ?>
                    <div style="overflow-y: scroll !important; height:400px !important;">
                        <?php
                            if(isset($_GET['id'])){
                                $sql_sender = $db->query("SELECT * FROM `message` INNER JOIN `influenceur` ON msg_infleunceur=inf_id
                                            INNER JOIN `marque` ON msq_marque=mar_id WHERE msg_infleunceur=$id_session 
                                            AND msq_marque=$id ORDER BY 'msg_inf' DESC");
                                foreach($sql_sender as $rows){
                                    if($rows['msg_sender'] == 'influenceur'){
                        ?> 

                        <div class="message">
                            <!-- <img src="<?php echo $rows['inf_image']?>" class="img-chat" alt="sdsq"> -->
                            <div style="margin-bottom: 8px; margin-left:5px;"><b><?php echo $rows['inf_prenom']?></b></div>
                            <div class="my_message"><?php echo $rows['msg_inf']?></div>
                            <div style="font-size:12px; color:grey; margin-left:5px; margin-top:5px;"><?php echo date("H:i", strtotime($rows['msg_date']))?></div>
                        </div>
                        <?php 
                                    }else if($rows['msg_sender'] == 'marque'){
                        ?>
                        <div class="message" style="position:relative;">
                            <!-- <img src="<?php echo $rows['mar_image']?>" class="img-chat" alt="sdsq"> -->
                            <div style="position:relative; margin-left:73%; margin-bottom:8px;"><b><?php echo $rows['mar_prenom']?></b></div>
                            <div class="other_message"><?php echo $rows['msg_inf']?></div>
                            <div style="font-size:12px; color:grey; margin-top:5px; position:relative; margin-left:73%;"><?php echo date("H:i", strtotime($rows['msg_date']))?></div>
                        </div> 
                        <?php               
                                    } 
                            }
                        ?> 
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
                                <input class="publisher-input" type="text" placeholder="Votre message" name="message">  
                                <button type ="submit" class="btn btn-primary publisher-btn" id="btn-send" name="envoyer">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
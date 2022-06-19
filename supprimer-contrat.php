<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_marque']) && !isset($_SESSION['password_marque'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->prepare("DELETE FROM `contrat` WHERE con_id=?");
    $sql->execute(array($id));
    header("location:contrats.php");
    $_SESSION['status'] = "Contrat supprimé avec succès";
?>
<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->prepare("DELETE FROM `marque` WHERE mar_id=?");
    $sql->execute(array($id));
    $_SESSION['status'] = "Marque supprimée avec succès";
    header("location:suppressions.php");
?>
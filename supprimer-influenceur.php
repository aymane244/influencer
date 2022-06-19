<?php
    session_start();
    require("db/db.php");
    if(!isset($_SESSION['email_admin']) && !isset($_SESSION['password_admin'])){
        echo "<script>window.location.href='index.php'</script>";
    }
    $id = $_GET['id'];
    $sql = $db->prepare("DELETE FROM `influenceur` WHERE inf_id=?");
    $sql->execute(array($id));
    $_SESSION['status'] = "Influenceur supprimé avec succès";
    header("location:suppressions.php");
?>
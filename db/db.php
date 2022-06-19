<?php
    $server = 'mysql:host=localhost;dbname=projet';
    $user = 'root';
    $password = '';
    try{
        $db=new PDO($server, $user, $password);
    }catch (Exception $e) {
        echo $e->getMessage();
    }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("set names utf8");
?>
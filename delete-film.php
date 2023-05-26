<?php
    $id = $_GET["id"];
    
    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $mysql->query("DELETE FROM `seansi` WHERE `FilmaID` = '$id' ");
    $mysql->query("DELETE FROM `filmas` WHERE `FilmaID` = '$id' ");

    $mysql->close();

    header('Location: filmu-katalogs.php');
?>
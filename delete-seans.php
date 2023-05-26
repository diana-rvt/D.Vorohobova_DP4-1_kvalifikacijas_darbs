<?php
    $id = $_GET["id"];
    
    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $mysql->query("DELETE FROM `seansi` WHERE `SeanssID` = '$id' ");

    $mysql->close();

    header('Location: seansi.php');
?>
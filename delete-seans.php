<?php
    $id = $_GET["id"];
    
    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
    $mysql->query("DELETE FROM `seansi` WHERE `SeanssID` = '$id' ");

    $mysql->close();

    header('Location: seansi.php');
?>
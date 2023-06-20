<?php
    $id = $_GET["id"];
    
    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
    $mysql->query("DELETE FROM `atlaides` WHERE `AtlaideID` = '$id' ");

    $mysql->close();

    header('Location: piedavajumi.php');
?>
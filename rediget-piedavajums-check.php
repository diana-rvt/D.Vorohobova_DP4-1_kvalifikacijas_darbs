<?php
    $nosaukums = filter_var(trim($_POST['nosaukums']),
    FILTER_SANITIZE_STRING);
    $film_name = filter_var(trim($_POST['film-name']),
    FILTER_SANITIZE_STRING);
    $apraksts = filter_var(trim($_POST['apraksts']),
    FILTER_SANITIZE_STRING);
    $procents = filter_var(trim($_POST['number']),
    FILTER_SANITIZE_STRING);

    $id = $_GET['id'];
    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');

    $mysql->query("UPDATE `atlaides`
    SET `Nosaukums` = '$nosaukums', 
    `Apraksts` = '$apraksts', 
    `Procents` = '$procents',
    `FilmaID` = '$film_name'
    WHERE AtlaideID = '$id';");


    $mysql->close();

    header('Location: piedavajumi.php');
?>
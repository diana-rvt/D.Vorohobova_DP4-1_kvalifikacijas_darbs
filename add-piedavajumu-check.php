<?php
    $nosaukums = filter_var(trim($_POST['nosaukums']),
    FILTER_SANITIZE_STRING);
    $film_name = filter_var(trim($_POST['film-name']),
    FILTER_SANITIZE_STRING);
    $apraksts = filter_var(trim($_POST['apraksts']),
    FILTER_SANITIZE_STRING);
    $procents = filter_var(trim($_POST['number']),
    FILTER_SANITIZE_STRING);

    

    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
    $mysql->query("INSERT INTO `atlaides` (`Nosaukums`, `Apraksts`, `Procents`, `FilmaID`) 
    VALUES('$nosaukums', '$apraksts', '$procents', '$film_name')");

    $mysql->close();

    header('Location: piedavajumi.php');
?>
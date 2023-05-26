<?php
    $film_name = filter_var(trim($_POST['film-name']),
    FILTER_SANITIZE_STRING);
    $date = filter_var(trim($_POST['date']),
    FILTER_SANITIZE_STRING);
    $time = filter_var(trim($_POST['time']),
    FILTER_SANITIZE_STRING);
    $telpa = filter_var(trim($_POST['telpa']),
    FILTER_SANITIZE_STRING);


    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $mysql->query("INSERT INTO `seansi` (`TelpaID`, `FilmaID`, `Datums`, `No`) 
    VALUES('$telpa', '$film_name', '$date', '$time')");

    $mysql->close();

    header('Location: seansi.php');
?>
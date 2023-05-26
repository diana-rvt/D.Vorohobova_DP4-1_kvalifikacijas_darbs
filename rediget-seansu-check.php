<?php
    $film_name = filter_var(trim($_POST['film-name']),
    FILTER_SANITIZE_STRING);
    $date = filter_var(trim($_POST['date']),
    FILTER_SANITIZE_STRING);
    $time = filter_var(trim($_POST['time']),
    FILTER_SANITIZE_STRING);
    $telpa = filter_var(trim($_POST['telpa']),
    FILTER_SANITIZE_STRING);
    $id = $_GET['id'];


    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $mysql->query("UPDATE `seansi`
    SET `TelpaID` = '$telpa', 
    `FilmaID` = '$film_name', 
    `Datums` = '$date', 
    `No` = '$time'
    WHERE SeanssID = '$id';");

    $mysql->close();

    header('Location: seansi.php');
?>


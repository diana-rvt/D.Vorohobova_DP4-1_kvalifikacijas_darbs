<?php
    $film_name = filter_var(trim($_POST['film-name']),
    FILTER_SANITIZE_STRING);
    $apraksts = filter_var(trim($_POST['apraksts']),
    FILTER_SANITIZE_STRING);
    $vec_ierobezojums = filter_var(trim($_POST['vec_ierobezojums']),
    FILTER_SANITIZE_STRING);
    $zanrs = filter_var(trim($_POST['zanrs']),
    FILTER_SANITIZE_STRING);
    $ilgums = filter_var(trim($_POST['ilgums']),
    FILTER_SANITIZE_STRING);

    $imagetmp = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
    

    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $mysql->query("INSERT INTO `filmas` (`Nosaukums`, `Apraksts`, `Attels`, `Vec ierobezojums`, `Zanrs`, `Ilgums`) 
    VALUES('$film_name', '$apraksts', '$imagetmp', '$vec_ierobezojums', '$zanrs', '$ilgums')");

    $mysql->close();

    header('Location: filmu-katalogs.php');
?>
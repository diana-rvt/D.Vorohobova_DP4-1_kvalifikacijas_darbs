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

    $id = $_GET['id'];
    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    print_r($_FILES['img_upload']['tmp_name']) ;

    if (!empty ($_FILES['img_upload']['tmp_name'])) {
    $imagetmp = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
    $mysql->query("UPDATE `filmas`
    SET `Nosaukums` = '$film_name', 
    `Apraksts` = '$apraksts', 
    `Attels` = '$imagetmp', 
    `Vec ierobezojums` = '$vec_ierobezojums',
    `Zanrs` = '$zanrs',
    `Ilgums` = '$ilgums'
    WHERE FilmaID = '$id';");
    } else {
        $mysql->query("UPDATE `filmas`
    SET `Nosaukums` = '$film_name', 
    `Apraksts` = '$apraksts', 
    `Vec ierobezojums` = '$vec_ierobezojums',
    `Zanrs` = '$zanrs',
    `Ilgums` = '$ilgums'
    WHERE FilmaID = '$id';");
    }


    $mysql->close();

    header('Location: filmu-katalogs.php');
?>
<?php
    $name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
    $surname = filter_var(trim($_POST['surname']),
    FILTER_SANITIZE_STRING);
    $date = filter_var(trim($_POST['date']),
    FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST['phone']),
    FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);

    if(mb_strlen($name) < 1 || mb_strlen($name) > 50) {
        echo "Not allowed lenght of name";
        exit();
    } else if(mb_strlen($surname) < 1 || mb_strlen($surname) > 50) {
        echo "Not allowed lenght of surname";
        exit();
    } else if(mb_strlen($date) < 1) {
        echo "Not allowed lenght of date";
        exit();
    } else if(mb_strlen($phone) < 8 || mb_strlen($phone) > 8) {
        echo "Not allowed lenght of phone";
        exit();
    } else if(mb_strlen($email) < 6 || mb_strlen($email) > 50) {
        echo "Not allowed lenght of email";
        exit();
    } else if(mb_strlen($pass) < 2 || mb_strlen($pass) > 50) {
        echo "Not allowed lenght of passworld";
        exit();
    }

    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $result = $mysql->query("SELECT (`Email`) FROM `lietotaji` WHERE `Email` = '$email'");
    $user = $result -> fetch_assoc();
    
    if($user == '') {
        $mysql->query("INSERT INTO `lietotaji` (`Vards`, `Uzvards`, `Dzimsanas diena`, `Talrunis`, `Email`, `Parole`) 
    VALUES('$name', '$surname', '$date', '$phone', '$email', '$pass')");
    } else {
        echo "Not allowed EMAIL";
    }
    

    $mysql->close();

    header('Location: pievienoties.php');
?>
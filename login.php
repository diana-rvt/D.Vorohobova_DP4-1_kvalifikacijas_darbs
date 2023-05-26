<?php
    $email = filter_var(trim($_POST['email']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);


    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $result = $mysql->query("SELECT `Vards`, `Uzvards`, `Dzimsanas diena`, `Talrunis`, `Email`, `Parole` FROM `lietotaji` WHERE `Email` = '$email' AND `Parole` = '$pass'");

    $user = $result -> fetch_assoc();
    if(count($user) == 0) {
        header('Location: pievienoties.php');
        setcookie('error', '', "pievienoties.php");
        exit();
    } else {
        setcookie('user', $user['Email'], time() + 3600, "/");
        setcookie('name', $user['Vards'], time() + 3600, "/");
        setcookie('surname', $user['Uzvards'], time() + 3600, "/");
        setcookie('date', $user['Dzimsanas diena'], time() + 3600, "/");
        setcookie('phone', $user['Talrunis'], time() + 3600, "/");
        setcookie('error', '', time() + 3600, "pievienoties.php");
    }

    

    $mysql->close();

    header('Location: /');

?>
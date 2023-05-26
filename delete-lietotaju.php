<?php
    $id = $_GET["id"];
    
    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
    $mysql->query("DELETE FROM `lietotaji` WHERE `Email` = '$id' ");

    $mysql->close();

    setcookie('user', $user['Email'], time() - 3600, "/");
    setcookie('name', $user['Vards'], time() - 3600, "/");
    setcookie('surname', $user['Uzvards'], time() - 3600, "/");
    setcookie('date', $user['Dzimsanas diena'], time() - 3600, "/");
    setcookie('phone', $user['Talrunis'], time() - 3600, "/");
    header('Location: /');
?>
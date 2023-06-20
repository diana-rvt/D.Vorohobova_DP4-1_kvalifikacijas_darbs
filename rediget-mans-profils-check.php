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

    $old_email = $_GET['id'];

    

    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
    $result2 = $mysql->query("SELECT (`Email`) FROM `lietotaji` WHERE `Email` = '$email'");
    $user2 = $result2 -> fetch_assoc();
    
    if($user2 == '' || $user2['Email'] == $old_email) {
        $mysql->query("UPDATE `lietotaji`
        SET `Vards` = '$name', 
        `Uzvards` = '$surname', 
        `Dzimsanas diena` = '$date', 
        `Talrunis` = '$phone', 
        `Email` = '$email'
        WHERE Email = '$old_email';");

        $result = $mysql->query("SELECT `Vards`, `Uzvards`, `Dzimsanas diena`, `Talrunis`, `Email` 
        FROM `lietotaji` 
        WHERE `Email` = '$email'");
        $user = $result -> fetch_assoc();


        setcookie('user', $user['Email'], time() + 3600, "/");
        setcookie('name', $user['Vards'], time() + 3600, "/");
        setcookie('surname', $user['Uzvards'], time() + 3600, "/");
        setcookie('date', $user['Dzimsanas diena'], time() + 3600, "/");
        setcookie('phone', $user['Talrunis'], time() + 3600, "/");
    } else {
        echo "Not allowed EMAIL";
    }


    

    $mysql->close();



    header('Location: mans-profils.php');
?>
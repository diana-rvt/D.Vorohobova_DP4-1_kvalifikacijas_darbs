<?php

    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';


    $datums = $_POST['datums'];
    $valoda = $_POST['valoda'];
    $number = $_POST['number'];
    $email = $_COOKIE['user'];
    $gal_cena = 8;

    $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');

    $result = $mysql->query("SELECT `LietotajsID`, `Vards` FROM `lietotaji` WHERE `Email` = '$email'");
    $user = $result -> fetch_assoc();
    
    $lietotajs = $user['LietotajsID'];
    $vards = $user['Vards'];

    $cena = 0;

    for ($x = $number; $x >= 1; $x--) {
        $mysql->query("INSERT INTO `biletes` (`LietotajsID`, `SeanssID`, `Valoda`, `Galiga cena`) 
    VALUES('$lietotajs', '$datums', '$valoda', '$gal_cena')");
    $cena = $cena+$gal_cena;
    }

    $result2 = $mysql->query("SELECT `Datums`, `No` FROM `seansi` WHERE `SeanssID` = '$datums'");
    $user2 = $result2 -> fetch_assoc();
    
    $datums2 = $user2['Datums'];
    $laiks2 = $user2['No'];

    $result3 = $mysql->query("SELECT `Nosaukums` FROM `filmas` 
    INNER JOIN `seansi` 
    ON `seansi`.`FilmaID` = `filmas`.`FilmaID` 
    WHERE `SeanssID` = '$datums'");
    
    $user3 = $result3 -> fetch_assoc();
    $nosaukums = $user3['Nosaukums'];

    
    $mysql->close();

    $mail->isSMTP();
    $mail->Host = 'smtp.mail.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'sjcinema@mail.ru';
    $mail->Password = 'ZXrLqJVYJNjvcvURrkgw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('sjcinema@mail.ru');
    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = 'Paldies par pirkumu, ' . $vards . '!';
    $mail->Body    = 'Filmas nosaukums: ' . $nosaukums . '.' . '<br>Pirkuma cena ir: ' . $cena . '.00€.' . '<br>Datums: ' . $datums2 . '.' . '<br>Laiks: ' . $laiks2 . '.' . '<br>Biļešu skaits: ' . $number . '.';
    $mail->AltBody = '';

    

    setcookie('cena', $cena, time() + 3600, "paldies-par-pirkumu.php");

    if(!$mail->send()) {
        echo 'Error';
    } else {
        header('Location: paldies-par-pirkumu.php');
    }
    
?>
<?php

    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';

    $nosaukums = $_POST['nosaukums'];
    $seanssid = $_POST['seanssid'];
    $datums = $_POST['datums'];
    $laiks = $_POST['laiks'];
    $sedvieta = $_POST['sedvieta'];
    $number = $_POST['number'];
    $cena = $_POST['cena'];
    $email = $_COOKIE['user'];

    $gal_cena = $cena/$number;

    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');

    $result = $mysql->query("SELECT `LietotajsID`, `Vards` FROM `lietotaji` WHERE `Email` = '$email'");
    $user = $result -> fetch_assoc();
    
    $lietotajs = $user['LietotajsID'];
    $vards = $user['Vards'];

    $kods1 = $lietotajs + 1000;
    $kods2 = $seanssid + 200;
    $kods3 = $sedvieta[0] + 300;

    $cena = 0;

    for ($x = 0; $x < count($sedvieta); $x++) {
        $sedvieta2 = $sedvieta[$x];
        $mysql->query("INSERT INTO `biletes` (`LietotajsID`, `SeanssID`, `SedvietaID`, `Galiga cena`) 
    VALUES('$lietotajs', '$seanssid', '$sedvieta2', '$gal_cena')");
    $cena = $cena+$gal_cena;
    }

    $result2 = $mysql->query("SELECT `Datums`, `No` FROM `seansi` WHERE `SeanssID` = '$seanssid'");
    $user2 = $result2 -> fetch_assoc();
    
    $datums2 = $user2['Datums'];
    $laiks2 = $user2['No'];

    $result3 = $mysql->query("SELECT `Nosaukums` FROM `filmas` 
    INNER JOIN `seansi` 
    ON `seansi`.`FilmaID` = `filmas`.`FilmaID` 
    WHERE `SeanssID` = '$seanssid'");
    
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
    $mail->Body    = '<p style="font-size: 30px; text-align: center;">M' . $kods1 . '' . $kods2 . '' . $kods3 . '</p><br>Filmas nosaukums: ' . $nosaukums . '.' . '<br>Pirkuma cena ir: ' . number_format($cena, 2) . '€.' . '<br>Datums: ' . $datums2 . '.' . '<br>Laiks: ' . $laiks2 . '.' . '<br>Biļešu skaits: ' . $number . '.';
    $mail->AltBody = '';
    

    

    setcookie('cena', $cena, time() + 3600, "paldies-par-pirkumu.php");

    if(!$mail->send()) {
        echo 'Error';
    } else {
        header('Location: paldies-par-pirkumu.php');
    }
    
?>
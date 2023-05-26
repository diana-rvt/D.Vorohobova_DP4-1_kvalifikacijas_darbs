<?php
    setcookie('user', $user['Email'], time() - 3600, "/");
    setcookie('name', $user['Vards'], time() - 3600, "/");
    setcookie('surname', $user['Uzvards'], time() - 3600, "/");
    setcookie('date', $user['Dzimsanas diena'], time() - 3600, "/");
    setcookie('phone', $user['Talrunis'], time() - 3600, "/");
    header('Location: /');
?>
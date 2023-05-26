<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Filmas</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/filmu-katalogs.css">
        <link rel="stylesheet" type="text/css" href="assets/css/header-style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php setcookie('error', 'none', "pievienoties.php");?>
            <nav>
                <a href="index.php" id="logo"><img src="assets/img/logo.png"></a>
                <ul id="menu">
                    <li><a href="seansi.php">Tuvākie seansi</a></li>
                    <li><a href="filmu-katalogs.php">Filmas</a></li>
                    <li id="lv"><a href="#">LV</a></li>
                    <?php error_reporting(0);
                    if($_COOKIE['user'] == ''): ?>
                    <li id="login-button"><a href="pievienoties.php">Ienākt</a></li>
                    <?php else: ?>
                        <li id="login-button"><a href="exit.php">Iziet</a></li>
                        <?php if($_COOKIE['user'] == 'admin@mail.com'): ?>
                        <li id="profils"><a href="admin.php">Admin</a></li>
                        <?php else: ?>
                        <li id="profils"><a href="mans-profils.php">Profils</a></li>
                        <?php endif;?>
                    <?php endif;?>
                    <li id="search">
                        <form action="?search=<?php echo $_GET['search'];?>" method="get"><input type="search" name="search" placeholder="Atrast filmu">
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
        <h1>Filmas</h1>
        <div id="katalog">
            <?php
            $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
            $max_number = $mysql->query("SELECT MAX(`FilmaID`) FROM `filmas`");
            $max_n = $max_number -> fetch_assoc();
            $search_result = $_GET["search"];
            for ($x = $max_n['MAX(`FilmaID`)']; $x >= 1; $x--) { 
                $result = $mysql->query("SELECT `Nosaukums` FROM `filmas` WHERE `FilmaID` = '$x' AND (`Nosaukums` LIKE '%$search_result%' OR `Zanrs` LIKE '%$search_result%' OR `Apraksts` LIKE '%$search_result%')");
                $user = $result -> fetch_assoc();
                if (!empty($user['Nosaukums'])): ?> 

                
                <div class="film">
                    <a href="films.php?id=<?php echo $x;?>" class="poster">
                    <?php 
                        $result = $mysql->query("SELECT `Nosaukums`, `Apraksts`, `Attels` FROM `filmas` WHERE `FilmaID` = '$x'");
                        $user = $result -> fetch_assoc();
                        ?> 
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($user['Attels']); ?>" alt="">
                    </a>
                
                    <div class="film-name">
                        <a href="films.php?id=<?php echo $x;?>">
                            <?php echo htmlspecialchars($user['Nosaukums']); ?>
                        </a>
                    </div>
                </div>
                

                <?php endif; } ?>
            <div class="film" style="height: 10px;"></div>
            <div class="film" style="height: 10px;"></div>
            <div class="film" style="height: 10px;"></div>
            <div class="film" style="height: 10px;"></div>
        </div>
        <footer id="footer">
            <div class="footer-links"><a href="seansi.php">Tuvākie seansi</a></div>
            <div class="footer-links"><a href="filmu-katalogs.php">Filmas</a></div>
            <div class="footer-links"><a href="#">Par uzņēmumu</a></div>
            <div class="footer-links"><a href="#">Vakances</a></div>
            <div class="footer-links"><a href="#">Kontakti</a></div>
            <div class="footer-links"><a href="#">Privātuma politika</a></div>
            <div class="footer-links">
                <a href="#"><img src="assets/img/Vector (1).png"></a>
                <a href="#"><img src="assets/img/Vector_2.png"></a>
            </div>
        </footer>
    </body>
</html>
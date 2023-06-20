<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Mans profils</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/rediget-mans-profils.css">
        <link rel="stylesheet" type="text/css" href="assets/css/header-style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>
    <body>
    <header>
            <nav>
                <a href="index.php" id="logo"><img src="assets/img/logo.png"></a>
                <ul id="menu">
                    <li><a href="seansi.php">Tuvākie seansi</a></li>
                    <li><a href="filmu-katalogs.php">Filmas</a></li>
                    <li><a href="piedavajumi.php">Piedāvājumi</a></li>
                    <li><a href="par-kinoteatru.php">Par mums</a></li>
                    <li id="lv"><a href="#">LV</a></li>
                    <?php error_reporting(0);
                    if($_COOKIE['user'] == ''): ?>
                    <?php header('Location: /');?>
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
                    <form action="filmu-katalogs.php?search=<?php echo $_GET['search'];?>" method="get"><input type="search" name="search" placeholder="Atrast filmu">
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
        <h1>Mans profils</h1>
        <?php $id = $_GET['id'] ?> 
        <form id="select" action="rediget-mans-profils-check.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
        <div class="container">
        <?php 
            $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
            $old_info_sql = $mysql->query("SELECT `LietotajsID`, `Vards`, `Uzvards`, `Dzimsanas diena`, `Talrunis`, `Email`, `Parole`
            FROM `lietotaji`
            WHERE `Email` = '$id'");
            $old_info = $old_info_sql -> fetch_assoc();
        ?>
            <div>
                <p>Vārds:</p><p><input type="text" name="name" id="name" placeholder="Vārds" value="<?=$old_info['Vards']?>" required></p>
            </div>
            <div>
                <p>Uzvārds:</p><p><input type="text" name="surname" id="surname" placeholder="Uzvārds" value="<?=$old_info['Uzvards']?>" required></p>
            </div>
            <div>
                <p>Dzimšanas datums:</p><p><input type="date" name="date" id="date" placeholder="Dzimšanas diena" value="<?=$old_info['Dzimsanas diena']?>" required></p>
            </div>
            <div>
                <p>Tālrunis:</p><p><span id="n371">+371</span><input type="phone" name="phone" id="phone" placeholder="Tālrunis" value="<?=$old_info['Talrunis']?>" required></p>
            </div>
            <div>
                <p>E-mail:</p><p><input type="email" name="email" id="email" placeholder="Email" value="<?=$old_info['Email']?>" required></p>
                </div>
                
        </div>
                <div id="dzest">
                    <a href=""><button type="submit">Rediģēt</button></a>
                    <a href="mans-profils.php">
                        Atpakaļ
                    </a>
                </div>
        </form>
    

        <footer id="footer">
            <div class="footer-links"><a href="seansi.php">Tuvākie seansi</a></div>
            <div class="footer-links"><a href="filmu-katalogs.php">Filmas</a></div>
            <div class="footer-links"><a href="par-kinoteatru.php">Par kinoteātri</a></div>
            <div class="footer-links"><a href="#">Vakances</a></div>
            <div class="footer-links"><a href="kontakti.php">Kontakti</a></div>
            <div class="footer-links"><a href="#">Privātuma politika</a></div>
            <div class="footer-links">
                <a href="#"><img src="assets/img/Vector (1).png"></a>
                <a href="#"><img src="assets/img/Vector_2.png"></a>
            </div>
        </footer>

        <script src="assets/js/buy-ticket.js"></script>
    </body>
</html>
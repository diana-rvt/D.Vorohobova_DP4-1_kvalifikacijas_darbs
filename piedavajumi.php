<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Piedāvājumi</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/piedavajumi.css">
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
                    <li><a href="piedavajumi.php">Piedāvājumi</a></li>
                    <li><a href="par-kinoteatru.php">Par mums</a></li>
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
                    <form action="filmu-katalogs.php?search=<?php echo $_GET['search'];?>" method="get"><input type="search" name="search" placeholder="Atrast filmu">
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
        
        <h1>Piedāvājumi</h1>
        <div id="seansu-katalog">
        <?php
            $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
            $max_number = $mysql->query("SELECT MAX(`AtlaideID`) FROM `atlaides`");
            $max_n = $max_number -> fetch_assoc();

            for ($x = $max_n['MAX(`AtlaideID`)']; $x >= 1; $x--) { 
                $result = $mysql->query("SELECT `AtlaideID`, `Nosaukums`, `Apraksts`, `Procents` 
                FROM `atlaides` 
                WHERE `AtlaideID` = '$x'");
                $user = $result -> fetch_assoc();

                if (!empty($user['Nosaukums'])): ?> 
                <div class="film">
                <p class="poster">
                <?php echo htmlspecialchars($user['Procents']);?>%
                </p>
                <div class="film-name">
                    <div class="name_description">
                    <?php echo htmlspecialchars($user['Nosaukums']);?>
                    <div class="description">
                    <?php echo htmlspecialchars($user['Apraksts']);?>
                    </div>
                    </div>



                
                </div>
                <div class="date-time">
                    <p>Procents: <?php echo htmlspecialchars($user['Procents']);?>%</p>
                    
                   

                    <?php 
                        if($_COOKIE['user'] == 'admin@mail.com'): 
                    ?>
                        <a href="rediget-piedavajums.php?id=<?php echo $user['AtlaideID'];?>">
                            <button>Rediģēt</button>
                        </a>
                        <a href="delete-piedavajums.php?id=<?php echo $user['AtlaideID'];?>">
                            <button>Dzēst</button>
                        </a>
                    <?php endif;?>


                </div>
            </div>
            <?php endif; }
            ?>

        </div>
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
    </body>
</html>
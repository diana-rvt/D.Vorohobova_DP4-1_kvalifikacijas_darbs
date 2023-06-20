<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Pirkt biļeti</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/buy-ticket.css">
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
        <h1>Pirkt biļeti</h1>

        <!--FILM-->
        <div id="katalog">
            <div class="film">
                <?php 
                    $id = $_GET["id"];
                    $name = $_GET["name"];
                    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
                    $result = $mysql->query("SELECT `SeanssID`, `Datums`, DAY(`Datums`), MONTHNAME(`Datums`), MONTH(`Datums`), YEAR(`Datums`), HOUR(`No`), MINUTE(`No`), `No` FROM `seansi` WHERE `SeanssID` = '$id';");
                    $user = $result -> fetch_assoc();
                    $filma = $mysql->query("SELECT `FilmaID`, `Zanrs`, HOUR(`Ilgums`), MINUTE(`Ilgums`), `Vec ierobezojums`, `Apraksts`, `Attels`, `Nosaukums` FROM `filmas` WHERE `FilmaID` = '$name';");
                    $user2 = $filma -> fetch_assoc();

                ?> 
                <a href="films.php?id=<?php echo $user2['FilmaID'];?>" class="poster">

                        <img src="data:image/jpeg;base64, <?php echo base64_encode($user2['Attels']); ?>" alt="">
                </a>                
                <div class="film-name">
                <a href="films.php?id=<?php echo $user2['FilmaID'];?>"><p><?php
                    echo htmlspecialchars($user2['Nosaukums']); 
                    ?></p></a>
                    <div class="description">
                    <?php
                    echo htmlspecialchars($user2['Apraksts']); 
                    ?>
                    </div>
                    <div class="zanrs">
                    <?php
                    echo htmlspecialchars($user2['Zanrs']); 
                    ?>
                    </div>
                    <div class="ilgums">Ilgums:
                    <?php
                    echo htmlspecialchars($user2['HOUR(`Ilgums`)']) . 'h ' . htmlspecialchars($user2['MINUTE(`Ilgums`)']) . 'min'; 
                    ?>
                    </div>

                    <?php 
                    $color = '';
                    if ($user2['Vec ierobezojums'] == 0) {
                        $color = 'green';
                    } elseif ($user2['Vec ierobezojums'] == 6) {
                        $color = 'green';
                    } elseif ($user2['Vec ierobezojums'] == 12) {
                        $color = 'green';
                    } elseif ($user2['Vec ierobezojums'] == 16) {
                        $color = 'rgb(238, 115, 0)';
                    } else {
                        $color = 'red';
                    }
                    ?>

                    <div class="vec_ier" style="background-color: <?php
                    echo $color; 
                    ?>;">
                    <?php
                    echo htmlspecialchars($user2['Vec ierobezojums']); 
                    ?>+
                    </div>

                </div>
            </div>
        </div>

        <?php
        if (empty($id)) {
            $x = 'selected';
            $y = '';
        } else {
            $y = 'selected';
            $x = '';
        }
        ?>

        <!--SELECT-->
        <form id="select" action="sedvietas-izvele.php" method="get">
            <div class="custom-select" id="datums">
                    <label for="pilsēta">Datums:</label>
                    <select name="id" id="town" required>
                    <option value="0" <?php echo $x ?> disabled hidden>Izvēlies</option>
                      <option value="<?php echo $user['SeanssID'] ?>" <?php echo $y ?>><?php echo $user['DAY(`Datums`)'] . '-' . $user['MONTH(`Datums`)'] . '-' . $user['YEAR(`Datums`)']?></option>
                    </select>
            </div>
            <div class="custom-select" id="laiks">
                    <label for="veids">Laiks:</label>
                    <select name="laiks" id="type" required>
                    <option value="0" <?php echo $x ?> disabled hidden>Izvēlies</option>
                    <option value="<?php echo $user['SeanssID'] ?>" <?php echo $y ?>><?php echo $user['HOUR(`No`)'] . ':' . $user['MINUTE(`No`)']?></option>
                    </select>
            </div>
            <div class="custom-select">
                    <label>Daudzums:<br></label>
                    <input type="number" name="number" id="number" value="1" min="1" max="30" required>
            </div>
            <div id="buy-ticket">
                <a><button type="submit" id="submit">Izvēlēt sēdvietu</button></a>
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
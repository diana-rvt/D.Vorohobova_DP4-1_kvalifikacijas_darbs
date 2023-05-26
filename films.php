<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Filma</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/films.css">
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
                    <form action="filmu-katalogs.php?search=<?php echo $_GET['search'];?>" method="get"><input type="search" name="search" placeholder="Atrast filmu">
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
        <h1>Filma</h1>

        <!--FILM-->
        <div id="katalog">
            <div class="film">
                <a href="" class="poster">
                        <?php 
                        $id = $_GET["id"];
                        $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
                        $result = $mysql->query("SELECT `FilmaID`, `Nosaukums`, `Apraksts`, `Attels`, `Zanrs`, HOUR(`Ilgums`), MINUTE(`Ilgums`), `Vec ierobezojums`  FROM `filmas` WHERE `FilmaID` = '$id'");
                        $user = $result -> fetch_assoc();
                        ?> 
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($user['Attels']); ?>" alt="">
                </a>
                <div class="film-name">
                    <p><?php
                    echo htmlspecialchars($user['Nosaukums']); 
                    ?></p>
                    <div class="description">
                    <?php
                    echo htmlspecialchars($user['Apraksts']); 
                    ?>
                    </div>
                    <div class="zanrs">
                    <?php
                    echo htmlspecialchars($user['Zanrs']); 
                    ?>
                    </div>
                    <div class="ilgums">Ilgums:
                    <?php
                    echo htmlspecialchars($user['HOUR(`Ilgums`)']) . 'h ' . htmlspecialchars($user['MINUTE(`Ilgums`)']) . 'min'; 
                    ?>
                    </div>
                    
                    <?php 
                    $color = '';
                    if ($user['Vec ierobezojums'] == 0) {
                        $color = 'green';
                    } elseif ($user['Vec ierobezojums'] == 6) {
                        $color = 'green';
                    } elseif ($user['Vec ierobezojums'] == 12) {
                        $color = 'green';
                    } elseif ($user['Vec ierobezojums'] == 16) {
                        $color = 'rgb(238, 115, 0)';
                    } else {
                        $color = 'red';
                    }
                    ?>

                    <div class="vec_ier" style="background-color: <?php
                    echo $color; 
                    ?>;">
                    <?php
                    echo htmlspecialchars($user['Vec ierobezojums']); 
                    ?>+
                    </div>
                </div>
            </div>
        </div>

        <!--SELECT-->
        <div id="select">
            <div id="buy-ticket">

                    <?php 
                        if($_COOKIE['user'] == ''): 
                    ?>
                        <a href="pievienoties.php">
                            <button>Pirkt biļeti</button>
                        </a>
                        <?php elseif($_COOKIE['user'] == 'admin@mail.com'): 
                    ?>
                    <?php else:
                    ?>
                        <a href="buy-ticket.php?name=<?php echo $user['FilmaID'];?>">
                            <button>Pirkt biļeti</button>
                        </a>
                    <?php endif;?>

                    <?php 
                        if($_COOKIE['user'] == 'admin@mail.com'): 
                    ?>
                        <a href="rediget-filmu.php?id=<?php echo $user['FilmaID'];?>">
                            <button>Rediģēt</button>
                        </a>
                        <a href="delete-film.php?id=<?php echo $user['FilmaID'];?>">
                            <button>Dzēst</button>
                        </a>
                    <?php endif;?>

            </div>
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

        <script src="assets/js/buy-ticket.js"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Tuvākie seansi</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/seansi.css">
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
                    <form action="?search=<?php echo $_GET['search'];?>" method="get"><input type="search" name="search" placeholder="Atrast filmu">
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
        
        <h1>Tuvākie seansi</h1>
        <div id="seansu-katalog">
        <?php
            $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
            $max_number = $mysql->query("SELECT MAX(`SeanssID`) FROM `seansi`");
            $max_n = $max_number -> fetch_assoc();

            $search_result = $_GET["search"];
            for ($x = 1; $x <= $max_n['MAX(`SeanssID`)']; $x++) { 
                $result = $mysql->query("SELECT (
                    SELECT COUNT(*) FROM `seansi` `s2`
                    WHERE `s2`.`Datums` < `s1`.`Datums` OR (`s2`.`Datums` = `s1`.`Datums` AND `s2`.`No` < `s1`.`No`) OR (`s2`.`Datums` = `s1`.`Datums` AND `s2`.`No` = `s1`.`No` AND `s2`.`SeanssID` < `s1`.`SeanssID`)
                ) + 1 AS `row_num`,
                `SeanssID`, `TelpaID`, `filmas`.`FilmaID`, `Datums`, `No`, `Zanrs`, HOUR(`Ilgums`), MINUTE(`Ilgums`), `Vec ierobezojums`, `Apraksts`, `Attels`, `Nosaukums`, DAY(`Datums`), MONTHNAME(`Datums`), HOUR(`No`), MINUTE(`No`), HOUR(ADDTIME(`No`, `Ilgums`)), MINUTE(ADDTIME(`No`, `Ilgums`))
                FROM `seansi` `s1`
                INNER JOIN `filmas`
                ON `filmas`.`FilmaID` = `s1`.`FilmaID`
                WHERE (
                    SELECT COUNT(*) FROM `seansi` `s2`
                    WHERE `s2`.`Datums` < `s1`.`Datums` OR (`s2`.`Datums` = `s1`.`Datums` AND `s2`.`No` < `s1`.`No`) OR (`s2`.`Datums` = `s1`.`Datums` AND `s2`.`No` = `s1`.`No` AND `s2`.`SeanssID` < `s1`.`SeanssID`)
                ) + 1 = '$x' AND CONCAT(`Datums`, ' ', `No`) > NOW() AND (`Nosaukums` LIKE '%$search_result%' OR `Zanrs` LIKE '%$search_result%' OR `Apraksts` LIKE '%$search_result%')
                ORDER BY `Datums`, `No`, `SeanssID`");
                
                $user = $result -> fetch_assoc();
                if (!empty($user['Nosaukums'])): ?>
                <div class="film">
                <a href="films.php?id=<?php echo $user['FilmaID'];?>" class="poster">
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($user['Attels']); ?>" alt="">
                </a>
                <div class="film-name">
                    <div class="name_description">
                    <a href="films.php?id=<?php echo $user['FilmaID'];?>"><?php echo htmlspecialchars($user['Nosaukums']);?></a>
                    <div class="description">
                    <?php
                    $text = htmlspecialchars($user['Apraksts']);
                    $limit = 300;
                    echo substr($text, 0, $limit) . '...';?>
                    </div>
                    </div>
                    <!-- Zanrs, ilgums, vec ierobez -->
                    <div class="z_i_v">
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



                <!-- Date and Time -->
                </div>
                <div class="date-time">
                    <p>Datums: <?php echo htmlspecialchars($user['DAY(`Datums`)']) . " " . htmlspecialchars($user['MONTHNAME(`Datums`)']);?></p>
                    <p>Laiks: <?php echo htmlspecialchars($user['HOUR(`No`)']) . ":" . htmlspecialchars($user['MINUTE(`No`)']);?></p>
                    <p id="lidz">Līdz: <?php echo htmlspecialchars($user['HOUR(ADDTIME(`No`, `Ilgums`))']) . ":" . htmlspecialchars($user['MINUTE(ADDTIME(`No`, `Ilgums`))']);?></p>
                    
                    <?php 
                    $z = $user['SeanssID'];
                    
                    $result3 = $mysql->query("SELECT COUNT(`BileteID`)
                    FROM `biletes`
                    WHERE `SeanssID` = '$z';");
                    $user3 = $result3 -> fetch_assoc();
                    
                        if($_COOKIE['user'] == ''): 
                    ?>
                        <span style="color:grey; font-size: 18px;"><?php echo htmlspecialchars($user3['COUNT(`BileteID`)']);?>/48</span><a href="pievienoties.php">
                            <button>Pirkt biļeti</button>
                        </a>
                    <?php elseif($_COOKIE['user'] == 'admin@mail.com'): 
                    ?>
                    <?php else:
                    ?>
                        <span style="color:grey; font-size: 18px;"><?php echo htmlspecialchars($user3['COUNT(`BileteID`)']);?>/48</span><a href="buy-ticket.php?id=<?php echo $user['SeanssID'];?>&&name=<?php echo $user['FilmaID'];?>">
                            <button>Pirkt biļeti</button>
                        </a>
                    <?php endif;?>

                    <?php 
                        if($_COOKIE['user'] == 'admin@mail.com'): 
                    ?>
                        <a href="rediget-seansu.php?id=<?php echo $user['SeanssID'];?>">
                            <button>Rediģēt</button>
                        </a>
                        <a href="delete-seans.php?id=<?php echo $user['SeanssID'];?>">
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
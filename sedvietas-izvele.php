<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Sēdvietas izvēle</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/sedvietas-izvele.css">
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
        <h1>Sēdvietas izvēle</h1>

        <!--SEDVIETAS-->
        <form action="pirkums.php" method="post" id="submitForm">
        <div id="katalog">
            <div id="instrukcija">
            <div><img src="assets/img/orange.png"></div><div><span> - Brīva sēdvieta</span></div><br>
            <div><img src="assets/img/red2.png"></div><div><span> - Izvēlētā sēdvieta</span></div><br>
            <div><img src="assets/img/grey.png"></div><div><span> - Aizņemta sēdvieta</span></div>
            </div>
            <div class="film">
                <?php 
                    $id = $_GET["id"];
                    $limit = $_GET["number"];
                    $mysql = new mysqli('localhost', 'dianarvt', 'DianaRVT13', 'diana_rvt');
                    $result = $mysql->query("SELECT `SeanssID`, `Nosaukums`, `Datums`, DAY(`Datums`), MONTHNAME(`Datums`), MONTH(`Datums`), YEAR(`Datums`), HOUR(`No`), MINUTE(`No`), `No` 
                    FROM `seansi`
                    INNER JOIN `filmas`
                    ON `filmas`.`FilmaID` = `seansi`.`FilmaID`
                    WHERE `SeanssID` = '$id';");
                    $user = $result -> fetch_assoc();
                    

                
                //<!--IZVELE-->
                for ($x = 1; $x <= 48; $x++) { 
                    $result2 = $mysql->query("SELECT `SeanssID`, `SedvietaID`
                    FROM `biletes`
                    WHERE `SeanssID` = '$id' AND `SedvietaID` = '$x';");
                    $user2 = $result2 -> fetch_assoc();
                    if($x == $user2['SedvietaID']): ?> 
                        <label>
                        <input type="checkbox" value="<?php echo $x ?>" class="styled-checkbox" disabled />
                        <span></span>
                        </label> 
                <?php else: ?> 
                <label>
                <input type="checkbox" name="sedvieta[]" value="<?php echo $x ?>" class="styled-checkbox" />
                <span></span>
                </label>

                <?php endif; 
                } ?> 
                
                

            </div>
            <div id="instrukcija2">
            <div><span>Filma: <?php echo $user['Nosaukums'] ?></span></div><br>
            <div><span>Datums: <?php echo htmlspecialchars($user['DAY(`Datums`)']) . " " . htmlspecialchars($user['MONTHNAME(`Datums`)']);?></span></div><br>
            <div><span>Laiks: <?php echo htmlspecialchars($user['HOUR(`No`)']) . ":" . htmlspecialchars($user['MINUTE(`No`)']);?></span></div>
            </div>
            <input type="hidden" name="nosaukums" value="<?php echo $user['Nosaukums']; ?>">
            <input type="hidden" name="seanssid" value="<?php echo $user['SeanssID']; ?>">
            <input type="hidden" name="datums" value="<?php echo $user['Datums']; ?>">
            <input type="hidden" name="laiks" value="<?php echo $user['No']; ?>">
            <input type="hidden" name="number" value="<?php echo $limit; ?>">
        </div>

        <?php
        if (empty($id)) {
            $x = 'selected';
            $y = '';
        } else {
            $y = 'selected';
            $x = '';
        }

        
        $result3 = $mysql->query("SELECT `Procents` 
        FROM `filmas`
        INNER JOIN `seansi`
        ON `filmas`.`FilmaID` = `seansi`.`FilmaID`
        INNER JOIN `atlaides`
        ON `filmas`.`FilmaID` = `atlaides`.`FilmaID`
        WHERE `SeanssID` = '$id';");
        $user3 = $result3 -> fetch_assoc();

        if (!empty($user3)) {
            $atlaide2 = $user3['Procents'];
            $cena=$limit*8*((100-$atlaide2)/100);
        } else {
            $cena=$limit*8;
        }


        ?>
        <input type="hidden" name="cena" value="<?php echo $cena; ?>">

        <!--SELECT -->
        <div id="select">
            <div id="buy-ticket">
            <span style="padding-right: 10px;"><?php echo htmlspecialchars(number_format($cena, 2));?>€</span><a><button type="submit" id="submit">Pirkt biļeti</button></a>
            </div>
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
        <script>
            var limit = <?php echo $limit; ?>;
            var checkboxes = document.querySelectorAll('.styled-checkbox');

            checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var checkedCount = document.querySelectorAll('.styled-checkbox:checked').length;
                if (checkedCount > limit) {
                this.checked = false;
                }
            });
            });

            document.getElementById('submitForm').addEventListener('submit', function(event) {
            var parbaudit = document.querySelectorAll('input[name="sedvieta[]"]:checked').length;
            if (parbaudit < limit) {
                event.preventDefault();
                alert('Lūdzu izvēlieties ' + limit + ' sēdvietas');
            }
            });
        </script>
    </body>
</html>
<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Pievienot filmu</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/add-filmu.css">
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
                        <?php header('Location: /');?>
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
        <h1>Pievienot filmu</h1>
        

        <!--SELECT-->
        <div id="container2">
            <form id="select" action="add-filmu-check.php" method="post" enctype="multipart/form-data">
                <div id="katalog">
                <div class="film">
                    <a class="poster">
                        <div class="poster-picture">
                            <input type="file" name="img_upload" id="img_upload" required>
                        </div>
                    </a>
                    <div class="film-name">
                        <input type="text" name="film-name" id="film-name" placeholder="Nosaukums" required>
                        <div class="description">
                            <textarea type="text" name="apraksts" id="apraksts" placeholder="Apraksts" required></textarea>
                        </div>
                        <div class="custom-select" id="datums">
                            <label for="vec_ierobezojums">Vec. ierobežojums:</label>
                            <select name="vec_ierobezojums" id="town" required>
                                <option value="">Izvēlies</option>
                                <option value="0">0</option>
                                <option value="6">6</option>
                                <option value="12">12</option>
                                <option value="16">16</option>
                                <option value="18">18</option>
                            </select>
                        </div> 
                        <input type="text" name="zanrs" class="zanrs_ilgums" placeholder="Žanrs" required>
                        <input type="time" name="ilgums" class="zanrs_ilgums" placeholder="Ilgums" required>
                    </div>
                </div>
                </div>
                <div id="buy-ticket">
                    <a href="#"><button type="submit">Pievienot filmu</button></a>
                </div>
            </form>
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

        <script src="assets/js/buy-ticket.js"></script>
    </body>
</html>
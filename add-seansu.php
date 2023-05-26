<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Pievienot seansu</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="assets/css/add-seansu.css">
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
        <h1>Pievienot seansu</h1>
        

        <!--SELECT-->
        <div id="container2">
            <form id="select" action="add-seansu-check.php" method="post">
                <div class="custom-select" id="datums">
                    <label for="film-name">Films:</label>
                    <select name="film-name" id="town" required>
                      <option value="">Izvēlies</option>
                      <?php
                      $mysql = new mysqli('localhost', 'root', 'kiki', 'kino');
                      $max_number = $mysql->query("SELECT MAX(`FilmaID`) FROM `filmas`");
                      $max_n = $max_number -> fetch_assoc();
                      for ($x = $max_n['MAX(`FilmaID`)']; $x >= 1; $x--) {
                      $film_name = $mysql->query("SELECT `Nosaukums` FROM `filmas` WHERE `FilmaID`=$x");
                      $film_name_2 = $film_name -> fetch_assoc();
                      if (!empty($film_name_2['Nosaukums'])):
                      ?>
                      <option value="<?php echo $x ?>"><?php echo $film_name_2['Nosaukums'] ?></option>
                      <?php endif; } ?>
                    </select>
                </div>        
                <div class="label">  
                    <p>Datums:</p>
                    <input type="date" name="date" id="date" placeholder="Datums" required>
                </div>
                <div class="label">
                    <p>Laiks:</p>
                    <input type="time" name="time" id="time" placeholder="Laiks" required>
                </div>
                <div class="custom-select" id="datums">
                    <label for="telpa">Telpa:</label>
                    <select name="telpa" id="town" required>
                      <option value="">Izvēlies</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                </div>
                <div id="buy-ticket">
                    <a href="#"><button type="submin">Pievienot filmu</button></a>
                </div>
            </form>
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
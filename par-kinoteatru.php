<!DOCTYPE html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Par kinoteātri</title>
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
        <h1>Par kinoteātri</h1>
        <div id="about_kino">
            <p class="about_kino">Kinoteātris "MyCinema" savas durvis skatītājiem vēra 2023. gada 20. janvārī. Mēs cenšamies nodrošināt saviem apmeklētājiem vislabāko filmu pieredzi, izmantojot visjaunākās tehnoloģijas un aprīkojumu. Mūsu kinoteātrī ir mājīgas zāles ar ērtiem sēdekļiem un izcilu skaņas un attēla kvalitāti. Ar prieku piedāvājam Jums plašu dažādu žanru un virzienu filmu izvēli.</p>
            <p class="about_kino">"MyCinema" var baudīt gan jaunākās kino industrijas izlaidumus, gan klasiskās filmas. Mēs arī rīkojam īpašus seansus un pasākumus par dažādām tēmām un pasākumiem. Mūsu komanda vienmēr ir gatava jums palīdzēt izvēlēties filmu un atbildēt uz visiem jautājumiem.</p>
            <p class="about_kino">Turklāt MyCinema varat iegādāties dažādas uzkodas un dzērienus, lai uzlabotu skatīšanās pieredzi. Piedāvājam plašu popkorna, saldumu un citu kārumu izvēli. Un mūsu biļešu cenas vienmēr ir pieejamas un konkurētspējīgas.</p>
            <p class="about_kino">Mēs pastāvīgi strādājam, lai uzlabotu mūsu pakalpojumu kvalitāti un paplašinātu piedāvāto filmu klāstu. Mūsu mērķis ir padarīt jūsu "MyCinema" apmeklējumu neaizmirstamu un patīkamu.</p>
            <p class="about_kino">Laipni lūdzam kino pasaulē ar "MyCinema"!</p>
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
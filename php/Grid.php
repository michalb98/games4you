<?php

    require_once('./php/Database.php');

    class Grid {

        function drawGamesGrid($games) {
            $rows = count($games);
            for ($row = 0; $row < $rows; $row++) {
                echo '<a class="game" href="produkt?id='.$games[$row][0].'" title="Zobacz produkt '.$games[$row][1].'">
                        <div class="game-cover-container">
                            <img class="game-cover" src="./img/covers/'.$games[$row][1].'_cover.webp" alt="'.$games[$row][1].'" onerror="if (this.src != `./img/error/error_cover.webp`) this.src = `./img/error/error_cover.webp`;">
                        </div>
                        <div class="game-container">
                             <div class="game-info">
                                 <p class="game-title">'.$games[$row][1].'</p>
                                 <p class="game-price">'.$games[$row][3].' zł</p>
                            </div>
                            <div class="game-info-hover">
                                <p class="game-title">'.$games[$row][1].'</p>
                                <p class="game-desc">'.$games[$row][4].'</p>
                                <p class="game-price">'.$games[$row][3].' zł</p>
                            </div>
                        </div>
                     </a>'; 
            }
        }

        function drawMainHeader() {
            echo '<div id="main-header">
        <a href="strona-glowna" title="Przejdź do strony głównej">
            <div id="logo">
                <img src="./img/web/icon.webp" alt="Games4You">
            </div>
        </a>
        <div id="search">
            <input type="search" name="search">
        </div>
        <a href="koszyk" title="Zobacz swój koszyk" id="cart" class="icon-main-header">
            <i class="icon-basket icon"></i>
        </a>
        <a href="konto" title="Przejdź do swojego konta" id="account" class="icon-main-header">
            <i class="icon-adult icon"></i>
        </a>
    </div>';
        }

        function drawFooter() {
            echo '<footer>
            <div id="payment-method">
                Metody płatności:
                <img src="./img/payments/mastercard.svg" alt="MasterCard">
                <img src="./img/payments/visa.svg" alt="Visa">
                <img src="./img/payments/paysafecard.svg" alt="PaySafeCard">
                <img src="./img/payments/skrill.svg" alt="Skrill">
                <img src="./img/payments/paypal.svg" alt="PayPal">
            </div>
            <div id="container-footer">
                <div id="help" class="div-conatiner-footer">
                    Pomoc:
                    <a href="" title="Zwrot gry">Zwrot gry</a>
                    <a href="" title="Support">Support</a>
                    <a href="" title="Regulamin">Regulamin</a>
                    <a href="" title="Ciasteczka">Ciasteczka</a>
                    <a href="" title="Inny problem">Inny problem</a>
                </div>
                <div id="contact" class="div-conatiner-footer">
                    Kontakt: 
                    <a href="mailto:support@games4you.pl" target="_blank">support@games4you.pl</a>
                </div>
                <div id="social-media" class="div-conatiner-footer">
                    Odwiedź Nas na:
                    <a href="" title="">FB</a> 
                    <a href="" title="">Insta</a> 
                    <a href="" title="">Twitter</a> 
                    <a href="" title="">Linkedin</a>      
                </div>
            </div>
            <div id="author">Michał Błaszczyk &copy; 2021</div>
        </footer>'; 
        }

        function drawNecesseryHead() {
            echo '<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Michał Błaszczyk">
    <link rel="icon" type="image/png" href="./img/web/fav.webp">
    <link rel="stylesheet" href="./css/main-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">';
        }

        function drawNavCategories($categorie, $title) {
            $rows = count($categorie);
            echo '<ol class="list-categories-nav">';
            echo '<a href="#"><li class="first-list-categories-nav">'.$title.'</li></a>';
            for ($row = 0; $row < $rows; $row++) {
                echo '<a href="" title="'.$categorie[$row][1].'">
                        <li>'.$categorie[$row][1].'</li>
                    </a>';
            }
            echo '</ol>';
        }

        function drawGamePage($pdo, $id) {
            $db = new Database();
            $game = $db->getGameData($pdo, $id);
            echo '<div id="container-game-page">
            <div class="cover-game-page">
                <img src="./img/covers/'.$game[0][0].'_cover.webp" alt="'.$game[0][0].'" onerror="if (this.src != `./img/error/error_cover.webp`) this.src = `./img/error/error_cover.webp`";>
            </div>
            <div id="container-info-game-page">
                <div class="title-game-page">
                '.$game[0][0].'
                </div>
                <div id="info-game-page">
                    <div class="type-game-page">
                    Typ: '.$game[0][4].'
                    </div>
                    <div class="version-game-page">
                    Wersja: '.$game[0][5].'
                    </div>
                    <div class="platform-game-page">
                    Platforma: '.$game[0][6].'
                    </div>
                </div>
                <div class="short-desc-game-page">
                '.$game[0][2].'
                </div>
                <div class="price-game-page">
                '.$game[0][1].' zł
                </div>
                <div class="buy-game">
                    Kup grę
                </div>
            </div>
        </div>
        <div id="desc-game-page">
        '.$game[0][3].'
        </div>';
        }

    }

?>
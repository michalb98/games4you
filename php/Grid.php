<?php

    class Grid {

        function drawGamesGrid($games) {
            $rows = count($games);
            for ($row = 0; $row < $rows; $row++) {
                echo '<a class="game" href="" title="Zobacz produkt '.$games[$row][1].'">
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
            
        </div>
        <div id="help">
            
        </div>
        <div id="contact">
            
        </div>
        <div id="social-media">
                        
        </div>
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

    }

?>
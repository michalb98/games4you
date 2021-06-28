<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');

    $db = new Database();
    $grid = new Grid();

    $pdo = $db->creatrPDO();
    $games = $db->getAllFromTable($pdo, 'game');

    //$grid->drawGamesGrid($games);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games4You - sklep z grami komputerowymi</title>
    <link rel="stylesheet" href="./css/main-style.css">
</head>
<body>
    <div id="main-header">
        <a href="strona-glowna" title="Przejdź do strony głównej">
            <div id="logo">
                <img src="./img/web/logo.png" alt="Games4You">
            </div>
        </a>
        <div id="search">
            <input type="search" name="search">
        </div>
        <div id="account" class="icon-main-header">
        
        </div>
        <div id="cart" class="icon-main-header">
        
        </div>
    </div>
    <nav id="categories-nav">

    </nav>
    <main>
        <a class="game" href="" title="Zobacz produkt ">
            <div class="game-container">
                <img class="game-cover" src="./img/covers/Days gone_1_cover.jpg" alt="Days gone">
                <div class="game-info">
                    <p class="game-title"></p>
                    <p class="game-price"></p>
                </div>
                <div class="game-info-hover">
                    <p class="game-title"></p>
                    <p class="game-desc"></p>
                    <p class="game-price"></p>
                </div>
            </div>
        </a>
    </main>
    <footer>
        <div id="payment-method">
        
        </div>
        <div id="help">
        
        </div>
        <div id="contact">
        
        </div>
        <div id="social-media">
        
        </div>
    </footer>
</body>
</html>
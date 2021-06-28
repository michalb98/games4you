<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');

    $db = new Database();
    $grid = new Grid();

    $pdo = $db->creatrPDO();
    $games = $db->getAllFromTable($pdo, 'game');


?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Michał Błaszczyk">
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <link rel="icon" type="image/png" href="./img/web/fav.png">
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
        <?php

            $grid->drawGamesGrid($games);

        ?>
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
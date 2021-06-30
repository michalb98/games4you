<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Admin.php');
    require_once('./php/Form.php');

    $db = new Database();
    $grid = new Grid();
    $admin = new Admin();
    $form = new Form();

    $pdo = $db->createPDO();
    $games = $db->getAllFromTable($pdo, 'game');

    if(isset($_POST['title-admin-form'])) {
        $form->getFormAdminData();
        $form->initiateAddGameToTable($pdo);
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Michał Błaszczyk">
    <link rel="icon" type="image/png" href="./img/web/fav.png">
    <title>Games4You - panel administratora</title>
    <link rel="stylesheet" href="./css/main-style.css">
    <link rel="stylesheet" href="./css/admin-style.css">
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

            $admin->drawAddGameForm();

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
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="./js/previewCover.js"></script>
    <script>
        function showPriceNetto() {
            let pb = parseFloat(document.getElementById('brutto-admin-form').value).toFixed(2);;
            let pn = document.getElementById('netto-admin-form');

            if(pb != null)
                pn.value = parseFloat(pb/1.23).toFixed(2);

        }
    </script>
</body>
</html>
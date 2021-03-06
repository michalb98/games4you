<?php

    session_start();

    if(!isset($_SESSION['login']))
        header('Location: logowanie');

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/GameCart.php');

    $db = new Database();
    $grid = new Grid();
    $gameCart = new GameCart();

    $pdo = $db->createPDO();

    //Dodawanie gry do koszyka
    if(isset($_GET['id'])){
        if($db->getGameData($pdo, $_GET['id'])[0][7] == 0) {
            $_SESSION['error-quantity'] = "Przepraszamy. Chwilowy brak wybranego tytułu: ".$db->getGameData($pdo, $_GET['id'])[0][0];
        } else {
            if(isset($_SESSION['game-cart'])) {
                $id = explode(',', $_SESSION['game-cart']);
                for($i = 0; $i < sizeof($id); $i++){
                    if($id[$i] == $_GET['id']) {
                        unset($_GET['id']);
                        break;
                    }
                }
                if(isset($_GET['id']))
                    $_SESSION['game-cart'] .= ",".$_GET['id'];

            } else {
                $_SESSION['game-cart'] = $_GET['id'];
                header('Location: koszyk');
            }
        }
    } 

    //Usuwanie gry z kosza
    if(isset($_GET['remove']) && isset($_SESSION['game-cart'])){
        $id = explode(',', $_SESSION['game-cart']);
        $temp = '';
        for($i = 0; $i < sizeof($id); $i++){
            if($id[$i] != $_GET['remove']){
                if($id[$i] != '')
                    if($temp == "")
                        $temp .= $id[$i];
                    else 
                        $temp .= ','.$id[$i];
            }
        }
        if($temp != "")
            $_SESSION['game-cart'] = $temp;
        else
            unset($_SESSION['game-cart']);
        header('Location: koszyk');
    }

    //Płatność
    if(isset($_POST['discount-code']) && $_POST['discount-code'] != "") {
        $gameCart->setDiscountCode($db, $pdo, $_POST['discount-code']);
        if($gameCart->validateDiscountCode($db, $pdo, $_POST['discount-code'])) {
            $gameCart->setDiscountCode($_POST['discount-code']);
        } 
    } else if(isset($_SESSION['discount-code'])) {
        if($gameCart->validateDiscountCode($db, $pdo, $_SESSION['discount-code']))
            $gameCart->setDiscountCode($_SESSION['discount-code']);
    }

    if(isset($_POST['payment-method-cart'])) {
        $gameCart->setGameCartForm(NULL, $_POST['payment-method-cart'], NULL);
        if($gameCart->validateGameCartForm()) {
            $gameCart->buy($db, $pdo, $_POST['games-count'], $_SESSION['login']);            
        }
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <title>Games4You - Koszyk</title>
    <link rel="stylesheet" href="./css/cart-style.css">
    
    
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>

    <?php
        $grid->drawMainHeader();
    ?>

    <main id="main-cart">
        <div id="cart-container">
            <?php
                if(isset($_SESSION['game-cart']) && $_SESSION['game-cart'] != '') {
                    $id = explode(",", $_SESSION['game-cart']);
                    for($i = 0; $i < sizeof($id); $i++) {
                        $gameCart->drawGameCart($pdo, $id[$i], $db, $id[$i], $grid);
                    }
                } else 
                    $gameCart->emptyCart();
                if(isset($_SESSION['error-quantity'])) {
                    echo '<span class="error">'.$_SESSION['error-quantity'].'</span>';
                    unset($_SESSION['error-quantity']);
                }
            ?>
        </div>
        <?php
            $gameCart->drawPayPanel($db, $pdo);
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="./js/cartFunctions.js"></script>
</body>
</html>
<?php

    session_start();

    if(!isset($_SESSION['login']))
        header('Location: logowanie');

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/GameCart.php');

    $db = new Database();
    $grid = new Grid();
    $gc = new GameCart();

    $pdo = $db->createPDO();

    //Dodawanie gry do koszyka
    if(isset($_GET['id'])){
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

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <title>Games4You - Koszyk</title>
    <link rel="stylesheet" href="./css/cart-style.css">
    <link rel="stylesheet" href="./css/fontello.css">
    <link rel="stylesheet" href="./css/fontello-codes.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>

    <?php
        $grid->drawMainHeader();
    ?>

    <main>
        <div id="cart-container">
            <?php
                if(isset($_SESSION['game-cart']) && $_SESSION['game-cart'] != '') {
                    $id = explode(",", $_SESSION['game-cart']);
                    for($i = 0; $i < sizeof($id); $i++) {
                        $gc->drawGameCart($pdo, $id[$i], $db, $i);
                    }
                } else 
                    $gc->emptyCart();
            ?>
        </div>
        <div id="cart-payment-container">
            <div class="cart-payment-discount-code">
                <label for="discount-code" class="label-login-form">
                    Kod promocyjny:
                </label>
                <input type="text" name="discount-code">
                <input type="submit" value="Zastosuj">
            </div>
            <div class="cart-payment-total-price">
                <label for="total-price" class="label-login-form">
                    Do zapłaty:
                </label>
                <span id="total-price">99.99 zł</span>
            </div>
            <div class="cart-payment-method">
                <label for="payment-method" class="label-login-form">
                    Motoda płatnośći:
                </label>
                <select name="payment-method">
                    <option>PayPal</option>
                </select>
            </div>
            <div class="cart-payment-submit">
                <input type="submit" value="Przejdź do płatności">
            </div>
        </div>
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="./js/cartFunctions.js"></script>
</body>
</html>
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

    //Płatność
    if(isset($_POST['discount-code']) && $_POST['discount-code'] != "") {
        $gc->setDiscountCode($db, $pdo, $_POST['discount-code']);
        !($gc->validateDiscountCode($db, $pdo, $_POST['discount-code'])) ? $gc->setDiscountCode("") : $gc->setDiscountCode($_POST['discount-code']);
    }

    if(isset($_POST['payment-method-cart'])) {
        $gc->setGameCartForm(NULL, $_POST['payment-method-cart'], NULL);
        $gc->validateGameCartForm();
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
                        $gc->drawGameCart($pdo, $id[$i], $db, $i, $grid);
                    }
                } else 
                    $gc->emptyCart();
            ?>
        </div>
        <?php
            $gc->drawPayPanel($db, $pdo);
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="./js/cartFunctions.js"></script>
</body>
</html>
<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Form.php');
    require_once('./php/Reply.php');
    require_once('./php/Admin.php');

    $db = new Database();
    $grid = new Grid();
    $form = new Form();
    $reply = new Reply();
    $admin = new Admin();

    $pdo = $db->createPDO();

    $notice = $db->getNotice($pdo, $_GET['id']);
    $reply->setValueReply($notice[0][2], $notice[0][3], $notice[0][4], NULL);

    if(isset($_POST['reply-issue'])) {
        $reply->setValueReply($notice[0][2], $notice[0][3], $notice[0][4], $_POST['reply-issue']);
        if($reply->validateFormReply()) {
            header('Location: zgloszenia');
        }
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Games4You - dodaj grę</title>
    <link rel="stylesheet" href="./css/admin-style.css">
    <link rel="stylesheet" href="./css/account-style.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>
    <?php
        $admin->drawMainAdminHeader();
    ?>
    <nav id="categories-nav">

    </nav>
    <main>
        <?php
            $reply->drawReplyForm($db, $pdo);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="./js/previewCover.js"></script>
    <script src="./js/autoNettoPrice.js"></script>
    <script src="./js/autoQuantity.js"></script>
</body>
</html>
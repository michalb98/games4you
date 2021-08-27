<?php

    session_start();

    if(!isset($_SESSION['login']) || $_SESSION['rank'] != "Administrator") {
        header('Location: strona-glowna');
    }

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
            $_SESSION['reply-flag'] = $grid->showAlertWithFunction("Wysłano odpowiedź!", "Poprawnie wysłano odpowiedź na zgłoszenie.", "success", "OK", "zgloszenia");
        } else {
            $_SESSION['reply-flag'] = $grid->showAlert("Nie wysłano odpowiedzi!", "Proszę poprawić błędy.", "error", "OK");
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
    <main>
        <?php
            $reply->drawReplyForm($db, $pdo);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
        if(isset($_SESSION['reply-flag'])) {
            echo $_SESSION['reply-flag'];
            unset($_SESSION['reply-flag']);
        }
    ?>
</body>
</html>
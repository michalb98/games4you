<?php

    session_start();
    
    isset($_SESSION['login']) ? : header('Location: logowanie');

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Image.php');
    require_once('./php/Account.php');
    require_once('./php/Order.php');
    require_once('./php/Rating.php');
    require_once('./php/ReturnGame.php');
    require_once('./php/Contact.php');
    require_once('./php/DeleteAccount.php');
    require_once('./php/GameKey.php');

    $db = new Database();
    $grid = new Grid();
    $account = new Account();
    $contact = new Contact();

    $pdo = $db->createPDO();

    //Zmiana danych 
    if(isset($_POST['email'])) {
        $account->getValueFromAccountSettingsForm($account);
        $account->setData($_POST['email'], $_POST['name'], $_POST['surname'], $_POST['country'], $_POST['city'], $_POST['postal-code'], $_POST['street'], $_POST['street-number'], $_POST['house-number'], $_SESSION['login'], $_POST['new-password'], $_POST['password']);
        if($account->chcekFormAccountSettings($db, $pdo, $_SESSION['login'])) {
            $db->updateUserAdditionalSettings($pdo, $_SESSION['login'], $db->getIdCountry($pdo, $account->getSelectedCountry()), $account->getName(), $account->getSurname(), $account->getPostalCode(), $account->getCity(), $account->getStreet(), $account->getStreetNumber(), $account->getHouseNumber(), $account->getMail());
            if($_POST['new-password'] != "" && strlen($_POST['new-password']) > 6 ) {
                $db->updateUserSettings($pdo, $_SESSION['login'], $account->getNewPassword());
            }
        }       
    } else {
        $additionalData = $db->getUserAdditionalData($pdo, $_SESSION['login']);
        $mail = $db->getUserMail($pdo, $_SESSION['login']);
                    
        $account->setData($mail, $additionalData[0][0], $additionalData[0][1], $additionalData[0][2], $additionalData[0][3], $additionalData[0][4], $additionalData[0][5], $additionalData[0][6], $additionalData[0][7], $_SESSION['login'], null, null);    
    }

    //Ocena gry
    if(isset($_POST['rating-game-id'])) {
        $rating = new Rating();
        $rating->ratingGame($pdo, $db, $_POST['rating-game-id'], $db->getUserId($pdo, $_SESSION['login']), $_POST['star']);
    }

    //Kontakt
    if(isset($_POST['description-issue'])) {
        $contact->setValueContact($_POST['mail'], $_POST['issue'], $_POST['description-issue']);
        if($contact->validateFormContact()) {
            header('Location: ?account=kontakt');
        }
            
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <title><?php $account->setAccountTitle(isset($_GET['account']) ? $_GET['account'] : '', $_SESSION['login']) ?></title>
    <link rel="stylesheet" href="./css/fontello.css">
    <link rel="stylesheet" href="./css/fontello-codes.css">
    <link rel="stylesheet" href="./css/account-style.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>

    <?php
        $grid->drawMainHeader();
    ?>

    <nav id="categories-nav">
        <?php

            $type = $db->getAllFromTable($pdo, 'type');
            $platform = $db->getAllFromTable($pdo, 'platform');
            $version = $db->getAllFromTable($pdo, 'version');
            $grid->drawNavCategories($type, 'Wybierz typ', 'type');
            $grid->drawNavCategories($platform, 'Wybierz platformę', 'platform');
            $grid->drawNavCategories($version, 'Wybierz wersję', 'version');
            $grid->drawNavSearchAdvance($grid, $pdo, $db);  

        ?>
    </nav>
    <main>
        <nav id="nav-account">
            <?php
                $account->drawAccountNav();
            ?>
        </nav>
        <aside id="aside-account">
            <?php
                $countries = $db->getAllFromTable($pdo, 'countries');

                if(isset($_GET['account'])) {
                    switch ($_GET['account']) {
                        case "ustawienia":
                            $account->drawAccountSettings($countries);
                        break;
                        case "klucze":
                            $gameKey = new GameKey();
                            $gameKey->drawGameKey($db, $pdo, $_SESSION['login'], $grid);
                        break;
                        case "kody":
                            
                        break;
                        case "historia":
                            $order = new Order();
                            $order->drawOrders($pdo, $db, $grid);
                        break;
                        case "ocena":
                            $rating = new Rating();
                            $rating->drawRating($db, $pdo, $_SESSION['login'], $rating, $grid);
                        break;
                        case "zwrot":
                            $returnGame = new ReturnGame();
                            $returnGame->drawReturnGame($db, $pdo, $_SESSION['login'], $grid);
                        break;
                        case "kontakt":
                            if(!isset($_POST['description-issue']))
                                $contact->setValueContact($account->getMail(), NULL, NULL);
                            $contact->drawContactForm($db, $pdo);
                        break;
                        case "usunkonto":
                            $deleteAccount = new DeleteAccount();
                            $deleteAccount->drawDeleteAccount($_SESSION['login']);
                        break;
                        default:
                            $account->drawAccountSettings($countries);
                    }
                } else {
                    $account->drawAccountSettings($countries);
                }
            ?>
        </aside>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>
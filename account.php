<?php

    session_start();

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Image.php');

    $db = new Database();
    $grid = new Grid();

    $pdo = $db->createPDO();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <title>Games4You - konto <?php echo $_SESSION['login']; ?></title>
    <link rel="stylesheet" href="./css/fontello.css">
    <link rel="stylesheet" href="./css/fontello-codes.css">
    <link rel="stylesheet" href="./css/account.css">
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
            <a href="?account=ustawienia" title="" class="a-account">Ustawienia konta</a>
            <a href="?account=historia" title="" class="a-account">Historia zakupów</a>
            <a href="?account=ocena" title="" class="a-account">Oceny gier</a>
            <a href="?account=zwrot" title="" class="a-account">Zwrot gry</a>
            <a href="?account=kontakt" title="" class="a-account">Kontakt</a>
            <a href="?account=usunkonto" title="" class="a-account error">Usuń konto</a>
        </nav>
        <aside id="aside-account">
            <h1 class="account-text">Konto użytkownika: darx12311</h1>
            <form method="post" class="form-account">
                <label for="email" class="label">
                    E-mail
                </label>
                <input type="email" name="email" id="email" class="input-account" value="darx12311@gmail.com">
                <label for="password" class="label">
                    Hasło
                </label>
                <input type="password" name="password" id="password" class="input-account" placeholder="********">
                <label for="name" class="label">
                    Imię
                </label>
                <input type="text" name="name" id="name" class="input-account" placeholder="Adam" value="">
                <label for="surname" class="label">
                    Nazwisko
                </label>
                <input type="text" name="surname" id="surname" class="input-account" placeholder="Nowak" value="">
                <label for="surname" class="label">
                    Nazwisko
                </label>
                <input type="text" name="surname" id="surname" class="input-account" placeholder="Nowak" value="">
                <label for="country" class="label">
                    Kraj
                </label>
                <select class="select-account input-account" name="country" id="country">
                    <option>Polska</option>
                </select>
                <label for="city" class="label">
                    Miasto
                </label>
                <input type="text" name="city" id="city" class="input-account" placeholder="Warszawa" value="">
                <label for="postal-code" class="label">
                    Kod pocztowy
                </label>
                <input type="text" name="postal-code" id="postal-code" class="input-account" placeholder="00-001" value="">
                <label for="street" class="label">
                    Ulica
                </label>
                <input type="text" name="street" id="street" class="input-account" placeholder="Świętokrzyska" value="">
                <label for="street-number" class="label">
                    Numer ulicy
                </label>
                <input type="text" name="street-number" id="street-number" class="input-account" placeholder="75" value="">
                <label for="house-number" class="label">
                    Numer mieszkania
                </label>
                <input type="text" name="house-number" id="house-number" class="input-account" placeholder="3C" value="">
                <input type="submit" value="Zapisz zmiany" class="submit-account">
            </form>
        </aside>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>
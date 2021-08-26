<?php
    require_once("Database.php");

    class Admin {

        protected $db;

        //Funkcja wyświetla listę select w formularzu, jednocześnie sprawdza, czy jakaś opcja była zaznaczona. Jeżeli tak to ponownie zostaje zaznaczona
        function drawSelectItems($table, $selected) {
            $this->db = new Database();
            $pdo = $this->db->createPDO();
            $type = $this->db->getAllFromTable($pdo, $table);
            for ($i = 0; $i < sizeof($type); $i++) {
                echo '<option value="'.$type[$i][0].'" class="option-select-admin-form" ';
                    if (($type[$i][0] == $selected) || ($type[$i][1] == $selected))
                        echo "selected>"; 
                    else 
                        echo '>';
                echo $type[$i][1].'</option>';
            }
        }

        //Funkcja wyświetla formularz dodawania gry
        function drawAddGameForm($title, $submitValue, $variant) {
            $admin = new Admin();
            echo '<form method="post" class="admin-form" id="admin-form-game" enctype="multipart/form-data">
            <h1 class="form-title-admin-form">';
                echo $title;
            echo'</h1>
            <label for="title-admin-form" class="label-admin-form">
                Tytuł gry
            </label>
            <input type="text" name="title-admin-form" id="title-admin-form" class="text-admin-form" placeholder="np. Days gone" maxlength="50"';
            if (isset($_SESSION['title-value'])) {
                echo 'value="'.$_SESSION['title-value'].'"';
                unset($_SESSION['title-value']);
            }
            echo'>';
            if (isset($_SESSION['title-form-error'])) {
                echo '<span class="error">'.$_SESSION['title-form-error'].'</span>';
                unset($_SESSION['title-form-error']);
            }
            echo '<label for="brutto-admin-form" class="label-admin-form">
                Cena brutto gry
            </label>
            <input type="number" name="brutto-admin-form" id="brutto-admin-form" class="number-admin-form" placeholder="np. 159.99" step="0.01" min="0.01" max="999.99" onchange="showPriceNetto()"';
            if (isset($_SESSION['price-brutto-value'])) {
                echo 'value="'.$_SESSION['price-brutto-value'].'"';
                unset($_SESSION['price-brutto-value']);
            }
            echo'>';
            if (isset($_SESSION['price-brutto-form-error'])) {
                echo '<span class="error">'.$_SESSION['price-brutto-form-error'].'</span>';
                unset($_SESSION['price-brutto-form-error']);
            }
            echo '<label for="netto-admin-form" class="label-admin-form">
                Cena netto gry
            </label>
            <input type="number" name="netto-admin-form" id="netto-admin-form" class="number-admin-form" placeholder="np. 130.07" step="0.01" min="0.01" max="999.99"';
            if (isset($_SESSION['price-netto-value'])) {
                echo 'value="'.$_SESSION['price-netto-value'].'"';
                unset($_SESSION['price-netto-value']);
            }
            echo'>';
            if (isset($_SESSION['price-netto-form-error'])) {
                echo '<span class="error">'.$_SESSION['price-netto-form-error'].'</span>';
                unset($_SESSION['price-netto-form-error']);
            }
            echo '<label for="short-desc-admin-form" class="label-admin-form">
                Krótki opis gry
            </label>
            <textarea name="short-desc-admin-form" id="short-desc-admin-form" class="textare-admin-form" placeholder="Jedź i walcz w zabójczej, postpandemicznej Ameryce. W tej przygodowej grze akcji z otwartym światem zagrasz jako Deacon St. John, walczący o przetrwanie włóczęga i łowca nagród, przemierzający zniszczoną drogę w poszukiwaniu powodów, by dalej żyć." maxlength="250">';
            if (isset($_SESSION['short-desc-value'])) {
                echo $_SESSION['short-desc-value'];
                unset($_SESSION['short-desc-value']);
            }
            echo'</textarea>';
            if (isset($_SESSION['short-desc-form-error'])) {
                echo '<span class="error">'.$_SESSION['short-desc-form-error'].'</span>';
                unset($_SESSION['short-desc-form-error']);
            }
            echo '<label for="desc-admin-form" class="label-admin-form">
                Opis gry
            </label>
            <textarea name="desc-admin-form" id="desc-admin-form" class="textare-admin-form" placeholder="Days Gone  to klasyczna przygodowa gra akcji, w której kamera znajduje się stale za plecami głównego bohatera. Podczas rozgrywki eksplorujemy obszerną sandboksową mapę, wykonujemy zadania (główne i poboczne – np. czyszczenie obozów z bandytów czy polowanie na zwierzęta) i walczymy z wrogami – zarówno ludźmi, jak i z rozmaitymi rodzajami groźnych ofiar wirusa. Te ostatnie często poruszają się w hordach liczących nawet kilkaset osobników, a do tego posiadają własne potrzeby i regulujący ich zachowanie cykl dobowy. Ciekawym detalem urozmaicającym zabawę jest częściowa interaktywność otoczenia – mamy możliwość m.in. popychania przeciwników na obiekty lub przecinania lin podtrzymujących ścięte drzewa. Twórcy położyli też duży nacisk na taktykę i planowanie – szczególnie w przypadku starć z ludzkimi wrogami." maxlength="5000">';
            if (isset($_SESSION['desc-value'])) {
                echo $_SESSION['desc-value'];
                unset($_SESSION['desc-value']);
            }
            echo'</textarea>';
            if (isset($_SESSION['desc-form-error'])) {
                echo '<span class="error">'.$_SESSION['desc-form-error'].'</span>';
                unset($_SESSION['desc-form-error']);
            }
            switch($variant) {
                case 0:
                    echo '<label for="keys-admin-form" class="label-admin-form">
                    Klucze do gry (klucze rozdziela ",")
                    </label>
                    <textarea name="keys-admin-form" id="keys-admin-form" class="textare-admin-form" placeholder="np. LMT45-ODI73-34582,9373J-NLCRK-7GIQL" onchange="autoQuantity()">';
                    if (isset($_SESSION['keys-value'])) {
                        echo $_SESSION['keys-value'];
                        unset($_SESSION['keys-value']);
                    }
                    echo'</textarea>';
                    if (isset($_SESSION['keys-form-error'])) {
                        echo '<span class="error">'.$_SESSION['keys-form-error'].'</span>';
                        unset($_SESSION['keys-form-error']);
                    }
                break;
                case 1:
                    echo '<label for="keys-admin-form" class="label-admin-form">
                    Dodaj nowe klucze do gry (klucze rozdziela ",")
                    </label>
                    <textarea name="keys-admin-form" id="keys-admin-form" class="textare-admin-form" placeholder="np. LMT45-ODI73-34582,9373J-NLCRK-7GIQL" onchange="autoQuantity()" >';
                    if (isset($_SESSION['keys-value'])) {
                        echo $_SESSION['keys-value'];
                        unset($_SESSION['keys-value']);
                    }
                    echo'</textarea>';
                    if (isset($_SESSION['keys-form-error'])) {
                        echo '<span class="error">'.$_SESSION['keys-form-error'].'</span>';
                        unset($_SESSION['keys-form-error']);
                    }
                break;
            }
            
            echo '<label for="quantity-admin-form" class="label-admin-form">
                Ilość kluczy 
            </label>
            <input type="number" name="quantity-admin-form" id="quantity-admin-form" class="number-admin-form" placeholder="np. 50"  min="1" max="999"';
            if (isset($_SESSION['quantity-value'])) {
                echo 'value="'.$_SESSION['quantity-value'].'"';
                unset($_SESSION['quantity-value']);
            }
            echo'>';
            if (isset($_SESSION['quantity-form-error'])) {
                echo '<span class="error">'.$_SESSION['quantity-form-error'].'</span>';
                unset($_SESSION['quantity-form-error']);
            }
            echo '<label for="type-admin-form" class="label-admin-form">
                Typ gry
            </label>
            <div class="container-select-admin-form">
                <select id="type-admin-form" name="type-admin-form" class="select-admin-form">
                    <option value="default" class="option-select-admin-form">Wybierz typ ...</option>';
                    if(isset($_SESSION['type-value'])){ 
                        $type_selected = $_SESSION['type-value'];
                        unset($_SESSION['type-value']);
                    } else {
                        $type_selected = -1;
                    }
                    $admin->drawSelectItems('type', $type_selected);
                echo '</select>
            </div>';
            if (isset($_SESSION['type-form-error'])) {
                echo '<span class="error">'.$_SESSION['type-form-error'].'</span>';
                unset($_SESSION['type-form-error']);
            }
            echo '<label for="version-admin-form" class="label-admin-form">
                Wersja gry
            </label>
            <div class="container-select-admin-form">
                <select id="version-admin-form" name="version-admin-form" class="select-admin-form">
                    <option value="default" class="option-select-admin-form">Wybierz wersję ...</option>';
                    if(isset($_SESSION['version-value'])){ 
                        $version_selected = $_SESSION['version-value'];
                        unset($_SESSION['version-value']);
                    } else {
                        $version_selected = -1;
                    }
                    $admin->drawSelectItems('version', $version_selected);
                echo '</select>
            </div>';
            if (isset($_SESSION['version-form-error'])) {
                echo '<span class="error">'.$_SESSION['version-form-error'].'</span>';
                unset($_SESSION['version-form-error']);
            }
            echo '<label for="platform-admin-form" class="label-admin-form">
                Platforma gry
            </label>
            <div class="container-select-admin-form">
                <select id="platform-admin-form" name="platform-admin-form" class="select-admin-form">
                    <option value="default" class="option-select-admin-form">Wybierz platformę ...</option>';
                    if(isset($_SESSION['platform-value'])){ 
                        $platform_selected = $_SESSION['platform-value'];
                        unset($_SESSION['platform-value']);
                    } else {
                        $platform_selected = -1;
                    }
                    $admin->drawSelectItems('platform', $platform_selected);
                echo '</select>
            </div>';
            if (isset($_SESSION['platform-form-error'])) {
                echo '<span class="error">'.$_SESSION['platform-form-error'].'</span>';
                unset($_SESSION['platform-form-error']);
            }
            if (isset($_SESSION['game-cover'])) {
                echo '<label for="game-cover" class="label-admin-form">
                        Aktualna okładka gry
                    </label>
                    <img class="game-cover-form" src="'.$_SESSION['game-cover'].'" alt="Okładka gry">';
            }
            echo '<label for="cover-admin-form" class="label-admin-form">
                Okładka gry
            </label>
            <div id="cover-admin-form" class="image-upload-wrap">
                <input class="file-upload-input" name="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                <div class="drag-text">
                    <h3>Przeciągnij i upuść plik lub wybierz obraz</h3>
                </div>
            </div>
            <div class="file-upload-content">
                <img class="file-upload-image" src="';
                if (isset($_SESSION['game-cover'])) {
                    echo $_SESSION['game-cover'];
                    unset($_SESSION['game-cover']);
                } else {
                    echo "#";
                }
                echo '" alt="Okładka gry">
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="remove-image">Usuń <span class="image-title"></span></button>
                </div>
            </div>';
            if (isset($_SESSION['file-upload-error'])) {
                echo '<span class="error">'.$_SESSION['file-upload-error'].'</span>';
                unset($_SESSION['file-upload-error']);
            }
            echo '<input type="submit" value="'.$submitValue.'" class="submit-admin-form">
        </form>';
        }

        function drawAddKeysForm($db, $pdo) {
            echo '<form method="post" class="admin-form">
            <h1 class="form-title-admin-form">';
                if(isset($_GET['id'])) {
                    echo 'Dodaj klucze do gry';
                } else {
                    echo 'Wybierz grę';
                }
            echo'</h1>
            <label for="title-admin-form" class="label-admin-form">
                Tytuł gry
            </label>';
            echo'
            <div class="container-select-admin-form">
            <select id="title-admin-form" name="title-admin-form" class="select-admin-form">
                    <option value="default" class="option-select-admin-form">Wybierz grę ...</option>';
                    $games = $db->getAllFromDatabase($pdo, 'SELECT `ID_Game`, Title FROM `game` ORDER BY Title;');
                    for($i = 0; $i < sizeof($games); $i++) {
                        if((isset($_GET['id']) && $_GET['id'] == $games[$i][0]) || (isset($_SESSION['title-value']) && $_SESSION['title-value'] == $games[$i][0]))
                            echo '<option value="'.$games[$i][0].'" class="option-select-admin-form" selected>'.$games[$i][1].'</option>';
                        else
                            echo '<option value="'.$games[$i][0].'" class="option-select-admin-form">'.$games[$i][1].'</option>';
                    }
            echo '</select></div>';
            if (isset($_SESSION['title-form-error'])) {
                echo '<span class="error">'.$_SESSION['title-form-error'].'</span>';
                unset($_SESSION['title-form-error']);
            }
            echo '<label for="keys-admin-form" class="label-admin-form">
            Dodaj nowe klucze do gry (klucze rozdziela ",")
            </label>
            <textarea name="keys-admin-form" id="keys-admin-form" class="textare-admin-form" placeholder="np. LMT45-ODI73-34582,9373J-NLCRK-7GIQL" onchange="autoQuantity()">';
            if (isset($_SESSION['keys-value'])) {
                echo $_SESSION['keys-value'];
                unset($_SESSION['keys-value']);
            }
            echo'</textarea>';
            if (isset($_SESSION['keys-form-error'])) {
                echo '<span class="error">'.$_SESSION['keys-form-error'].'</span>';
                unset($_SESSION['keys-form-error']);
            }
            echo '<label for="quantity-admin-form" class="label-admin-form">
                Ilość kluczy 
            </label>
            <input type="number" name="quantity-admin-form" id="quantity-admin-form" class="number-admin-form" placeholder="np. 50"  min="1" max="999"';
            if (isset($_SESSION['quantity-value'])) {
                echo 'value="'.$_SESSION['quantity-value'].'"';
                unset($_SESSION['quantity-value']);
            }
            else if (isset($_GET['id'])) {
                echo 'value="'.$db->getGameQuantity($pdo, $_GET['id']).'"';
            }
            echo'>';
            if (isset($_SESSION['quantity-form-error'])) {
                echo '<span class="error">'.$_SESSION['quantity-form-error'].'</span>';
                unset($_SESSION['quantity-form-error']);
            }
            echo '<input type="submit" value="Dodaj klucze" class="submit-admin-form">
            </form>';
        }

        function drawAdminMenu() {

        }

        function drawGameToEdit($db, $pdo, $grid) {
            $games = $db->getAllFromTable($pdo, 'game');
            echo '<h1 class="h1-admin-panel">Panel edycji gier</h1>';
            for($i = 0; $i < sizeof($games); $i++) {
                echo '
                <div class="game-rating-container">
                    <div class="order-game-cover">';
                        $grid->drawCoverGame($games[$i][1]);
                    echo '</div>
                    <a href="produkt?id='.$games[$i][0].'" title="Zobacz grę '.$games[$i][1].'" class="order-game-title">
                        '.$games[$i][1].'
                    </a>
                    <div class="conatiner-admin-panel">
                        <a href="edytuj?id='.$games[$i][0].'" class="edit-game-panel">Edytuj grę</a>
                        <a href="dodaj-klucze?id='.$games[$i][0].'" class="edit-game-panel">Dodaj klucze</a>
                    </div>
                </div>';
            }
        }

        function drawAllNotices($db, $pdo) {
            $notices = $db->getNotices($pdo);
            echo '<h1 class="h1-admin-panel">Zgłoszenia</h1>';
            if(sizeof($notices) < 1) 
                echo '<h1 class="h1-admin-panel">Brak zgłoszeń</h1>';
            for($i = 0; $i < sizeof($notices); $i++) {
                echo '
                <div class="game-rating-container notice-container">
                    <div class="small-notice">
                        <span class="info-label">
                            Użytkownik
                        </span>
                        '.$notices[$i][1].'
                    </div>
                    <div class="small-notice">
                        <span class="info-label">
                            E-mail
                        </span>
                        '.$notices[$i][2].'
                    </div>
                    <div class="small-notice">
                        <span class="info-label">
                            Problem
                        </span>
                        '.$notices[$i][3].'
                    </div>
                    <div class="large-notice">
                        <span class="info-label">
                            Treść
                        </span>
                        '.$notices[$i][4].'
                    </div>
                    <div class="small-notice">
                        <a class="edit-game-panel notice-panel" href="usun?id='.$notices[$i][0].'&what=1" title="Usuń zgłoszenie">
                            Usuń zgłoszenie
                        </a>
                        <a class="edit-game-panel notice-panel" href="odpowiedz?id='.$notices[$i][0].'" title="Odpowiedz na zgłoszenie">
                            Odpowiedz na zgłoszenie
                        </a>
                    </div>
                </div>';
            }
        }

        function drawMainAdminHeader() {
            echo '<div id="main-header">
        <a href="admin-panel" title="Przejdź do strony głównej">
            <div id="logo">
                <img src="./img/web/icon.webp" alt="Games4You">
            </div>
        </a>
        <div id="search">
            <input type="search" name="search" placeholder="Wpisz tytuł gry...">
        </div>
        <a ';
        if(isset($_SESSION['login'])) { 
        echo 'href="koszyk" title="Zobacz swój koszyk" id="cart" class="icon-main-header">
            <i class="icon-basket icon"></i>';
            if(isset($_SESSION['game-cart'])) { 
                $games = explode(',', $_SESSION['game-cart']);
                $countGames = sizeof($games);
                echo '<div id="game-in-cart">'.$countGames.'</div>';
            }
        } else {
            echo 'href="logowanie" title="Zaloguj się, aby móc kupować gry" id="cart" class="icon-main-header">
            <i class="icon-basket icon"></i>';
        }
        echo'</a>
        <div id="account-container">';
            if(isset($_SESSION['login'])) {
                echo '<a href="konto" title="Zobacz swoje konto" id="account" class="icon-main-header">
                        <i class="icon-adult icon"></i>
                    </a>
                    <a href="konto" title="Zobacz swoje konto" class="hide-icon-main-header">Moje konto</a>
                    <a href="logout" title="Wyloguj się" class="hide-icon-main-header">Wyloguj się</a>';
            } else {
                echo '<a href="logowanie" title="Zaloguj się" id="account" class="icon-main-header">
                        <i class="icon-adult icon"></i>
                    </a>
                    <a href="logowanie" title="Zaloguj się" class="hide-icon-main-header">Zaloguj się</a>
                    <a href="rejestracja" title="Zarejestruj się" class="hide-icon-main-header">Zarejestruj się</a>';
            }
            
        echo '</div>
    </div>';
        }


    }

?>
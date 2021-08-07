<?php

    require_once('./php/Database.php');

    class Grid {

        protected $sortOption = array(  array("Price_brutto DESC", "Cena malejąco"),
                                        array("Price_brutto ASC", "Cena rosnąco"),
                                        array("Title ASC", "Tytuł A-Z"),
                                        array("Title DESC","Tytuł Z-A"));

        //Funkcja pobiera wszystkie dostępne gry, a następnie wyświetla odnośnik do wybranej gry 
        function drawGamesGrid($games) {
            $rows = count($games);
            for ($row = 0; $row < $rows; $row++) {
                echo '<a class="game" href="produkt?id='.$games[$row][0].'" title="Zobacz produkt '.$games[$row][1].'">
                        <div class="game-cover-container">
                            <img class="game-cover" src="./img/covers/'.$games[$row][1].'_cover.webp" alt="'.$games[$row][1].'" onerror="if (this.src != `./img/error/error_cover.webp`) this.src = `./img/error/error_cover.webp`;">
                        </div>
                        <div class="game-container">
                             <div class="game-info">
                                 <p class="game-title">'.$games[$row][1].'</p>
                                 <p class="game-price">'.$games[$row][3].' zł</p>
                            </div>
                            <div class="game-info-hover">
                                <p class="game-title">'.$games[$row][1].'</p>
                                <p class="game-desc">'.$games[$row][4].'</p>
                                <p class="game-price">'.$games[$row][3].' zł</p>
                            </div>
                        </div>
                     </a>'; 
            }
        }

        //Funkcja pobiera gry z danej kategorii, a następnie wyświetla odnośnik do wybranej gry 
        function drawGamesResult($games) {
            $rows = count($games);
            for ($row = 0; $row < $rows; $row++) {
                echo '<a class="game" href="produkt?id='.$games[$row][0].'" title="Zobacz produkt '.$games[$row][1].'">
                        <div class="game-cover-container">
                            <img class="game-cover" src="./img/covers/'.$games[$row][1].'_cover.webp" alt="'.$games[$row][1].'" onerror="if (this.src != `./img/error/error_cover.webp`) this.src = `./img/error/error_cover.webp`;">
                        </div>
                        <div class="game-container">
                             <div class="game-info">
                                 <p class="game-title">'.$games[$row][1].'</p>
                                 <p class="game-price">'.$games[$row][2].' zł</p>
                            </div>
                            <div class="game-info-hover">
                                <p class="game-title">'.$games[$row][1].'</p>
                                <p class="game-desc">'.$games[$row][3].'</p>
                                <p class="game-price">'.$games[$row][2].' zł</p>
                            </div>
                        </div>
                     </a>'; 
            }
        }

        //Funkcja wyświetla nagłówek strony
        function drawMainHeader() {
            echo '<div id="main-header">
        <a href="strona-glowna" title="Przejdź do strony głównej">
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

        //Funkcja wyświetla stopkę strony
        function drawFooter() {
            echo '<footer>
            <div id="payment-method">
                Metody płatności:
                <img src="./img/payments/mastercard.svg" alt="MasterCard">
                <img src="./img/payments/visa.svg" alt="Visa">
                <img src="./img/payments/paysafecard.svg" alt="PaySafeCard">
                <img src="./img/payments/skrill.svg" alt="Skrill">
                <img src="./img/payments/paypal.svg" alt="PayPal">
            </div>
            <div id="container-footer">
                <div id="help" class="div-conatiner-footer">
                    Pomoc:
                    <a href="" title="Zwrot gry">Zwrot gry</a>
                    <a href="" title="Support">Support</a>
                    <a href="" title="Regulamin">Regulamin</a>
                    <a href="" title="Ciasteczka">Ciasteczka</a>
                    <a href="" title="Inny problem">Inny problem</a>
                </div>
                <div id="contact" class="div-conatiner-footer">
                    Kontakt: 
                    <a href="mailto:support@games4you.pl" target="_blank">support@games4you.pl</a>
                </div>
                <div id="social-media" class="div-conatiner-footer">
                    Odwiedź Nas na:
                    <a href="" title="">FB</a> 
                    <a href="" title="">Insta</a> 
                    <a href="" title="">Twitter</a> 
                    <a href="" title="">Linkedin</a>      
                </div>
            </div>
            <div id="author">Michał Błaszczyk &copy; 2021</div>
        </footer>'; 
        }

        //Funkcja zawiera wszystkie niezbędne znaczniki meta oraz link, które powtarzają się na każdej podstronie
        function drawNecesseryHead() {
            echo '<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Michał Błaszczyk">
    <link rel="icon" type="image/png" href="./img/web/fav.webp">
    <link rel="stylesheet" href="./css/main-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">';
        }

        //Funkcja wyświetla listę wybranych kategorii. Wymaga wszystkich wymaganych kategorii, Tytułu który ma się wyświetlać na początku listy, oraz główną nazwę kategorii
        function drawNavCategories($categorie, $title, $get) {
            $rows = count($categorie);
            echo '<ol class="list-categories-nav">';
            echo '<a href="#"><li class="first-list-categories-nav">'.$title.'</li></a>';
            for ($row = 0; $row < $rows; $row++) {
                echo '<a href="szukaj?'.$get.'='.$categorie[$row][1].'" title="'.$categorie[$row][1].'">
                        <li>'.$categorie[$row][1].'</li>
                    </a>';
            }
            echo '</ol>';
        }

        //Funkcja wyświetla wszystkie informację na temat wybranej gry
        function drawGamePage($pdo, $id) {
            $db = new Database();
            $game = $db->getGameData($pdo, $id);
            echo '<div id="container-game-page">
            <div class="cover-game-page">
                <img src="./img/covers/'.$game[0][0].'_cover.webp" alt="'.$game[0][0].'" onerror="if (this.src != `./img/error/error_cover.webp`) this.src = `./img/error/error_cover.webp`";>
            </div>
            <div id="container-info-game-page">
                <div class="title-game-page">
                '.$game[0][0].'
                </div>
                <div id="info-game-page">
                    <div class="type-game-page">
                    Typ: <a href="type='.$game[0][4].'" title="Typ: '.$game[0][4].'">'.$game[0][4].'</a>
                    </div>
                    <div class="version-game-page">
                    Wersja: <a href="?version='.$game[0][5].'" title="Wersja: '.$game[0][5].'">'.$game[0][5].'</a>
                    </div>
                    <div class="platform-game-page">
                    Platforma: <a href="?platform='.$game[0][6].'" title="Platforma: '.$game[0][6].'">'.$game[0][6].'</a>
                    </div>
                </div>
                <div class="short-desc-game-page">
                '.$game[0][2].'
                </div>
                <div class="price-game-page">
                '.$game[0][1].' zł
                </div>
                <a href="koszyk?id='.$id.'" title="Dodaj grę do koszyka" class="buy-game">
                    <span>Dodaj grę do koszyka</span>
                </a>
            </div>
        </div>
        <div id="desc-game-page">
        '.$game[0][3].'
        </div>';
        }

        //Funkcja pobiera całą tablicę GET, a następnie sprawdza, czy dana metoda istnieje
        function getInfo($get){
            (isset($get['type'])) ? $out[0] = $get['type'] : $out[0] = "%";
            (isset($get['version'])) ? $out[1] = $get['version'] : $out[1] = "%";
            (isset($get['platform'])) ? $out[2] = $get['platform'] : $out[2] = "%";
            (isset($get['price-from']) && $get['price-from'] > 0 && $get['price-from'] < 1000) ? $out[3] = $get['price-from'] : $out[3] = "0"; 
            (isset($get['price-to']) && $get['price-to'] > 0 && $get['price-to'] < 1000) ? $out[4] = $get['price-to']+0.01 : $out[4] = "999.99"; 
            if(isset($get['sort-by'])) {
                switch($get['sort-by']) {
                    case "Price_brutto DESC":
                        $out[5] = "Price_brutto DESC";
                    break;
                    case "Price_brutto ASC":
                        $out[5] = "Price_brutto ASC";
                    break;
                    case "Title ASC":
                        $out[5] = "Title ASC";
                    break;
                    case "Title DESC":
                        $out[5] = "Title DESC";
                    break;
                    default:
                        $out[5] = "Title";
                }
            }
            else 
                $out[5] = "Title";            
            return $out;
        }

        //Funkcja wyświetla listę select w formularzu, jednocześnie sprawdza, czy jakaś opcja była zaznaczona. Jeżeli tak to ponownie zostaje zaznaczona
        function drawSelectNav($table, $header) {
            $this->db = new Database();
            $pdo = $this->db->createPDO();
            $type = $this->db->getAllFromTable($pdo, $table);
            echo '<option value="%" class="option-select-nav-form">'.$header.'</option>';
            for ($i = 0; $i < sizeof($type); $i++) {
                echo '<option value="'.$type[$i][1].'" class="option-select-nav-form">';
                echo $type[$i][1].'</option>';
            }
        }

        function getTitlePage($get) {
            if(isset($get['type'])) 
                ($get['type'] == "%") ? $out[0] = "Dowolny typ" : $out[0] = 'Typ: '.$get['type'];
            else 
                $out[0] = "";
            if(isset($get['version'])) 
                ($get['version'] == "%") ? $out[1] = "Dowolna wersja" : $out[1] = 'Wersja: '.$get['version']; 
            else 
                $out[1] = "";
            if(isset($get['platform'])) 
                ($get['platform'] == "%") ? $out[2] = "Dowolna platforma" : $out[2] = 'Platforma: '.$get['platform']; 
            else 
                $out[2] = "";
            if(isset($get['price-from'])) 
                $out[3] = 'Cena od: '.$get['price-from'].' zł'; 
            else 
                $out[3] = "";
            if(isset($get['price-to'])) 
                $out[4] = 'Cena do: '.$get['price-to'].' zł'; 
            else 
                $out[4] = "";
            if(isset($get['sort-by'])) {
                switch($get['sort-by']) {
                    case "Price_brutto DESC":
                        $out[5] = "Sortowanie: ".$this->sortOption[0][1];
                    break;
                    case "Price_brutto ASC":
                        $out[5] = "Sortowanie: ".$this->sortOption[1][1];
                    break;
                    case "Title ASC":
                        $out[5] = "Sortowanie: ".$this->sortOption[2][1];
                    break;
                    case "Title DESC":
                        $out[5] = "Sortowanie: ".$this->sortOption[3][1];
                    break;
                    default:
                        $out[5] = "";
                }
            }
            else 
                $out[5] = "";
            
            return $out;
        }

        function drawNavSearchAdvance($grid, $pdo, $db) {
            $minPrice = $db->getAllFromDatabase($pdo, 'SELECT Price_brutto FROM `game` ORDER BY Price_brutto ASC LIMIT 1;');
            $maxPrice = $db->getAllFromDatabase($pdo, 'SELECT Price_brutto FROM `game` ORDER BY Price_brutto DESC LIMIT 1;');
            echo '<form method="GET" class="nav-form" action="szukaj">
                    <a href="#" class="header-nav-form">Wyszukiwanie szczegółowe</a>
                    <select name="type" class="select-nav-form">';
                        $grid->drawSelectNav('type', 'Dowolny typ');
            echo '</select>';
            echo '<form method="GET">
                    <select name="platform" class="select-nav-form">';
                        $grid->drawSelectNav('platform', 'Dowolna platforma');
            echo '</select>';
            echo '<form method="GET">
                    <select name="version" class="select-nav-form">';
                        $grid->drawSelectNav('version', 'Dowolna wersja');
            echo '</select>';
            echo '<label for="price-from" class="label-nav-form">
                    Sortuj według:  
                </label>';
            echo '<select name="sort-by" class="select-nav-form">';
                    $rows = sizeof($this->sortOption);
                    for($i = 0; $i < $rows; $i++){
                        echo '<option class="option-select-sort-form" value="'.$this->sortOption[$i][0].'">'.$this->sortOption[$i][1].'</option>';
                    }
            echo'</select>';
            echo '<label for="price-from" class="label-nav-form">
                    Cena od:  
                </label>';
            echo '<input type="number" step="0.01" min="0.01" max="999.99" name="price-from" class="select-nav-form" value="'.$minPrice[0][0].'">';
            echo '<label for="price-from" class="label-nav-form">
                    Cena do:  
                </label>';
            echo '<input type="number" step="0.01" min="0.01" max="999.99" name="price-to" class="select-nav-form" value="'.$maxPrice[0][0].'">';
            echo '<input class="submit-nav-form" type="submit" value="Wyszukaj">';
            echo '</form>';
        }

        function drawSort($db, $pdo) {
            $minPrice = $db->getAllFromDatabase($pdo, 'SELECT Price_brutto FROM `game` ORDER BY Price_brutto ASC LIMIT 1;');
            $maxPrice = $db->getAllFromDatabase($pdo, 'SELECT Price_brutto FROM `game` ORDER BY Price_brutto DESC LIMIT 1;');
            echo '<div id="sort">
            <form method="GET" action="szukaj" class="sort-form">
                <label for="price-from" class="label-sort-form">
                    Cena od:
                </label>
                <input type="number" name="price-from" id="price-from" class="input-sort-form" value="'.$minPrice[0][0].'" step="0.01" min="0.01" max="999.99">
                <label for="price-from" class="label-sort-form">
                    Cena do:
                </label>
                <input type="number" name="price-to" id="price-to" class="input-sort-form" value="'.$maxPrice[0][0].'" step="0.01" min="0.01" max="999.99">
                <label for="price-from" class="label-sort-form">
                    Sortuj według:
                </label>
                <select name="sort-by" id="sort-by" class="select-sort-form">';
                    $rows = sizeof($this->sortOption);
                    for($i = 0; $i < $rows; $i++){
                        echo '<option class="option-select-sort-form" value="'.$this->sortOption[$i][0].'">'.$this->sortOption[$i][1].'</option>';
                    }
                echo '</select>
                <input type="submit" value="Sortuj" class="submit-sort-form">
            </form>
        </div>';
        }

        function drawLoginForm() {
            echo '<form method="POST" class="login-form">';
            if(isset($_SESSION['register'])) {
                echo '<label for="login" class="label-login-form">
                Witaj '.$_SESSION['register'].'! <br> Zaloguj się po raz pierwszy.
                </label>';
                unset($_SESSION['register']);
            }
            echo'<label for="login" class="label-login-form">
                Login
            </label>
            <input type="text" name="login" id="login" class="text-login-form" placeholder="np. Adam123"';
            if(isset($_SESSION['login-value'])) {
                echo 'value="'.$_SESSION['login-value'].'"';
                unset($_SESSION['login-value']);
            }
            echo'>';
            echo '<label for="password" class="label-login-form">
                Hasło
            </label>
            <input type="password" name="password" id="password" class="text-login-form" placeholder="**********">
            <input type="submit" value="Zaloguj się" class="submit-login-form">';
                if (isset($_SESSION['login-form-error'])) {
                    echo '<span class="error">';    
                    echo $_SESSION['login-form-error'];
                    echo '</span>';
                    unset($_SESSION['login-form-error']);
                }            
            echo'<p>Nie masz konta? <a href="rejestracja" title="Zarejestruj się">Zarejestruj się</a> już teraz!</p>
            <p>Nie pamiętasz hasła? <a href="zapomnialem-hasla" title="Przypomnij hasło">Przypomnij hasło</a> i uzyskaj dostęp do swojego konta!</p>
            </form> ';
        }

        function drawRegisterForm() {
            echo '<form method="POST" class="login-form">
            <label for="login" class="label-login-form">
                Login
            </label>
            <input type="text" name="login" id="login" class="text-login-form" placeholder="np. Adam123"';
            if(isset($_SESSION['login-value'])) {
                echo 'value="'.$_SESSION['login-value'].'"';
                unset($_SESSION['login-value']);
            }
            echo'>';

                if(isset($_SESSION['login-register-form-error'])) {
                    echo '<span class="error">';
                    echo $_SESSION['login-register-form-error'];
                    echo '</span>';
                    unset($_SESSION['login-register-form-error']);
                }
            echo '<label for="mail" class="label-login-form">
                E-mail
            </label>
            <input type="email" name="mail" id="mail" class="text-login-form" placeholder="np. adam123@gmail.com"';
            if(isset($_SESSION['email-value'])) {
                echo 'value="'.$_SESSION['email-value'].'"';
                unset($_SESSION['email-value']);
            }
            echo'>';

                if(isset($_SESSION['email-register-form-error'])) {
                    echo '<span class="error">';
                    echo $_SESSION['email-register-form-error'];
                    echo '</span>';
                    unset($_SESSION['email-register-form-error']);
                }
            echo '<label for="password" class="label-login-form">
                Hasło
            </label>
            <input type="password" name="password" id="password" class="text-login-form" placeholder="**********">';
                if(isset($_SESSION['password-register-form-error'])) {
                    echo '<span class="error">';
                    echo $_SESSION['password-register-form-error'];
                    echo '</span>';
                    unset($_SESSION['password-register-form-error']);
                }
            echo '<input type="submit" value="Zarejestruj się" class="submit-login-form">';

                if(isset($_SESSION['email-exist-register-form-error'])) {
                    echo '<span class="error">';
                    echo $_SESSION['email-exist-register-form-error'];
                    echo '</span>';
                    unset($_SESSION['email-exist-register-form-error']);
                }
            echo '<p>Masz już konto? <a href="logowanie" title="Zaloguj się">Zaloguj się</a> już teraz!</p>
        </form> ';
        }
    }

?>
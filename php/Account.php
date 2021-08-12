<?php

    class Account {

        protected $mail, $name, $surname, $selectedCountry, $city, $postalCode, $street, $streetNumber, $houseNumber, $user, $passwordNew, $password;
        
        //Pobiera dane oraz dokonuje sanityzacji 
        function setData($mail, $name, $surname, $selectedCountry, $city, $postalCode, $street, $streetNumber, $houseNumber, $user, $passwordNew, $password) {
            $this->mail =  filter_var($mail, FILTER_SANITIZE_EMAIL);
            $this->name =  filter_var($name, FILTER_SANITIZE_STRING);
            $this->surname = filter_var($surname, FILTER_SANITIZE_STRING);
            $this->selectedCountry = filter_var($selectedCountry, FILTER_SANITIZE_STRING);
            $this->city = filter_var($city, FILTER_SANITIZE_STRING);
            $this->postalCode = filter_var($postalCode, FILTER_SANITIZE_STRING);
            $this->street = filter_var($street, FILTER_SANITIZE_STRING);
            $this->streetNumber = filter_var($streetNumber, FILTER_SANITIZE_STRING);
            $this->houseNumber = filter_var($houseNumber, FILTER_SANITIZE_STRING);
            $this->user = filter_var($user, FILTER_SANITIZE_STRING);
            $this->passwordNew = hash("sha512", $passwordNew);
            $this->password = hash("sha512", $password);
        }

        //Wyświetla tytuł strony
        function setAccountTitle($get, $login) {
            switch($get) {
                case "ustawienia":
                    echo 'Games4You - Konto '.$login;
                break;
                case "historia":
                    echo 'Games4You - Historia zakupów';
                break;
                case "ocena":
                    echo 'Games4You - Ocena gier';
                break;
                case "zwrot":
                    echo 'Games4You - Zwrot gry';
                break;
                case "kontakt":
                    echo 'Games4You - Kontakt';
                break;
                case "klucze":
                    echo 'Games4You - Twoje klucze';
                break;
                case "kody":
                    echo 'Games4You - Twoje kody rabatowe';
                break;
                case "zwroty":
                    echo 'Games4You - Twoje zwroty';
                break;
                case "usunkonto":
                    echo 'Games4You - Usuń konto '.$login;
                break;
                default:
                    echo 'Games4You - Konto '.$login;
            }
        }

        //Wyświetla nawigację konta użytkownika
        function drawAccountNav() {
            echo '<a href="?account=ustawienia" title="Ustawienia konta" class="a-account">Ustawienia konta</a>
            <a href="?account=klucze" title="Twoje klucze" class="a-account">Twoje klucze</a>
            <a href="?account=kody" title="Twoje kody rabatowe" class="a-account">Twoje kody rabatowe</a>
            <a href="?account=historia" title="Historia zakupów" class="a-account">Historia zakupów</a>
            <a href="?account=ocena" title="Oceny gier" class="a-account">Oceny gier</a>
            <a href="?account=zwrot" title="Zwrot gry" class="a-account">Zwrot gry</a>
            <a href="?account=zwroty" title="Zwrot gry" class="a-account">Twoje zwroty</a>
            <a href="?account=kontakt" title="Kontakt" class="a-account">Kontakt</a>
            <a href="?account=usunkonto" title="Usuń konto" class="a-account error">Usuń konto</a>';
        }

        //Wyświetla ustawienia konta
        //Jest to domyślna funkcja na podstronie konto
        function drawAccountSettings($countries) {
            echo '<h1 class="account-text">Konto użytkownika: '.$this->user.'</h1>
            <form method="post" class="form-account">
                <label for="email" class="label">
                    E-mail
                </label>
                <input type="email" name="email" id="email" class="input-account" placeholder="a.nowak@gmail.com" value="'.$this->mail.'">
                <label for="new-password" class="label">
                    Nowe hasło
                </label>
                <input type="password" name="new-password" id="new-password" class="input-account" placeholder="********">
                <label for="name" class="label">
                    Imię
                </label>
                <input type="text" name="name" id="name" class="input-account" placeholder="Adam" value="'.$this->name.'">
                <label for="surname" class="label">
                    Nazwisko
                </label>
                <input type="text" name="surname" id="surname" class="input-account" placeholder="Nowak" value="'.$this->surname.'">
                <label for="country" class="label">
                    Kraj
                </label>
                <select class="select-account input-account" name="country" id="country">';
                    for($i = 0; $i<sizeof($countries); $i++) {
                        if($countries[$i][1] == $this->selectedCountry)
                            echo '<option selected>'.$countries[$i][1].'</option>';
                        else 
                        echo '<option>'.$countries[$i][1].'</option>';
                    }
                echo '</select>
                <label for="city" class="label">
                    Miasto
                </label>
                <input type="text" name="city" id="city" class="input-account" placeholder="Warszawa" value="'.$this->city.'">
                <label for="postal-code" class="label">
                    Kod pocztowy
                </label>
                <input type="text" name="postal-code" id="postal-code" class="input-account" placeholder="00-001" value="'.$this->postalCode.'">
                <label for="street" class="label">
                    Ulica
                </label>
                <input type="text" name="street" id="street" class="input-account" placeholder="Świętokrzyska" value="'.$this->street.'">
                <label for="street-number" class="label">
                    Numer ulicy
                </label>
                <input type="text" name="street-number" id="street-number" class="input-account" placeholder="75" value="'.$this->streetNumber.'">
                <label for="house-number" class="label">
                    Numer mieszkania
                </label>
                <input type="text" name="house-number" id="house-number" class="input-account" placeholder="3C" value="'.$this->houseNumber.'">
                <label for="password" class="label">
                    Hasło
                </label>
                <input type="password" name="password" id="password" class="input-account" placeholder="********">
                <input type="submit" value="Zapisz zmiany" class="submit-account">';
                if(isset($_SESSION['error'])) {
                    echo '<span class="error">'.$_SESSION['error'].'</span>';
                    unset($_SESSION['error']);
                } 
            echo '</form>';
        }

        //Pobiera, sprawdza oraz zapisuje dane z formularza ustawienia
        //Sprawdza, które dane zostały zmienione
        //Jeżeli dane nie zostały zmienione pozostawia chronione bez zmian
        function getValueFromAccountSettingsForm($account) {
            (strlen($_POST['email']) == 0) ? $mail = $this->mail : $mail = $_POST['email'];
            (strlen($_POST['name']) == 0) ? $name = $this->name : $name = $_POST['name'];
            (strlen($_POST['surname']) == 0) ? $surname = $this->surname : $surname = $_POST['surname'];
            (strlen($_POST['country']) == 0) ? $country = $this->selectedCountrycountry : $country = $_POST['country'];
            (strlen($_POST['city']) == 0) ? $city = $this->city : $city = $_POST['city'];
            (strlen($_POST['postal-code']) == 0) ? $postalCode = $this->postalCode : $postalCode = $_POST['postal-code'];
            (strlen($_POST['street']) == 0) ? $street = $this->street : $street = $_POST['street'];
            (strlen($_POST['street-number']) == 0) ? $streetNumber = $this->streetNumber : $streetNumber = $_POST['street-number'];
            (strlen($_POST['house-number']) == 0) ? $houseNumber = $this->houseNumber : $houseNumber = $_POST['house-number'];
            (strlen($_POST['new-password']) == 0) ? $passwordNew = $this->passwordNew : $passwordNew = hash("sha512", $_POST['new-password']);
            $account->setData($mail, $name, $surname, $country, $city, $postalCode, $street, $streetNumber, $houseNumber, $this->user, $passwordNew, $this->password);
        }

        //Sprawdza, czy podane dane w formularzu ustawienia konta są poprawne oraz dokonuje sanityzacji
        function chcekFormAccountSettings($db, $pdo, $login) {
            try {
                !(filter_var($this->mail, FILTER_VALIDATE_EMAIL) === false || strlen($this->mail) > 250 || strlen($this->mail) < 6)  ? : throw new Exception('Popraw swój E-mail!');
                (($db->countEmail($pdo, $this->mail) == 0) || ($db->getUserMail($pdo, $_SESSION['login'])) == $this->mail) ? : throw new Exception('Podany E-mail już istnieje!');
                !(($this->passwordNew == hash("sha512", $_POST['password']) || strlen($this->passwordNew) > 250 || strlen($this->passwordNew) < 6) && $_POST['new-password'] != '' )  ? : throw new Exception('Popraw swoje nowe hasło!');
                !((strlen($this->name) > 250 || strlen($this->name) < 3) && $_POST['name'] != '' )  ? : throw new Exception('Popraw swoje imię!');
                !((strlen($this->surname) > 250 || strlen($this->surname) < 2) && $_POST['surname'] != '' )  ? : throw new Exception('Popraw swoje nazwisko!');
                !((strlen($this->city) > 250 || strlen($this->city) < 2) && $_POST['city'] != '' )  ? : throw new Exception('Popraw swoje misto!');
                !((strlen($this->postalCode) > 8 || strlen($this->postalCode) < 6) && $_POST['postal-code'] != '' )  ? : throw new Exception('Popraw swój kod pocztowy!');
                !((strlen($this->street) > 250 || strlen($this->street) < 2) && $_POST['street'] != '' )  ? : throw new Exception('Popraw swoją ulice!');
                !((strlen($this->streetNumber) > 6 || strlen($this->streetNumber) < 1) && $_POST['street-number'] != '' )  ? : throw new Exception('Popraw swój numer ulicy!');
                !((strlen($this->houseNumber) > 6 || strlen($this->houseNumber) < 1) && $_POST['house-number'] != '' )  ? : throw new Exception('Popraw swój numer mieszkania!');
                (hash("sha512", $_POST['password']) == $db->getUserPasswordHash($pdo, $login))  ? : throw new Exception('Niepoprawne hasło! Musisz podać swoje akutalne hasło, aby zapisać zmiany.');
                return true;
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                return false;
            }
             
        }

        //Zwraca e-mail użytkownika
        function getMail() {
            return $this->mail;
        }

        //Zwraca imie użytkownika
        function getName() {
            return $this->name;
        }

        //Zwraca nazwisko użytkownika
        function getSurname() {
            return $this->surname;
        }

        //Zwraca kod pocztowy użytkownika
        function getPostalCode() {
            return $this->postalCode;
        }

        //Zwraca miasto użytkownika
        function getCity() {
            return $this->city;
        }

        //Zwraca ulicę użytkownika
        function getStreet() {
            return $this->street;
        }

        //Zwraca numer ulicy użytkownika
        function getStreetNumber() {
            return $this->streetNumber;
        }

        //Zwraca numer mieszkania użytkownika
        function getHouseNumber() {
            return $this->houseNumber;
        }

        //Zwraca kraj użytkownika
        function getSelectedCountry () {
            return $this->selectedCountry;
        }

        //Zwraca nowe hasło użytkownika
        function getNewPassword() {
            return $this->passwordNew;
        }

        //Zwraca hasło użytkownika
        function getPassword() {
            return $this->password;
        }
    }

?>
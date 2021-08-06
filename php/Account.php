<?php

    class Account {

        protected $mail, $name, $suranme,$selectedCountry, $city, $postalCode, $street, $streetNumber, $houseNumber, $user, $passwordNew, $password;
        
        function setData($mail, $name, $suranme, $selectedCountry, $city, $postalCode, $street, $streetNumber, $houseNumber, $user, $passwordNew, $password) {
            $this->mail =  filter_var($mail, FILTER_SANITIZE_EMAIL);
            $this->name =  filter_var($name, FILTER_SANITIZE_STRING);
            $this->suranme = filter_var($suranme, FILTER_SANITIZE_STRING);
            $this->selectedCountry = filter_var($selectedCountry, FILTER_SANITIZE_STRING);
            $this->city = filter_var($city, FILTER_SANITIZE_STRING);
            $this->postalCode = filter_var($postalCode, FILTER_SANITIZE_STRING);
            $this->street = filter_var($street, FILTER_SANITIZE_STRING);
            $this->streetNumber = filter_var($streetNumber, FILTER_SANITIZE_STRING);
            $this->houseNumber = filter_var($houseNumber, FILTER_SANITIZE_STRING);
            $this->user = filter_var($user, FILTER_SANITIZE_STRING);
            $this->passwordNew = filter_var($passwordNew, FILTER_SANITIZE_STRING);
            $this->password = filter_var($password, FILTER_SANITIZE_STRING);
        }

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
                case "usunkonto":
                    echo 'Games4You - Usuń konto '.$login;
                break;
                default:
                    echo 'Games4You - Konto '.$login;
            }
        }

        function drawAccountNav() {
            echo '<a href="?account=ustawienia" title="Ustawienia konta" class="a-account">Ustawienia konta</a>
            <a href="?account=historia" title="Historia zakupów" class="a-account">Historia zakupów</a>
            <a href="?account=ocena" title="Oceny gier" class="a-account">Oceny gier</a>
            <a href="?account=zwrot" title="Zwrot gry" class="a-account">Zwrot gry</a>
            <a href="?account=kontakt" title="Kontakt" class="a-account">Kontakt</a>
            <a href="?account=usunkonto" title="Usuń konto" class="a-account error">Usuń konto</a>';
        }

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
                <input type="text" name="surname" id="surname" class="input-account" placeholder="Nowak" value="'.$this->suranme.'">
                <label for="country" class="label">
                    Kraj
                </label>
                <select class="select-account input-account" name="country" id="country">
                    <option>Wybierz swój kraj...</option>';
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
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                } 
            echo '</form>';
        }

        function getValueFromAccountSettingsForm($post) {
            (strlen($_POST['email']) == 0) ? $mail = $this->mail : $mail = $_POST['email'];
        }

        function chcekFormAccountSettings() {
            try {
                !(filter_var($this->mail, FILTER_VALIDATE_EMAIL) === false || strlen($this->mail) > 250 || strlen($this->mail) < 6)  ? : throw new Exception('Popraw swój E-mail!');
                !(($this->passwordNew == $this->password || strlen($this->password) > 250 || strlen($this->mail) < 6) && $_POST['new-password'] != '' )  ? : throw new Exception('Popraw swoje nowe hasło!');
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
             
        }
    }

?>
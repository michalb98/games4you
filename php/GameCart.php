<?php

    class GameCart {
        
        protected $gameData;
        protected $discountCode;
        protected $value;
        protected $paymentMethod;
        protected $discountCodeValue;

        function setGameCartForm($discountCode, $paymentMethod, $value) {
            $this->discountCode = filter_var($discountCode, FILTER_SANITIZE_STRING);
            $this->paymentMethod = filter_var($paymentMethod, FILTER_SANITIZE_STRING);
            $this->value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }

        function validateGameCartForm() {
            try {
                !($this->paymentMethod == "Wybierz metodę płatnośći...") ? : throw new Exception("Proszę wybrać metodę płatnści!");
                return true;
            } catch (Exception  $e) {
                $_SESSION['error-cart'] = $e->getMessage();
                return false;
            }
        }

        //Wyświetla powiadomienie o pustym koszyku
        function emptyCart() {
            echo '<h1 class="cart-text">Twój koszyk jest pusty.</h1>';
        }

        //Wyśietla produkty w koszyku
        function drawGameCart($pdo, $id, $db, $classNumber, $grid) {
            $this->gameData = $db->getGameData($pdo, $id);
            echo '<div class="game-cart-container">
            <div class="game-cart-cover">';
                $grid->drawCoverGame($this->gameData[0][0]);
            echo '</div>
            <a href="produkt?id='.$id.'" title="Zobacz grę w sklepie" class="game-cart-title">
                '.$this->gameData[0][0].'
            </a>
            <div class="game-cart-quantity">
                <form method="POST">
                    <label for="game-quantity">
                        Ilość: 
                    </label>
                    <input type="number" value="1" min="1" max="10" id="game-quantity-'.$id.'" name="game-quantity-'.$id.'" class="game-quantity" onchange="calculateTotalPriceGame('.$classNumber.'); calculateTotalPrice();" >
                    <input type="hidden" value='.$this->gameData[0][1].'" id="game-price-hidden-'.$id.'" class="game-price-hidden">
                </form>
            </div>
            <div id="game-cart-price-'.$id.'" class="game-cart-price">
                '.$this->gameData[0][1].' zł
            </div>
            <div class="game-cart-remove">
                <a href="koszyk?remove='.$id.'" title="Usuń grę">
                    Usuń grę
                </a>';
            echo'</div>
        </div>';
        }

        function drawPayPanel($db, $pdo) {
            $paymentMethod = $db->getAllFromTable($pdo, 'payment_method');
            echo '<div id="cart-payment-container" method="POST">
                        <form method="POST" class="cart-payment-discount-code">
                            <label for="discount-code" class="label-login-form">
                                Kod promocyjny:
                            </label>
                            <input type="text" name="discount-code" class="input-cart" value="'.$this->discountCode.'" ';if($this->discountCode != "") echo "disabled"; echo'>';
                            if($this->discountCode == "")
                                echo '<input type="submit" value="Zastosuj" class="submit-cart-discount submit-login-form">';
                            else 
                                echo '<span class="successful">Kod został użyty pomyślnie!</span>';
                            if(isset($_SESSION['error-discount'])) {
                                echo '<span class="error">'.$_SESSION['error-discount'].'</span>';
                                unset($_SESSION['error-discount']);
                            }
                        echo '</form>
                        <div class="cart-payment-total-price">
                            <label for="total-price" class="label-login-form">
                                Do zapłaty:
                            </label>
                            <span id="total-price"></span>
                            <input type="hidden" id="discount" name="discount" value="'.$this->discountCodeValue.'">
                        </div>
                        <form method="POST" class="cart-payment-method">
                            <label for="payment-method-cart" class="label-login-form">
                                Motoda płatnośći:
                            </label>
                            <select name="payment-method-cart" id="payment-method-cart" class="input-cart">
                                <option>Wybierz metodę płatnośći...</option>';
                                for($i=0; $i < sizeof($paymentMethod); $i++) {
                                    echo '<option>'.$paymentMethod[$i][1].'</option>';
                                }
                            echo '</select>';
                            if(isset($_SESSION['game-cart'])) {
                                $idGame = explode(",", $_SESSION['game-cart']);
                                for($i = 0; $i < sizeof($idGame); $i++) {
                                    echo '<input type="hidden" id="game-id-'.$idGame[$i].'" name="game-id-'.$i.'" value="'.$idGame[$i].'">';
                                    echo '<input type="hidden" id="game-id-quantity-'.$idGame[$i].'" name="game-id-quantity-'.$i.'" value="1">';
                                }
                                echo '<input type="hidden" name="games-count" value="'.sizeof($idGame).'">';
                            }
                            echo '
                            <input type="submit" value="Przejdź do płatności" class="submit-login-form">';
                            if(isset($_SESSION['error-cart'])) {
                                echo '<span class="error">'.$_SESSION['error-cart'].'</span>';
                                unset($_SESSION['error-cart']);
                        echo '</form>';
                        }
            echo '</div>';
        }

        function validateDiscountCode($db, $pdo, $discountCode) {
            try {
                $check = $db->checkDiscountCode($pdo, $discountCode);
                $date = date('Y-m-d');
                ($check) ? : throw new Exception("Błędny kod rabatowy!");
                !($check[0][1] > $date) ? : throw new Exception('Kod rabatowy będzie ważny od '.$check[0][1].'.');
                !($check[0][2] < $date) ? : throw new Exception('Kod rabatowy był ważny do '.$check[0][2].'.');
                $this->discountCodeValue = filter_var($db->checkDiscountCode($pdo, $discountCode)[0][3], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                return true;
            } catch (Exception $e) {
                $_SESSION['error-discount'] = $e->getMessage();
                return false;
            }
        }

        function buy($db, $pdo, $gamesCount, $login) {
            $date = date('Ymd');
            $orderNumberId = $db->getLastOrderNumberID($pdo) + 1;
            $orderNumber = $date.''.$orderNumberId;
            $db->insertIntoOrderNumber($pdo, $orderNumber);
            $idOrderNumber = $db->getLastOrderNumberID($pdo);
            for($i = 0; $i < $gamesCount; $i++) {
                $idGame = $_POST['game-id-'.$i];
                $idGameKey = $db->getGameKeyId($pdo, $idGame);
                $idUser = $db->getUserId($pdo, $login);
                $idPayment = $db->getPaymentMethodId($pdo, $this->paymentMethod);
                $priceBrutto = $db->getGameData($pdo, $idGame)[0][1];
                $priceNetto = round($priceBrutto/1.23, 2);
                $quantity = $_POST['game-id-quantity-'.$i];
                $data = date('Y-m-d');
                $db->insertIntoTransaction($pdo, $idGame, $idGameKey, $idUser, $idPayment, $priceNetto, $priceBrutto, $quantity, $data);
                $idTransaction = $db->getTransactionId($pdo, $idUser);
                $db->insertIntoOrders($pdo, $idTransaction, $idOrderNumber);
            }
            unset($_SESSION['discount-code']);
            unset($_SESSION['game-cart']);
            header('Location: koszyk');
        }

        function setDiscountCode($discountCode) {
            $this->discountCode = filter_var($discountCode, FILTER_SANITIZE_STRING);
            $_SESSION['discount-code'] = $this->discountCode;
         }

    }

?>
<?php

    class ReturnGame {

        protected $games, $returned;

        //Wyświetla gry do zwrotu
        function drawReturnGame($db, $pdo, $login, $grid) {
            $this->games = $db->checkGamesToReturn($pdo, $login);
            if(sizeof($this->games) == 0)
                echo '<h1 class="text-alert">Nie masz gier, które podlegają zwrotowi.</h1>';
            else
                echo '<h1 class="text-alert">Wyświetlone zostały tylko te produkty, które można zwrócić.</h1>';
            for($i = 0; $i < sizeof($this->games); $i++) {
                echo '
                <div class="game-rating-container">
                    <div class="order-game-cover">';
                        $grid->drawCoverGame($this->games[$i][1]);
                    echo '</div>
                    <a href="produkt?id='.$this->games[$i][0].'" title="Zobacz grę '.$this->games[$i][1].'" class="order-game-title">
                        '.$this->games[$i][1].'
                    </a>
                    <form method="POST" class="form-return">
                        <input type="hidden" name="return-game-id" value="'.$this->games[$i][0].'">
                        <input type="hidden" name="transaction-number" value="'.$this->games[$i][3].'">
                        <input class="game-return-submit" type="submit" value="Oddaj grę">
                    </form>
                </div>';
            }
            echo '<div class="error" style="text-align: center; margin-top: 2vh;">Pamiętaj, że grę można oddać, dopóki nie zostanie wyświetlony klucz produktu! Jeśli uważasz, że wystąpił jakiś błąd <a href="?account=kontakt" title="kontakt">opisz swój problem</a> lub skontaktuj się z <a href="Support" title="Support">suportem</a>.</div>';
        }

        //Dokonuje zwrotu gry
        //Generuje kod rabatowy, dodaje go do bazy oraz pobiera jego id
        //Dodaje wpis do bazy świadczący o zwrocie oraz pobiera jego id
        //Zmienia transakcję dodając do niej id kodu rabatowego oraz id zwrotu
        //Przekierowuje do strony konto?account=zwrot, aby odświeżyć stronę
        function returnKey($db, $pdo, $idGame, $idTransaction, $login) {
            $returnGame = new ReturnGame;
            $discountCode = $returnGame->generateDiscountCode($idGame, $idTransaction, $login);
            $validateFrom = date('Y-m-d');
            $validateTo = date('Y-m-d', strtotime("+3 months", strtotime($validateFrom)));
            $value = $db->getPriceBruttoFromTransaction($pdo, $idTransaction);
            $db->insertIntoDiscountCode($pdo, $discountCode, $validateFrom, $validateTo, $value);
            $idDiscountCode = $db->getIdDiscountCode($pdo, $discountCode);
            $db->insertIntoReturns($pdo, $idTransaction, $idDiscountCode);
            $idReturn = $db->getIdReturn($pdo, $idTransaction, $idDiscountCode);
            $db->updateTransactionReturn($pdo, $idTransaction, $idReturn, $idDiscountCode);
            header('Location: ?account=zwrot');
        }

        //Generuje kod rabatwowy na podstawie id gry, id transakcji oraz loginie użytkonika oraz zwraca kod rabatowy
        private function generateDiscountCode($idGame, $idTransaction, $login) {
            $discountCode = $idTransaction.$login.$idGame;
            return md5($discountCode);
        }

        //Wyświetla gry zwrócone przez użytkownika o loginie $login
        function drawReturnedGames($db, $pdo, $login, $grid) {
            $this->returned = $db->getReturnedGames($pdo, $login);
            if(sizeof($this->returned) == 0)
                echo '<h1 class="text-alert">Nie dokonałeś jeszcze żadnego zwrotu.</h1>';
            else
                echo '<h1 class="text-alert">Twoje zwrócone produkty.</h1>';
            for($i = 0; $i < sizeof($this->returned); $i++) {
                echo '
                <div class="game-rating-container">
                    <div class="order-game-cover">';
                        $grid->drawCoverGame($this->returned[$i][1]);
                    echo '</div>
                    <a href="produkt?id='.$this->returned[$i][0].'" title="Zobacz grę '.$this->returned[$i][1].'" class="order-game-title">
                        '.$this->returned[$i][1].'
                    </a>
                    <div class="discount-code">
                        <span class="info-label">Kod rabatowy:</span>'.$this->returned[$i][2].'
                    </div>
                </div>';
            }
        }
    }

?>
<?php

    class ReturnGame {

        protected $games;

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
                        <input type="hidden" name="return-game-id" value="">
                        <input type="hidden" name="transaction-number" value="">
                        <input class="game-return-submit" type="submit" value="Oddaj grę">
                    </form>
                </div>';
            }
            echo '<div class="error" style="text-align: center; margin-top: 2vh;">Pamiętaj, że grę można oddać, dopóki nie zostanie wyświetlony klucz produktu! Jeśli uważasz, że wystąpił jakiś błąd <a href="?account=kontakt" title="kontakt">opisz swój problem</a> lub skontaktuj się z <a href="Support" title="Support">suportem</a>.</div>';
        }

    }

?>
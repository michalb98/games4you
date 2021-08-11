<?php

    class GameKey {
        protected $games;
        
        function drawGameKey($db, $pdo, $login, $grid) {
            $this->games = $db->checkGamesToReturn($pdo, $login);
            if(sizeof($this->games) == 0)
                echo '<h1 class="text-alert">Nie posiadasz jeszcze żadnych kluczy :(</h1>';
            else
                echo '<h1 class="text-alert">Twoje klucze do gier.</h1>';
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
                        <input type="hidden" name="game-id" value="">
                        <input type="hidden" name="transaction-number" value="">
                        <input class="game-return-submit key-submit" type="submit" value="Wyświetl klucz">
                    </form>
                </div>';
            }
        }
    }

?>